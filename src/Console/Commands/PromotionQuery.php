<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * MemberCount
 */
class PromotionQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:promotion:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Promotion query from ws';

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
            'fieldsRelation' => $this->choice('What is your join condition {0: or, 1: and}' , [0, 1], 1),
            'currentPage' => $this->ask('What is your current page', 1),
            'pageSize' => $this->ask('Whats is your pageSize?', 10),
            'sortFields' => $this->ask('What are your sortFields (多筆請用 ; 區隔)', 'firstName'),
            'sortOrders' => $this->ask('What are your orders (多筆請用 ; 區隔)', 'DESC'),
        ];

        dump(MPosWS::fetchMembersCount($data));
    }
}
