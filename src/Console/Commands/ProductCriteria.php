<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ProductCriteria
 */
class ProductCriteria extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:product:criteria';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get products criteria in given conditions';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            "keywords" => $this->ask(CommandHelper::getKeywordsDesc(), 'DEC_PROMO;530'),
            "queryFields" => $this->ask('What are your queryFields?', 'groupID;storeID'),
        ];

        dump(MPosWs::fetchCriteria($data));
    }
}