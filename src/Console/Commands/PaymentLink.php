<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * PaymentLink
 */
class PaymentLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:payment:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Payment wirecard link';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $params = [
            "orderID" => 163200000001,
            "saveBy" => "MPOS",
            "redirectUrl" => 'http://localhost:8080/payment/payServlet2',
            "amt" => "5.01",
        ];

        $response = MPosWS::linkPayment($params);

        echo $response['data'];
    }
}
