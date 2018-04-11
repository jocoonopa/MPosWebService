<?php

namespace jocoonopa\MPosWebService\Console\Commands;

use Illuminate\Console\Command;
use MPosWS;

/**
 * OrderCreate
 */
class OrderCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpos-ws:order:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add order from ws';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $params = json_decode('{
            "billAddr1":"pBillAddr1",
            "billAddr2":"pBillAddr2",
            "billAddr3":"pBillAddr3",
            "billCompany":"pBillCompany",
            "billDistID":"1002",
            "billDistName":"Admiralty",
            "billEmail":"pBillEmail",
            "billFirstName":"BillFirstName",
            "billLastName":"pBillLastName",
            "billFaxNo":"pBillFaxNo",
            "billTitle":"Mr",
            "cardExpire":"2018-08",
            "deliverDate":"20180227",
            "deliverStoreID":"530",
            "deliverTime":"10:00AM - 02:00PM",
            "drawerName":"pDrawerName",
            "orderAmt":60,
            "payment":"americanExpress",
            "shipAddr1":"pShipAddr1",
            "shipAddr2":"pShipAddr2",
            "shipAddr3":"pShipAddr3",
            "shipDistID":"1001",
            "shipDistName":"Aberdeen",
            "shipFirstName":"pShipFirstName",
            "shipLastName":"pShipLastName",
            "shipPhoneNo":"shipPhoneNo",
            "shipMobileNo":"shipMobileNo",
            "billPhoneNo":"billPhoneNo",
            "billMobileNo":"billMobileNo",
            "cardNo":"311111111111111",
            "shipFaxNo":"pShipFaxNo",
            "shipTitle":"Mr",
            "specialInstruction":"for test",
            "acctType":"Individual",
            "discount":10,
            "deliveryCharge":true,
            "umiCardNo":"010100003283",
            "membershipType":"Gold",
            "loginID":1,
            "orderItems":[
                {
                    "prdID":180868,
                    "prdPrice":10,
                    "promPrice":12,
                    "normalPrice":10,
                    "orderQty":5,
                    "orderItm":"Y",
                    "orderRemark":"test",
                    "prdBrandEnu":"DULUC",
                    "prdBrandZht":"DULUC ZHT",
                    "prdNameEnu":"DULUC DUCRU",
                    "prdNameZht":"DULUC DUCRU ZHT",
                    "prdCode":"",
                    "prdSequence":1,
                    "promotionStatus":false
                }
            ],
            "saveBy":"WebSite",
            "pickupStore":"512"
        }', true);

        dump(MPosWS::addOrder($params));
    }
}
