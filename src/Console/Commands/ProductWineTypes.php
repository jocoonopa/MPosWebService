<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * ProductWineTypes
 */
class ProductWineTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:product:winetypes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get product winetypes';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump(MPosWs::fetchProductWineTypes());
    }
}