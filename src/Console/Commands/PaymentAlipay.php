<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;
use jocoonopa\MPosWebService\Console\Commands\CommandHelper;

/**
 * PaymentAlipay
 */
class PaymentAlipay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:payment:alipay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Do alipay';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = json_decode('{
            "orderID":163200000001,
            "storeID":"530",
            "paymentCode":"f7583f1a8d964eb9921e921964d1f39c",
            "paymentAmount":726,
            "locale":"1",
            "memberNo":"010100138600",
            "operatorID":"001",
            "operatorName":"001 name",
            "saveBy":"MPOS", 
            "items":
             [
              {"prdID":460504,
               "deptDesc":"ALCOHOL & TOBACC",
               "subDeptDesc":"RED-NORTH AMERIC",
               "prdDiscount":99,
               "prdRtlPrice":825,
               "qty":1
              }
             ]
            }', true);

        dump(MPosWs::aliPay($data));
    }
}