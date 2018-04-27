<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * MemberQuery
 */
class MemberQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:member:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get members from ws';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'displayFields' => $this->ask('What are your displayFields? (多筆請用 ; 區隔)', 'firstName'),
            'keywords' => $this->ask(CommandHelper::getKeywordsDesc(), 'samuel|kevin'),
            'queryFields' => $this->ask('What are your queryFields', 'firstName'),
            'fieldsRelation' => $this->ask('What is your join condition' , 1),
            'currentPage' => $this->ask('What is your current page', 1),
            'pageSize' => $this->ask('Whats is your pageSize?', 10),
            'sortFields' => $this->ask('What are your sortFields (多筆請用 ; 區隔)', 'firstName'),
            'sortOrders' => $this->ask('What are your orders (多筆請用 ; 區隔)', 'DESC'),
        ];

        dump(MPosWS::getMembersPagination($data));
    }
}
