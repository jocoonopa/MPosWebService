<?php

namespace jocoonopa\MPosWebService;

/**
 * Shop related methods
 */
trait ShopTrait
{
    /**
     * addToCart
     *
     * @param array $data
     */
    public function addToCart(array $data)
    {
        $response = $this->curl(
            $data,

            'mpos/service/shopcart/add'
        );

        return array_get($response, 'data');
    }

    /**
     * viewCart
     *
     * @param array $data
     */
    public function viewCart(array $data)
    {
        $response = $this->curl(
            $data,

            'mpos/service/shopcart/query'
        );

        return array_get($response, 'data');
    }

    /**
     * removeFromCart
     *
     * @param array $data
     */
    public function removeFromCart(array $data)
    {
        $response = $this->curl(
            $data,

            'mpos/service/shopcart/remove'
        );

        return array_get($response, 'data');
    }
}