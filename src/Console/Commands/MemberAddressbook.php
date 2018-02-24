<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;
use jocoonopa\MPosWebService\Console\Commands\CommandHelper;

/**
 * MemberAddressbook
 */
class MemberAddressbook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:member:addressbook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get member addressbook';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'keywords' => $this->ask(CommandHelper::getKeywordsDesc(), '1'),
        ];

        dump(MPosWs::fetchMemberAddressbook($data));
    }
}