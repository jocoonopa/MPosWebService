<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ProductCountries
 */
class ProductCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:product:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get product countries';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump(MPosWs::fetchProductCountries());
    }
}