# 帳密金鑰

各種所需要的帳號密碼金鑰

- Basic Auth user
- Basic Auth password
- APP_ID
- CERTI_ID
- TOKEN

# 名詞介紹

api 常見名詞介紹

## displayFields

代表要显示的内容，如果不清楚具体的 Fields 名，可以通过 `mpos/1.0/service/member/fields`查询，有多个显示的字段以 `；` 隔开，eg `title;firstName`

## queryFields

`keywords` 要查找的位置，查找多个位置用 `；` 隔开

其中 `storeID` 是必要條件，一定要加否則會回傳 `NULL`

## keywords

如果内容对应多个 `queryFields` 以 `;`隔开

條件為 `or` 的关系用 `|` 隔开
條件為 `and` 的关系用 `+` 隔开
條件為范围 `(start，end)` 括起来

## fieldsRelation

`1` 表示多个 `queryFields` 之间是 `and` 关系，默认为 `1`
`0` 表示多个 `queryFields` 之间是 `or` 关系

## currentPage

当前页码

## pageSize

每页数量

## sortFields

排序字段，如果多个排序以`;`隔开

## sortOrders

`ASC` or `DESC`，如果多个排序以`;`隔开


# MEMBER

會員相關的查詢

## Members profile

**url**

`mpos/1.0/service/member/query`

**input**

```js

data = {
    "displayFields": "firstName",
    "keywords": "samuel|kevin",
    "queryFields": "firstName",
    "fieldsRelation": 1,
    "currentPage": 1,
    "pageSize": 10,
    "sortFields": "firstName",
    "sortOrders": "DESC"
}

```

**output**

```js

{
    "message": "处理成功",

    "data": {
        "shoppers":
            [
                {
                    "loginID": null,
                    "title": null,
                    "firstName": "kevin",
                    "lastName": null,
                    "officeTel": null,
                    "phoneNum": null,
                    "mobileNum": null,
                    "emailAddr": null,
                    "addr1": null,
                    "addr2": null,
                    "addr3": null,
                    "districtID": null
                },

                // ...
            ]
        },

        "error_code": "2000",
        "is_success": true,
    },
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:member:query
```


## Member count

**url**

`mpos/1.0/service/member/count`

**input**

```js

data = {
    "keywords": "samuel|kevin",
    "queryFields": "firstName",
    "fieldsRelation": 1
}

```

**output**

```js

{
    "message":"处理成功",
    "data": {
        noOfShoppers: 22
    },
    "error_code":"2000",
    "is_success":true
}

```


**Artisan CLI**

```bash
$ php artisan mpos-ws:member:count
```

## Member Available Fileds

**url**

`mpos/1.0/service/member/fields`

**output**

```js

{
    "message": "处理成功",
    "data": {
        "queryFields": "loginID|title|firstName|lastName|officeTel|phoneNum|mobileNum|emailAddr|addr1|addr2|addr3|districtID"
    },
    "error_code": "2000",
    "is_success": true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:member:fields
```

## Member district detail

`mpos/1.0/service/member/district/query`

**output**

```js

{
    "message":"处理成功",
    "data": {
        "districts": [
            {
                "districtID": "2025",
                "districtNameEnu": "Tsim Sha Tsui",
                "districtNameZht": "尖沙咀",
                "districtNameZhs": "尖沙咀"
            },

            // ...
        ]
    },
    "error_code": "2000",
    "is_success": true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:member:districts
```

## Member Addressbook

> 和 service 的差別是， 這個是查詢該客戶所有的地址

**url**

`mpos/1.0/service/member/addressbook/query`

**input**

```js

data = {
    "keywords": "1"
}

```

**output**

```js

{
    "message":"处理成功",
    "data": {
        "addressbooks": [
            {
                "id": 3841,
                "defaults": false,
                "loginID": 1,
                "title": "Mr",
                "firstName": "Jason",
                "lastName": "Tam",
                "officeTel": "11111111",
                "phoneNum": "11111111",
                "mobileNum": "33333333",
                "emailAddr": null,
                "addr1": "New Street address",
                "addr2": null,
                "addr3": null,
                "districtID": "132"
            },

            //...
        ]
    },
    "error_code": "2000",
    "is_success": true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:member:addressbook
```

