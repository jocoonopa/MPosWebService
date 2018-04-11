<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * OrderItem
 */
class OrderItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:order:item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get order item from ws';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [      
            'displayFields' => 'orderID;prdID;prdPrice;promPrice;normalPrice;orderQty;orderItm;orderRemark;prdBrandEnu;prdBrandZht;prdNameEnu;prdNameZht;prdCode;prdSequence;promotionStatus',     
            'keywords' => $this->ask(CommandHelper::getKeywordsDesc(), '163100000000012'),
            'queryFields' => $this->ask('What are your queryFields', 'orderID'),
            'fieldsRelation' => $this->choice('What is your join condition {0: or, 1: and}' , [0, 1], 1),
            'currentPage' => $this->ask('What is your current page', 1),
            'pageSize' => $this->ask('Whats is your pageSize?', 10),
            'sortFields' => $this->ask('What are your sortFields (多筆請用 ; 區隔)', 'orderID'),
            'sortOrders' => $this->ask('What are your orders (多筆請用 ; 區隔)', 'DESC'),
        ];

        dump(MPosWS::viewOrder($data));
    }
}
