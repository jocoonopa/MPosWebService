<?php

namespace jocoonopa\MPosWebService;

use Ixudra\Curl\CurlService;
use jocoonopa\MPosWebService\Event\ApiCalled;

/**
 * MPosWebService
 *
 * @author  jocoonopa <jocoonopa@gmail.com>
 */
class MPosWebService
{
    use MemberTrait, ProductTrait, ShopTrait, OrderTrait, PromotionTrait, PaymentTrait;

    /**
     * @var \Ixudra\Curl\CurlService
     */
    protected $curl;

    /**
     * @var array
     */
    protected $config;

    public function __construct(CurlService $curl, array $config)
    {
        $this
            ->setCurl($curl)
            ->setConfig($config)
        ;
    }

    /**
     * curl action
     *
     * @param  array  $data
     * @param  string $url [must be url format]
     * @param  boolean $wantOrigin 若為真，直接回傳 curl 結果不進行包裝處理
     * @return array      
     */
    public function curl(array $data, $url, $wantOrigin = false)
    {
        // @author jocoonopa
        // @date 2018-04-25
        // @reason 對應 kevin api 的改版，處理 fieldsRelation 轉換
        $fieldsRelation = $this->getRelation(array_get($data, 'fieldsRelation'));

        if (!is_null($fieldsRelation)) {
            $data['fieldsRelation'] = $this->getRelation(array_get($data, 'fieldsRelation'));
        }

        /**
         * @var array
         */
        $params = $this->getParams($data);

        // 若啟用，會 dump，要小心這個會讓 vue 掛掉
        if ($this->getConfig()['debug'] && 'local' === env('APP_ENV')) {
            dump($params);
        }

        $params['sign'] = $this->getSign($params, $this->getConfig()['token']);

        /**
         * json string
         * 
         * @var json
         */
        $response = $this->getCurl()->to($this->genFullUrl($url))
            ->withContentType('text/html')
            ->withData($params)
            ->withHeader('Authorization: Basic '. base64_encode($this->getConfig()['username'] .':' . $this->getConfig()['password']))
            ->withHeader('charset: UTF-8')
            ->post()
        ;

        // 若啟用，會 dump，要小心這個會讓 vue 掛掉
        if ($this->getConfig()['debug'] && 'local' === env('APP_ENV')) {
            dump($response);
        }

        // 是否啟用即時監察模式
        if ($this->getConfig()['observe']) {
            // 僅關註設定之使用者
            if (
                (auth()->user() && $this->getConfig()['monitored'] === auth()->user()->id) ||
                false !== strpos(php_sapi_name(), 'cli')
            ) {
                event(new ApiCalled($url, request()->all(), $params, json_decode($response, true)));    
            }
        }

        /**
         * @var array
         */
        $responseArr = json_decode($response, true);

        /**
         * data
         * 
         * @var array
         */
        $responseData = is_null(json_decode($responseArr['data'])) ? $responseArr['data'] : json_decode($responseArr['data']);

        if (!array_get($responseArr, 'is_success')) {
            \Log::emergency('mpos-web-service-api', [
                'url' => $url,
                'laravel_url' => \Request::url(),
                'vue' => request()->all(),
                'request' => $params,
                'response' => $response,
            ]);
        }

        if ($this->getConfig()['log']) {
            \Log::info('mpos-web-service-api', [
                'url' => $url,
                'vue' => request()->all(),
                'request' => $params,
                'response' => $response,
                'is_success' => array_get($responseArr, 'is_success'),
            ]);
        }

        return [
            'is_success' => array_get($responseArr, 'is_success'),
            'error_code' => array_get($responseArr, 'error_code'),
            'message' => array_get($responseArr, 'message'),
            'data' => $responseData,
        ];
    }

    /**
     * 轉換 findRelation 的值
     *
     * @param string|integer $val ['|','+'] [0,1] ['or', 'and']
     */
    protected function getRelation($val = null)
    {
        if (is_null($val)) {
            return null;
        }

        if (in_array($val, ['+', '1', 'and'])) {
            return '+';
        }

        if (in_array($val, ['|', '0', 'or'])) {
            return '|';
        }

        // 進階搜尋，例如:
        // ({0}{1}{2})+{3}
        return $val;
    }

    /**
     * 產生完整 url (含 protocol)
     * 
     * @param  string $url
     * @return string     
     */
    protected function genFullUrl($url)
    {
        return "http://{$this->getConfig()['domain']}/{$url}";
    }

    /**
     * pass data
     * 
     * @return array
     */
    protected function getParams(array $data)
    {
        return [
            'app_id' => $this->getConfig()['app_id'],
            'certi_id' => $this->getConfig()['certi_id'],
            'data' => json_encode($data),
            'date' => with(new \DateTime)->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * 獲取簽名
     * 
     * @param  array $params 
     * @param  string $token  
     * @return string         
     */
    protected function getSign($params, $token)
    {
        /*
        |--------------------------------------------------------------------------
        | 参数 sign 的构造步骤:
        |--------------------------------------------------------------------------
        | Step1: 将所有参数(sign 除外)按“参数名 1 参数值 1 .. 参数名 N 参数值 N”的形式 组装
        |
        | Step2: MD5加密1步骤的字符串，得到32位字符串，确保所有字符大写
        | 
        | Step3: 步骤得到的字符串，拼接 token 参数;确保所有字符大写
        |
        | Step4: MD5加密3步骤的字符串，得到32位字符串，确保所有字符大写
        |
        */
        $str = '';
        $tmp = [];

        // Step1.
        foreach ($params as $key => $value) {
            $tmp[] = "{$key}{$value}";
        }

        $str = implode('', $tmp);

        // Step2.
        $str = strtoupper(md5($str));
        
        // Step3.
        $str = "{$str}{$token}";

        // Step4.
        $str = strtoupper(md5($str));

        return $str;
    }

    /**
     * 取得 Api url 前綴
     * 
     * @return string
     */
    protected function getApiUrl()
    {
        $version = array_get($this->getConfig(), 'version', null);

        if (is_null($version)) {
            return 'mpos/service';
        }
        
        return "mpos/{$version}/service";
    }

    /**
     * @return \Ixudra\Curl\CurlService
     */
    public function getCurl()
    {
        return $this->curl;
    }

    /**
     * @param \Ixudra\Curl\CurlService $curl
     *
     * @return self
     */
    public function setCurl(\Ixudra\Curl\CurlService $curl)
    {
        $this->curl = $curl;

        return $this;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     *
     * @return self
     */
    public function setConfig(array $config)
    {
        $this->config = $config;

        return $this;
    }
}