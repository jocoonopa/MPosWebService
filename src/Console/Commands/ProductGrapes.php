<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ProductGrapes
 */
class ProductGrapes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:product:grapes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get product grapes';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump(MPosWs::fetchProductGrapes());
    }
}