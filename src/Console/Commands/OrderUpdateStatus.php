<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * DistrictList
 */
class OrderUpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:order:up-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update order status';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'orderID' => $this->ask('請輸入 orderID', 163100000000390),
            'orderStatus' => $this->choice(
                'Order status 三種', 
                [
                    'Payment Failure', 'Unpaid', 'Ordered',
                ], 
                0
            ),
            'saveBy' => 'MPOS',
        ];

        dump(MPosWs::updateOrderStatus($data));
    }
}