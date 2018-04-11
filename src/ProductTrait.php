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
     * fetchProductsCount
     * 
     * @param  array $data
     * @return integer
     */
    public function fetchProductsCount(array $data)
    {
        $response = $this->curl(
            $data,

            'mpos/service/product/count'
        );

        if (isset($response['data'])) {
            return (int) array_get($response, 'data')->noOfProducts;
        }

        return 0;
    }

    /**
     * fetchProductCountries
     * 
     * @return array
     */
    public function fetchProductCountries()
    {
        $response = $this->curl(
            [],

            'mpos/service/product/countries'
        );

        return array_get($response, 'data');
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

            'mpos/service/product/detail/query'
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

            'mpos/service/product/fields'
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

            'mpos/service/product/detail/fields'
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductGrapes
     * 
     * @return array
     */
    public function fetchProductGrapes()
    {
        $response = $this->curl(
            [],

            'mpos/service/product/grapes'
        );

        return array_get($response, 'data');
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

            'mpos/service/product/query'
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductRegions
     * 
     * @return array
     */
    public function fetchProductRegions()
    {
        $response = $this->curl(
            [],

            'mpos/service/product/regions'
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

            'mpos/service/product/version'
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductVintages
     * 
     * @return array
     */
    public function fetchProductVintages()
    {
        $response = $this->curl(
            [],

            'mpos/service/product/vintages'
        );

        return array_get($response, 'data');
    }

    /**
     * fetchProductWineTypes
     * 
     * @return array
     */
    public function fetchProductWineTypes()
    {
        $response = $this->curl(
            [],

            'mpos/service/product/winetypes'
        );

        return array_get($response, 'data');
    }
}