# Product

## Product Api 版本

**url**

`mpos/1.0/service/product/version`

**output**

```js

{
    "message":"处理成功",
    "data": {
        "version": 1.0,
        "dataType": "Product"
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:product:version
```

## ProductFileds

**url**

`mpos/1.0/service/product/fields`

**output**

```js

{
    "message":"处理成功",
    "data": {
        "queryFields": "storeID|prdID|prdBrandEnu|prdNameEnu|prdBrandZht|prdNameZht|prdSizeDesc|prdPack|prdStatus|prdPrice|promPrice|mixMatchFlag|pg1ID|pg2ID|pg3ID"
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:product:fields
```


## Product advance fields

**url**

`mpos/1.0/service/product/detail/fields`

**output**

```js

{
    "message":"处理成功",
    "data": {
        "queryFields": "storeID|prdID|prdBrandEnu|prdNameEnu|prdSizeDesc|prdPack|prdStatus|prdPrice|promPrice|productName|country|region|vintage|wineType|grape|body|sweetness|tastingNote|foodMatch|rating|ratingRP|ratingWS|ratingJH|mixMatchFlag|pg1ID|pg2ID|pg3ID|productNameZht|countryZht|regionZht|vintageZht|wineTypeZht|grapeZht|bodyZht|sweetnessZht|tastingNoteZht|foodMatchZht|productNameZhs|countryZhs|regionZhs|vintageZhs|wineTypeZhs|grapeZhs|bodyZhs|sweetnessZhs|tastingNoteZhs|foodMatchZhs"
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:product:fields --detail
```

## Product information

**url**

`mpos/1.0/service/product/query`

**input**

```js

{
    "keywords": "180868;530",
    "displayFields": "prdBrandEnu;prdNameEnu",
    "queryFields": "prdID;storeID",
    "currentPage": 1,
    "pageSize": 10,
    "sortFields": "prdNameEnu",
    "sortOrders": "DESC"
}

```

**output**

```js

{
    "message":"处理成功",
    "data":
        {
            "products": [
                {
                    "prdID": null,
                    "storeID": null,
                    "mixMatchFlag": null,
                    "prdBrandEnu": "DULUC DUCRU",
                    "prdBrandZht": null,
                    "prdNameEnu": "ST JULIEN 2ND WINE 2006",
                    "prdNameZht": null,
                    "prdStatus": null,
                    "prdPrice": null,
                    "promPrice": null,
                    "prdSizeDesc": null,
                    "prdPack": null,
                    "imageflag": "1",
                    "smallImg": "137943_s.gif",
                    "largeImg": "137943_l.jpg",
                    "enlargeImg": "137943_e.jpg",
                    "pg1ID": null,
                    "pg2ID": null,
                    "pg3ID": null
                }
            ]
        },
        "error_code": "2000",
        "is_success": true
    }
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:product:query
```

## Product Count

**url**

`mpos/1.0/service/product/count`

**input**

```js

{
    "keywords": "180868;530",
    "queryFields": "prdID;storeID"
}

```

**output**

```js

{
    "message":"处理成功",
    "data": {
        "noOfProducts": 1
    },
    "error_code":"2000",
    "is_success": true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:product:query
```

## ProductDetail

**url**

`mpos/1.0/service/product/detail/query`

**input**

```js

{
    "keywords": "180868;530",
    "displayFields": "prdBrandEnu;prdNameEnu",
    "queryFields": "prdID;storeID",
    "currentPage": 1,
    "pageSize": 10,
    "sortFields": "prdNameEnu",
    "sortOrders": "DESC"
}

```

**output**

