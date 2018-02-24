<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ShopCartRemove
 */
class ShopCartRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:cart:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove from shop cart';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'shopUUID' => $this->ask('What is your shopUUID?', 'dbf2166664754c3db8557e836e9554f0'),
            'prdID' => $this->ask('What is the prdID you want to remove?', 180868),
            'shopQty' => $this->ask('What is the remove Qty?', 3),
            'storeID' => $this->ask('What is your storeID?', '530'),
            'saveBy' => 'website',
        ];

        dump(MPosWs::removeFromCart($data));
    }
}