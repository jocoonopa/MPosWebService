<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;
use jocoonopa\MPosWebService\Console\Commands\CommandHelper;

/**
 * ProductQuery
 */
class ProductQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:product:query {--detail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get products';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'keywords' => $this->ask(CommandHelper::getKeywordsDesc(), '180868;530'),
            'displayFields' => $this->ask('What are your displayFields? (; 分隔)', 'prdBrandEnu;prdNameEnu'),
            'queryFields' => $this->ask('What are your queryFields?(; 分隔)', 'prdID;storeID'),
            'currentPage' => $this->ask('What is your current page?', 1),
            'pageSize' => $this->ask('What is your pageSize?', 10),
            'sortFields' => $this->ask('What is your sortFields? (; 分隔)', 'prdNameEnu'),
            'sortOrders' => $this->ask('What is your sortOrders? (; 分隔)', 'DESC'),
        ];

        $response = $this->option('detail') ? MPosWs::fetchProductsWithDetail($data) : MPosWs::fetchProducts($data);

        dump($response);
    }
}