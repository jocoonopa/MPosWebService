<?php

namespace jocoonopa\MPosWebService;

/**
 * Order related methods
 */
trait OrderTrait
{
    /**
     * Get orders pagination
     * 
     * @param  array $params example: {"keywords":"163100000000012","queryFields":"orderID"}
     * @return [type]         [description]
     */
    public function fetchOrderPagination(array $params)
    {
        $count = $this->fetchOrderCount($params);

        /**
         * @var integer
         */
        $pageSize = array_get($params, 'pageSize', 10);

        return [
            'data' =>$this->fetchOrders($params),

            'meta' => [
                'current_page' => (int) array_get($params, 'currentPage', 1),
                'last_page' => floor($count/$pageSize),
                'per_page' => (int) array_get($params, 'pageSize', $pageSize),
                'total' => $count,
            ],
        ];
    }

    /**
     * Fetch orders from api
     * 
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    public function fetchOrders(array $params)
    {
        $response = $this->curl(
            $params,

            "{$this->getApiUrl()}/order/query"
        );

        return array_get($response, 'data');
    }

    /**
     * Fetch orders count from api
     * 
     * @param  array $params example: {"keywords":"163100000000012","queryFields":"orderID"}
     * @return integer
     */
    public function fetchOrderCount(array $params)
    {
        $response = $this->curl(
            $params,

            "{$this->getApiUrl()}/order/count"
        );

        if (isset($response['data'])) {
            return (int) array_get($response, 'data')->noOfOrderHeaders;
        }

        return 0;
    }

    /**
     * View order items
     * 
     * @param  array  $params [
     *    {
     *        "keywords":"163100000000012",
     *        "queryFields":"orderID",
     *        "displayFields":"orderID;prdID;prdPrice;promPrice;normalPrice;orderQty;orderItm;orderRemark;prdBrandEnu;prdBrandZht;prdNameEnu;prdNameZht;prdCode;prdSequence;promotionStatus"}                  
     * 
     * ]
     * @return array
     */
    public function viewOrder(array $params)
    {
        $response = $this->curl(
            $params,

            "{$this->getApiUrl()}/order/item/query"
        );

        return array_get($response, 'data');
    }

    /**
     * Add order
     * 
     * @param array $params 
     */
    public function addOrder(array $params)
    {
        $response = $this->curl(
            $params,

            "{$this->getApiUrl()}/order/add"
        );

        return $response;
    }
}