```js

{
    "message":"处理成功",
    "data": {
        "productDetails": [
            {
                "country":null,
                "prdID":null,
                "storeID":null,
                "region": null,
                "mixMatchFlag":null,
                "prdBrandEnu":"DULUC DUCRU",
                "prdNameEnu":"ST JULIEN 2ND WINE 2006",
                "prdStatus":null,
                "prdPrice":null,
                "promPrice":null,
                "prdSizeDesc":null,
                "prdPack":null,
                "body":null,
                "imageflag":"1",
                "smallImg":"137943_s.gif",
                "largeImg":"137943_l.jpg",
                "enlargeImg":"137943_e.jpg",
                "pg1ID":null,
                "pg2ID":null,
                "pg3ID":null,
                "color":null,
                "foodMatch":null,
                "grape":null,
                "productName":null,
                "province":null,
                "ratingRP":null,
                "ratingWS":null,
                "ratingJH":null,
                "sweetness":null,
                "tastingNote":null,
                "vintage":null,
                "bodyZhs":null,
                "bodyZht":null,
                "colorZhs":null,
                "colorZht":null,
                "countryZhs":null,
                "countryZht":null,
                "foodMatchZhs":null,
                "foodMatchZht":null,
                "grapeZhs":null,
                "grapeZht":null,
                "productNameZhs":null,
                "productNameZht":null,
                "provinceZhs":null,
                "provinceZht":null,
                "regionZhs": null,
                "regionZht": null,
                "sweetnessZhs":null,
                "sweetnessZht":null,
                "tastingNoteZhs":null,
                "tastingNoteZht":null,
                "vintageZhs":null,
                "vintageZht":null
            }
        ]
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:product:query --detail
```

## Product Contries

**url**

`mpos/1.0/service/product/countries`

**output**

```js

{
    "message":"处理成功",
    "data": {
        "countries":["France","Germany"]
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:product:countries
```

## Product Regions

**url**

`mpos/1.0/service/product/regions`

**output**

```js

{
    "message": "处理成功",
    "data": {
        "regions": ["Bordeaux","Burgundy"]
    },
    "error_code": "2000",
    "is_success": true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:product:regions
```

## Product Wine Types (酒品種類)

**url**

`mpos/1.0/service/product/winetypes`

**output**

```js

{
    "message":"处理成功",
    "data": {
        "winetypes": ["Still Rose","Red Wine","White Wine"]
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artisan CLI**

## Product Grapes (葡萄品種)

**url**

`mpos/1.0/service/product/grapes`

**output**

```js

