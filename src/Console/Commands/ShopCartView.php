<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ShopCartView
 */
class ShopCartView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:cart:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View shop cart';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'shopUUID' => $this->ask('What is your shopUUID?', 'eec159b45269414cb88ee74decd1df3a'),
            'storeID' => $this->ask('What is your storeID?', '530'),
        ];

        dump(MPosWs::viewCart($data));
    }
}