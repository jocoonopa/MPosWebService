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

代表要显示的内容，如果不清楚具体的 Fields 名，可以通过 `mpos/service/member/fields`查询，有多个显示的字段以 `；` 隔开，eg `title;firstName`

## queryFields

`keywords` 要查找的位置，查找多个位置用 `；` 隔开

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

`mpos/service/member/query`

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

`mpos/service/member/count`

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

`mpos/service/member/fields`

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

`mpos/service/member/district/query`

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

`mpos/service/member/addressbook/query`

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

`mpos/service/product/version`

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

`mpos/service/product/fields`

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

`mpos/service/product/detail/fields`

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

`mpos/service/product/query`

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

`mpos/service/product/count`

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

`mpos/service/product/detail/query`

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

`mpos/service/product/countries`

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

`mpos/service/product/regions`

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

`mpos/service/product/winetypes`

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

`mpos/service/product/grapes`

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

`mpos/service/product/vintages`

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

# SHOPCART

## Add product

**url**

`mpos/service/shopcart/add`

**input**

```js

{
    "prdID":180868,
    "storeID":"530",
    "shopQty":5,
    "saveBy":"website"
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

## View cart

**url**

`mpos/service/shopcart/query`

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

# Remove product from cart

**url**

`mpos/service/shopcart/remove`

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
