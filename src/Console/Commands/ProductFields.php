<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ProductFields
 */
class ProductFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:product:fields {--detail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get product available fields';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $response = $this->option('detail') ? MPosWs::fetchProductDetailFields() : MPosWs::fetchProductFields();

        dump($response);
    }
}