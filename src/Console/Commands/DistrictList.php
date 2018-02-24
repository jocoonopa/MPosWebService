<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * DistrictDetail
 */
class DistrictList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:member:districts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get district detail';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump(MPosWs::fetchDistricts());
    }
}