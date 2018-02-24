<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ProductVintages
 */
class ProductVintages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:product:vintages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get product vintages';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump(MPosWs::fetchProductVintages());
    }
}