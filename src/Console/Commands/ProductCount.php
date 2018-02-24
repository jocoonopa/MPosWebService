<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ProductCount
 */
class ProductCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:product:count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get products count in given conditions';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            "keywords" => $this->ask(CommandHelper::getKeywordsDesc(), '180868;530'),
            "queryFields" => $this->ask('What are your queryFields?', 'prdID;storeID'),
        ];

        dump(MPosWs::fetchProductsCount($data));
    }
}