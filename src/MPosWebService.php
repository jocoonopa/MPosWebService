<?php

namespace jocoonopa\MPosWebService;

use Ixudra\Curl\CurlService;

/**
 * MPosWebService
 *
 * @author  jocoonopa <jocoonopa@gmail.com>
 */
class MPosWebService
{
    use MemberTrait, ProductTrait, ShopTrait, OrderTrait;

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
     * @return array      
     */
    public function curl(array $data, $url)
    {
        /**
         * @var array
         */
        $params = $this->getParams($data);

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

        /**
         * @var array
         */
        $responseArr = json_decode($response, true);

        /**
         * data
         * 
         * @var array
         */
        $responseData = json_decode($responseArr['data']);

        return [
            'is_success' => array_get($responseArr, 'is_success'),
            'error_code' => array_get($responseArr, 'error_code'),
            'message' => array_get($responseArr, 'message'),
            'data' => $responseData,
        ];
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