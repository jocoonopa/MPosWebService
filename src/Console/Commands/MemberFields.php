<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * MemberFields
 */
class MemberFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:member:fields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get member available fields';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        dump(MPosWS::fetchFields());
    }
}
