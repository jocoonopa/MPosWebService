<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ProductStock
 */
class ProductStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:product:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get product\'s stock by id';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'storeId' => $this->ask('What is your storeId?', 530),
            'productId' => $this->ask('What is your product id?', 361396),
        ];

        dump(MPosWs::getStockById(array_get($data, 'storeId'), array_get($data, 'productId')));
    }
}