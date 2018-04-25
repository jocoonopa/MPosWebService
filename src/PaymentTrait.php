<?php

namespace jocoonopa\MPosWebService;

/**
 * Order related methods
 */
trait PaymentTrait
{
    /**
     * Wirecard link
     * 
     * @param array $params 
     */
    public function linkPayment(array $params)
    {        
        $response = $this->curl(
            $params,

            "{$this->getApiUrl()}/payment/wirecard/link"
        );

        return $response;
    }
}