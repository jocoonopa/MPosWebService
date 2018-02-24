<?php

namespace jocoonopa\MPosWebService\Facades;

use Illuminate\Support\Facades\Facade;

class MPosWebService extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'mpos-ws';
    }
}