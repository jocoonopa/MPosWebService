<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ShopCartAdd
 */
class ShopCartAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:cart:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shopcart add';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'prdID' => $this->ask('What is your prdID?', 180868),
            'storeID' => $this->ask('What is your storeID?', '530'),
            'shopQty' => $this->ask('What is your shopQty?',5),
            'saveBy' => 'website',
        ];

        $shopUUID = $this->ask('What is your shopUUID?', null);

        if (!is_null($shopUUID)) {
            $data['shopUUID'] = $shopUUID;
        }

        dump(MPosWs::addToCart($data));
    }
}