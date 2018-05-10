<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * DistrictList
 */
class ProductUpdatePrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:product:up-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get district detail';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump(MPosWs::updateProductPrice([
            'saveBy' => 'MPOS',
            'prdPrice' => 258,
            'prdID' => 180868,
            'storeID' => '530',
            'remarks' => 'remarks'
        ]));
    }
}