{
    "message":"处理成功",
    "data": {
        "grapes":["Cabernet Franc","Cabernet Sauvignon"]
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:product:grapes
```

## Product Vintages (酒品年份)

**url**

`mpos/1.0/service/product/vintages`

**output**

```js

{
    "message":"处理成功",
    "data": {
        "vintages":["1995","1996"]
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:product:vintages
```

## Product Criteria

**url**

`mpos/1.0/service/product/detail/criteria`

**input**

```js

{
    "keywords":"DEC_PROMO;530",
    "queryFields":"groupID;storeID"
}

```

**output**

```js

{
    "message":"处理成功",
    "data": {
        "grapes":["Cabernet Sauvignon and Blends"],
        "countries":["France"],
        "regions":["St. Julien"],
        "vintages":["2006"],
        "winetypes":["Red"],
        "prices":[255],
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artisan CLI**

```bash

```

# SHOPCART

## Add product

**url**

`mpos/1.0/service/shopcart/add`

**input**

```js

{
    "prdID":180868,
    "storeID":"530",
    "shopQty":5,
    "saveBy":"website"
    "shopUUID": 'YourShopUUID', // 如果未傳入則由 Web Service 自行產生
}

```

**output**

```js

{
    "message":"处理成功",
    "data": {
        "storeID":"530",
        "shopUUID":"dbf2166664754c3db8557e836e9554f0",
        "totalAmt":1275,
        "itemCount":1,
        "shopcartTime":1519266101478,
        "shopcartItems":[
            {
                "prdID":180868,
                "shopQty":5,
                "mixMatchFlag":"0",
                "prdBrandEnu":"DULUC DUCRU",
                "prdBrandZht":" ",
                "prdNameEnu":"ST JULIEN 2ND WINE 2006",
                "prdNameZht":" ",
                "prdStatus":"A",
                "prdPrice":255,
                "promPrice":null,
                "prdSizeDesc":"75CL",
                "prdPack":"U"
            }
        ]
    },
    "error_code":"2000",
    "is_success":true
}

```


**Artisan CLI**

```bash
$ php artisan mpos-ws:cart:add
```

## View cart

**url**

`mpos/1.0/service/shopcart/query`

**input**

```js

{
    "shopUUID":"dbf2166664754c3db8557e836e9554f0",
    "storeID":"530"
}

```

**output**

```js

{
    "message":"处理成功",
    "data":{
        "storeID":"530",
        "shopUUID":"dbf2166664754c3db8557e836e9554f0",
        "totalAmt":1275,
        "itemCount":1,
        "shopcartTime":1519266302012,
        "shopcartItems":[
            {
                "prdID":180868,
                "shopQty":5,
                "mixMatchFlag":"0",
                "prdBrandEnu":"DULUC DUCRU",
                "prdBrandZht":" ",
                "prdNameEnu":"ST JULIEN 2ND WINE 2006",
                "prdNameZht":" ",
                "prdStatus":"A",
                "prdPrice":255,
                "promPrice":null,
                "prdSizeDesc":"75CL",
                "prdPack":"U"
            }
        ]
    },
    "error_code":"2000",
    "is_success":true
}

```


**Artisan CLI**

```bash
$ php artisan mpos-ws:cart:view
```

# Remove product from cart

**url**

`mpos/1.0/service/shopcart/remove`

**input**

```js

{
    "shopUUID":"dbf2166664754c3db8557e836e9554f0",
    "prdID":180868,
    "shopQty":3,
    "storeID":"530",
    "saveBy":"website"
}

```

**output**

> 缺少product or qty代表清空shopcart

```js

{
    "message":"处理成功",
    "data":{
        "storeID":"530",
        "shopUUID":"dbf2166664754c3db8557e836e9554f0",
        "totalAmt":510,
        "itemCount":1,
        "shopcartTime":1519266640395,
        "shopcartItems":[
            {
                "prdID":180868,
                "shopQty":2,
                "mixMatchFlag":"0",
                "prdBrandEnu":"DULUC DUCRU",
                "prdBrandZht":" ",
                "prdNameEnu":"ST JULIEN 2ND WINE 2006",
                "prdNameZht":" ",
                "prdStatus":"A",
                "prdPrice":255,
                "promPrice":null,
                "prdSizeDesc":"75CL",
                "prdPack":"U"
            }
        ]
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artisan CLI**

```bash
$ php artisan mpos-ws:cart:remove
```

# Order

## Order  available fields

**url**
`http://dev.vigasia.com/mpos/1.0/service/order/fields`

**output**

```js

{
    "message":"处理成功",
    "data": {
        "queryFields":"orderID|membershipType|orderDateR|acctType|orderAmt|loginID|shipTitle|discount|shipFirstName|shipLastName|shipAddr1|shipAddr2|shipAddr3|shipDistID|shipDistName|shipPhoneNo|shipFaxNo|shipMobileNo|billTitle|billFirstName|billLastName|billCompany|billAddr1|billAddr2|billAddr3|billDistID|billDistName|billPhoneNo|billFaxNo|billMobileNo|billEmail|payment|drawerName|cardNo|cardExpire|deliverDate|deliverTime|deliverStoreID|specialInstruction|orderStatus|deliveryCharge|umiCardNo|saveBy|pickupStore"
    },
    "error_code":"2000",
    "is_success":true
}


```

## Order item available fields

**url**
`http://dev.vigasia.com/mpos/1.0/service/order/item/fields`

**output**

```js

{
    "message":"处理成功",
    "data":{
        "queryFields":"orderID|prdID|prdPrice|promPrice|normalPrice|orderQty|orderItm|orderRemark|prdBrandEnu|prdBrandZht|prdNameEnu|prdNameZht|prdCode|prdSequence|promotionStatus"
    },
    "error_code":"2000",
    "is_success":true
}

```

## Create order
**url**
`http://dev.vigasia.com/mpos/1.0/service/order/add`

**input** 

(不能附帶 orderID, items 一定要有)

```js

{
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
}

```

**output**

```js

{
    "message":"处理成功",
    "data": {
        "orderID":163100000000012
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artiasan CLI**

```bash
$ php artisan mpos-ws:order:create
```


## Query for orders

(測試一下有無 currentPage, pageSize 等參數)

**url**
`http://dev.vigasia.com/mpos/1.0/service/order/query`

**input**


```js

{
    "keywords":"163100000000012",
    "queryFields":"orderID",
    "displayFields":`
        orderID;
        membershipType;
        orderDate;acctType;
        orderAmt;
        loginID;
        shipTitle;
        discount;
        shipFirstName;
        shipLastName;
        shipAddr1;
        shipAddr2;
        shipAddr3;
        shipDistID;
        shipDistName;
        shipPhoneNo;
        shipFaxNo;
        shipMobileNo;
        billTitle;
        billFirstName;
        billLastName;
        billCompany;
        billAddr1;
        billAddr2;
        billAddr3;
        billDistID;
        billDistName;
        billPhoneNo;
        billFaxNo;
        billMobileNo;
        billEmail;
        payment;
        drawerName;
        cardNo;
        cardExpire;
        deliverDate;
        deliverTime;
        deliverStoreID;
        specialInstruction;
        orderStatus;
        deliveryCharge;
        umiCardNo;
        saveBy;
        pickupStore`
}

```

**output**

```js

{
    "message":"处理成功",
    "data": {
        "orderHeaders":[
            {
                "saveBy":"WebSite",
                "orderItems":null,
                "orderID":163100000000012,
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
                "orderDate":"20180228",
                "orderStatus":"Ordered",
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
                "pickupStore":"512"
            }
        ]
    },
    "error_code":"2000",
    "is_success":true
}

```

**Artiasan CLI**

```bash
$ php artisan mpos-ws:order:query
```


## Order count
**url**
`http://dev.vigasia.com/mpos/1.0/service/order/count`

**input**

```js

{
    "keywords":"163100000000012",
    "queryFields":"orderID"
}

```

**output**

```js

{
    "message":"处理成功",
    "data": {
        "noOfOrderHeaders":1
    },
    "error_code":"2000",
    "is_success":true
}

```

## Get specific order item

**url**
`http://dev.vigasia.com/mpos/1.0/service/order/item/query`

**input**

```js

{
    "keywords":"163100000000012",
    "queryFields":"orderID",
    "displayFields":"orderID;prdID;prdPrice;promPrice;normalPrice;orderQty;orderItm;orderRemark;prdBrandEnu;prdBrandZht;prdNameEnu;prdNameZht;prdCode;prdSequence;promotionStatus"
}

```
**output**

```js

{
    "message":"处理成功",
    "data":{
        "orderItems":[
            {
                "prdID":180868,
                "orderID":163100000000012,
                "prdBrandEnu":"DULUC",
                "prdBrandZht":"DULUC ZHT",
                "prdNameEnu":"DULUC DUCRU",
                "prdNameZht":"DULUC DUCRU ZHT",
                "prdPrice":10,
                "promPrice":12,
                "normalPrice":10,
                "orderQty":5,
                "orderItm":"Y",
                "orderRemark":"test",
                "prdCode":null,
                "prdSequence":1,
                "promotionStatus":false
            }
        ]
    },
    "error_code":"2000",
    "is_success":true
}
```

**Artiasan CLI**

```bash
$ php artisan mpos-ws:order:item
```

## Order time slots (確定是送貨時間? 那 input 是?)

**url**
`http://dev.vigasia.com/mpos/1.0/service/order/timeslots`

**input**
**output**

```js

{
    "message":"处理成功",
    "data":{
        "timeslots":["10:00AM - 02:00PM"]
    },
    "error_code":"2000",
    "is_success":true
}

```

## Order delivery methods
**url**
`http://dev.vigasia.com/mpos/1.0/service/order/deliverymethods`

**input**


**output**

```js

{
    "message":"处理成功",
    "data": {
        "deliverymethods":[
            {
                deliverymethodCode:"VISAMasterCard",
                deliverymethodValue:"VISA / MasterCard"
            },

            {
                deliverymethodCode:"UnionPay",
                deliverymethodValue:"UnionPay"
            },

            {
                deliverymethodCode:"americanExpress",
                deliverymethodValue:"American Express"
            }
        ]
    },
    "error_code":"2000",
    "is_success":true
}

```


# Stock

**url**
`http://dev.vigasia.com/mpos/1.0/service/stock/query`

**input**

```js
{
    storeID: 530,
    prdID: 361396,
}
```

**output**

```js

{
    message:"处理成功",
    data: {
        "prdID":361396,
        "storeID":"530",
        "minStockLevel":0,
        "actualStock":200,
        "saleStock":2,
        "cardStock":198
    },
    "error_code": "2000",
    "is_success": true
}

```

**Artisan CLI**

```bash

$ php artisan mpos-ws:product:stock

```

# Promotion -（需要上uat才有测试数据）

**url**
`http://dev.vigasia.com/mpos/1.0/service/promo/query`

**input**

```js

{
    "items":[
        {
            "barcode":"5000185005895",
            "qty":2,
            "seqNo":1
        },
        {
            "barcode":"4892368653389",
            "qty":2,
            "seqNo":2
        }
    ],
    "storeID":"10",
    "memberNo":"2599030179292",
    "posNo":"99",
    "transNo":"1234",
    "languageID":7
}

```

**output**

```js

{
    "message":"处理成功",
    "data": {
        "responseCode":"BPG99",
        "storeID":"10",
        "items":[
            {
                "barcode":"5000185005895",
                "qty":2,
                "seqNo":1,
                "promotions":[]
            },

            {
                "barcode":"4892368653389",
                "qty":2,
                "seqNo":2,
                "promotions":[]
            }
        ],

        "promotions":[],
        "missedPromotions":[],
        "totalAmount":null,
        "totalDiscountAmt":null
    },
    "error_code":"2000",
    "is_success":true
}

// 成功例子
{  
   "storeID":"999",
   "responseCode":"00",
   "totalAmount":810,
   "totalDiscountAmt":190,
   "items":[
      {
         "seqNo":1,
         "barcode":"6942074242372",
         "qty":1, 
         "errorCode":"00",
         "itemCode":"100208101",
         "description":"屈臣氏多效?理牙?棒",
         "additionalInfo":"",
         "rtlPrice":1000,
         "deptDesc":"Oral",
         "subDeptDesc":"lOral Strips & S",
         "itemDiscount":190,
         "promotions":[
            {
               "promoNo":"700123481",
               "promoDesc":"SAVE 10%",
               "amountDisplayRule":"Money",
               "apportValue":100,
               "rewardType":"15",
               "rewardAmount":0
            },
            {
               "promoNo":"700123423",
               "promoDesc":"會員即享9折優惠",
               "amountDisplayRule":"Money",
               "apportValue":90,
               "rewardType":"15",
               "rewardAmount":0
            }
         ]
      },
      {
         "seqNo":2,
         "barcode":"1234567724678",
         "qty":2,
         "errorCode":"01"
      }
   ],
   "promotions":[
      {
         "promoType":"2",
         "promoNo":"700123481",
         "promoDesc":"SAVE 10%",
         "rewardType":"13",
         "apportionmentType":"1",
         "amountDisplayRule":"Money",
         "rewardAmount":100
      },
      {
         "promoType":"2",
         "promoNo":"700123423",
         "promoDesc":"會員即享9折優惠",
         "rewardType":"13",
         "apportionmentType":"1",
         "amountDisplayRule":"Money",
         "rewardAmount":90
      },
      {
         "promoType":"2",
         "promoNo":"300395",
         "promoDesc":"Double Point on Seleted Date",
         "rewardType":"19",
         "apportionmentType":"4",
         "amountDisplayRule":"Money",
         "rewardAmount":0
      }
   ],
   "missedPromotions":[
      {
         "description":"3 FOR 33% OFF MIX AND MATCH",
         "ticketLevel":"0",
         "missedPromotionItems":[
            {
               "plu":"100014207",
               "pluDesc":"佳洁士防蛀牙膏140克",
               "pluRtlPrice":550
            }
         ]
      }
   ] 
}

```

# Promotion List

**url**
`http://dev.vigasia.com/mpos/1.0/service/promo/list`

**output**

```js

{
    "message":"处理成功",
    "data":{
        "promotions":[
            {
                "promoId":"163547001",
                "promoDescription": [
                    {
                        "description":"Buy 3 Save $.8",
                        "languageId":"0"
                    },

                    {
                        "description":"買3慳$.8",
                        "languageId":"7"
                    },

                    {
                        "description":"买3悭$.8",
                        "languageId":"8"
                    }
                ]
            },

            {
                "promoId":"163678001",
                "promoDescription": [
                    {
                        "description":"Buy 2 Save $5.9",
                        "languageId":"0"
                    },

                    {
                        "description":"買2慳$5.9",
                        "languageId":"7"
                    },

                    {
                        "description":"买2悭$5.9",
                        "languageId":"8"
                    }
                ]
            },

            {
                "promoId":"163696001",
                "promoDescription":[
                    {
                        "description":"Buy 2 Save $3.1",
                        "languageId":"0"
                    },

                    {
                        "description":"買2慳$3.1",
                        "languageId":"7"
                    },

                    {
                        "description":"买2悭$3.1",
                        "languageId":"8"
                    }
                ]
            },

            {
                "promoId":"21637712163",
                "promoDescription":[
                    {
                        "description":"Buy 2 Save $21",
                        "languageId":"0"
                    },

                    {
                        "description":"買2慳$21",
                        "languageId":"7"
                    },

                    {
                        "description":"买2悭$21",
                        "languageId":"8"
                    }
                ]
            }
        ]
    },
    "error_code":"2000",
    "is_success":true
}


```



# Payment-wirecard 

## link

**url**
`http://dev.vigasia.com/mpos/1.0/service/payment/wirecard/link`

**input**

```js

{
    "orderID":163200000001,
    "saveBy":"WebSite",
    "redirectUrl":"http://localhost:8080/payment/payServlet2",
    "amt":"5.01"
}

```

**output**

```js

{
    "message":"处理成功",
    "data":"<script language=\"javascript\">window.onload=function(){document.pay_form.submit();}</script>\n<form id=\"pay_form\" name=\"pay_form\" action=\"https://test.wirecard.com.sg/engine/hpp/\" method=\"post\">\n<input type=\"hidden\" name=\"redirect_url\" id=\"redirect_url\" value=\"http://localhost:8080/payment/payServlet2\">\n<input type=\"hidden\" name=\"merchant_account_id\" id=\"merchant_account_id\" value=\"92ae4548-354f-4d73-b46a-59458dd1ef6c\">\n<input type=\"hidden\" name=\"ip_address\" id=\"ip_address\" value=\"\">\n<input type=\"hidden\" name=\"request_id\" id=\"request_id\" value=\"PWC15234171829615689\">\n<input type=\"hidden\" name=\"requested_amount_currency\" id=\"requested_amount_currency\" value=\"HKD\">\n<input type=\"hidden\" name=\"requested_amount\" id=\"requested_amount\" value=\"5.01\">\n<input type=\"hidden\" name=\"request_signature\" id=\"request_signature\" value=\"f6939b666e7181ee32b1ec16e37404993e6431f7d34ee1f2f2ec54c457e2640a\">\n<input type=\"hidden\" name=\"transaction_type\" id=\"transaction_type\" value=\"purchase\">\n<input type=\"hidden\" name=\"request_time_stamp\" id=\"request_time_stamp\" value=\"20180411032622\">\n<input type=\"hidden\" name=\"locale\" id=\"locale\" value=\"en\">\n<input type=\"hidden\" name=\"transaction_id\" id=\"transaction_id\" value=\"72f36024-38e1-4631-9a34-4ba4e2e575ae\">\n</form>\n",
    "error_code":"2000",
    "is_success":true
}

```


## Payment feedback

**url**
`http://dev.vigasia.com/mpos/1.0/service/payment/wirecard/feedback`

**input**

```js

transaction_type=purchase
&status_code_1=201.0000
&status_severity_1=information
&completion_time_stamp=20180404022950
&status_code_2=500.1999
&status_severity_2=error
&status_code_3=999.9999
&status_severity_3=error
&transaction_state=failed
&token_id=4119841438560001
&merchant_account_id=92ae4548-354f-4d73-b46a-59458dd1ef6c
&first_name=test
&requested_amount_currency=HKD
&status_description_1=3d-acquirer:The resource was successfully created.
&masked_account_number=400555******0001
&status_description_2=3d-acquirer:The acquirer returned an unknown response.  Contact Technical Support.  
&status_description_3=System error
&browser_hostname=192.168.10.20
&provider_status_code_2=
&provider_status_code_1=
&browser_os=Windows 7
&response_signature=49ea944e8912f9127983703e77ac71bfacf76ee57dc0014ac0f49fc719898c16
&group_transaction_id=9a7faae1-e5f0-41df-a131-9b7769cba18d
&browser_ip_address=192.168.10.20
&provider_account_id=20150902005
&response_signature_v2=SFMyNTYKdHJhbnNhY3Rpb25faWQ9MDI4ODY0NjgtZTkyNC00ODAwLTkwOTYtNWY0NmIwNWE4ZTFkCmNvbXBsZXRpb25fdGltZXN0YW1wPTIwMTgwNDA0MDIyOTUwCm1hc2tlZF9hY2NvdW50X251bWJlcj00MDA1NTUqKioqKiowMDAxCnRva2VuX2lkPTQxMTk4NDE0Mzg1NjAwMDEKYXV0aG9yaXphdGlvbl9jb2RlPQptZXJjaGFudF9hY2NvdW50X2lkPTkyYWU0NTQ4LTM1NGYtNGQ3My1iNDZhLTU5NDU4ZGQxZWY2Ywp0cmFuc2FjdGlvbl9zdGF0ZT1mYWlsZWQKaXBfYWRkcmVzcz0KdHJhbnNhY3Rpb25fdHlwZT1wdXJjaGFzZQpyZXF1ZXN0X2lkPVBXQzE1MjI4MDg4Nzc5NDMyNTEK.s5r1U/nblIBM5CP2jOPVEB0SW6XfJRGIL+kM/iO33iQ=
&provider_status_description_1=
&transaction_id=02886468-e924-4800-9096-5f46b05a8e1d
&provider_status_code_3=
&provider_status_description_2=
&browser_version=65.0.3325.181
&provider_status_description_3=
&ip_address=&request_id=PWC1522808877943251
&provider_transaction_reference_id=
&requested_amount=5.01
&provider_transaction_id_3=
&provider_transaction_id_1=
&provider_transaction_id_2=
&last_name=test
&merchant_account_resolver_category=
&authorization_code=
&save_by=web

```

**output**

```js

{
    "message":"处理成功",
    "data":"201.0000",
    "error_code":"2000",
    "is_success":true
}

```

