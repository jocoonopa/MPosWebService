<?php

namespace jocoonopa\MPosWebService;

/**
 * Product related methods
 */
trait ProductTrait
{
    /**
     * Paginate results of fetchProducts()
     * 
     * @param  array $data
     * @param  boolean $isDetail
     * @return array
     */
    public function getProductsPagination(array $data, $isDetail = false)
    {
        /**
         * @var integer
         */
        $count = $this->fetchProductsCount($data);

        /**
         * @var integer
         */
        $pageSize = array_get($data, 'pageSize', 10);

        return [
            'data' => $isDetail ? $this->fetchProductsWithDetail($data) : $this->fetchProducts($data),

            'meta' => [
                'current_page' => (int) array_get($data, 'currentPage', 1),
                'last_page' => floor($count/$pageSize),
                'per_page' => (int) array_get($data, 'pageSize', $pageSize),
                'total' => $count,
            ],
        ];
    }

    /**
     * fetchProducts
     *
     * @param  array $data
     * @return array $data
     */
    public function fetchProducts(array $data)
    {
        $response = $this->curl(
            $data,

            "{$this->getApiUrl()}/product/query"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductsCount
     * 
     * @param  array $data
     * @return integer
     */
    public function fetchProductsCount(array $data)
    {
        $response = $this->curl(
            $data,

            "{$this->getApiUrl()}/product/count"
        );

        if (isset($response['data'])) {
            return (int) array_get($response, 'data')->noOfProducts;
        }

        return 0;
    }

    /**
     * fetchProductsWithDetail
     *
     * @param  array $data
     * @return array
     */
    public function fetchProductsWithDetail(array $data)
    {
        $response = $this->curl(
            $data,

            "{$this->getApiUrl()}/product/detail/query"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductFields
     * 
     * @return array
     */
    public function fetchProductFields()
    {
        $response = $this->curl(
            [],

            "{$this->getApiUrl()}/product/fields"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductDetailFields
     * 
     * @return array
     */
    public function fetchProductDetailFields()
    {
        $response = $this->curl(
            [],

            "{$this->getApiUrl()}/product/detail/fields"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductGrapes
     * 
     * @return array
     * @note {\"grapes\":[\"Cabernet Franc\",\"Cabernet Sauvignon\"]}
     */
    public function fetchProductGrapes()
    {
        $response = $this->curl(
            [],

            "{$this->getApiUrl()}/product/grapes"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductCountries
     * 
     * @return array
     * @note {\"countries\":[\"France\",\"Germany\"]}
     */
    public function fetchProductCountries()
    {
        $response = $this->curl(
            [],

            "{$this->getApiUrl()}/product/countries"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductRegions
     * 
     * @return array 
     * @note {\"regions\":[\"Bordeaux\",\"Burgundy\"]}
     */
    public function fetchProductRegions()
    {
        $response = $this->curl(
            [],

            "{$this->getApiUrl()}/product/regions"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductVintages
     * 
     * @return array
     * @note {\"vintages\":[\"1995\",\"1996\"]}
     */
    public function fetchProductVintages()
    {
        $response = $this->curl(
            [],

            "{$this->getApiUrl()}/product/vintages"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductPrices
     * 
     * @return array 
     * @note {\"rangeFrom\":10,\"rangeTo\":60000}
     */
    public function fetchProductPrices()
    {
        $response = $this->curl(
            [],

            "{$this->getApiUrl()}/product/price/range"
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductWineTypes
     * 
     * @return array
     * @note {\"winetypes\":[\"Still Rose\",\"Red Wine\",\"White Wine\"]}
     */
    public function fetchProductWineTypes()
    {
        $response = $this->curl(
            [],

            "{$this->getApiUrl()}/product/winetypes"
        );

        return array_get($response, 'data');
    }

    /**
     * 取得商品完整搜尋條件
     *
     * @param  array $params
     * @return array
     */
    public function fetchCriteria(array $params = [])
    {
        $response = $this->curl(
            $params,

            "{$this->getApiUrl()}/product/detail/criteria"
        );

        return array_get($response, 'data');
    }

    /**
     * getProductApiVersion
     * 
     * @return array
     */
    public function getProductApiVersion()
    {
        $response = $this->curl(
            [],

            "{$this->getApiUrl()}/product/version"
        );

        return array_get($response, 'data');
    }

    /**
     * Get Stock By Id
     *
     * @param  integer $storeId
     * @param  integer $productId
     * 
     * @return array {
     *   "prdID":361396,
     *   "storeID":"530",
     *   "minStockLevel":0,
     *   "actualStock":200,
     *   "saleStock":2,
     *   "cardStock":198
     * }
     */
    public function getStockById($storeId, $productId)
    {
        $response = $this->curl(
            [
                'storeID' => $storeId,
                'prdID' => $productId,
            ],

            "{$this->getApiUrl()}/stock/query"
        );

        return array_get($response, 'data');
    }

    /**
     * 更新產品價格
     * 
     * @params array $params {
         "saveBy":"MPOS",
         "prdPrice":258,
         "prdID":180868,
         "storeID":"530",
         "remarks":"remarks"
        }
     * 
     * @return array {
            "responseCode":"00"
        }
     */
    public function updateProductPrice(array $params)
    {
        $response = $this->curl(
            $params,

            "{$this->getApiUrl()}/product/price/update"
        );

        return array_get($response, 'data');
    }
}