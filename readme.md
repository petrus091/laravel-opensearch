# OpenSearch 搜索服务
## 使用
 * `php artisan vendor:publish --provider="App\Libs\OpenSearch\src\OpenSearchProvider"` 发布配置
 * `config/opensearch.php` 中配置相关信息
 * $params 调用方法参考阿里云 `opensearch`的 `SearchParamsBuilder`
```php
        $searchClient = app('opensearch.search_client');
        $params = $searchClient->getParamsBuilder();
        $params->setStart(0);
        $params->setHits(20);
        $res = $searchClient->search('水');
```
 * 通过外观调用,支持链式调用
```php
        SearchClient::limit(0,20)->search('水')->get(['id','title_zn_cn']);
```

 * 参数设置方法参照原 `SearchParamsBuilder` 类方法,有以及变更需注意(!!!):
  * `setCustomConfig` 方法 参数 改为 array 形式,如 `['key'=>'value']`
  * `addDistinct` 方法 参数 改为 array 形式,如上
  * `addSummary` 方法 参数 改为 array , 如 `[$summary1,$summary2]`
  * `setCustomParam` 改为 `setCustomParams` ,参数改为 array 形式
 
 * response 示例:
 ```php
 array:5 [
   "status" => "OK"
   "request_id" => "153520292619726881645658"
   "result" => array:7 [
     "searchtime" => 0.046414
     "total" => 3941
     "num" => 20
     "viewtotal" => 3941
     "compute_cost" => array:1 [
       0 => array:2 [
         "index_name" => "Semillion_PreProduct"
         "value" => 2.274
       ]
     ]
     "items" => array:20 [
       0 => array:5 [
         "fields" => array:4 [
           "id" => "28456"
           "prod_id" => "43768"
           "title_zh_cn" => "水水动人柔肤水BREATH OF FRESH AIR"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1272144616"
         ]
       ]
       1 => array:5 [
         "fields" => array:4 [
           "id" => "6320"
           "prod_id" => "6927"
           "title_zh_cn" => "温泉水卸妆水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.113572903"
         ]
       ]
       2 => array:5 [
         "fields" => array:4 [
           "id" => "1052"
           "prod_id" => "1067"
           "title_zh_cn" => "波利尼西亚泻湖水保湿水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1133897901"
         ]
       ]
       3 => array:5 [
         "fields" => array:4 [
           "id" => "19233"
           "prod_id" => "20494"
           "title_zh_cn" => "水颜柔润爽肤水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1133897901"
         ]
       ]
       4 => array:5 [
         "fields" => array:4 [
           "id" => "20678"
           "prod_id" => "21939"
           "title_zh_cn" => "男士水动力爽肤水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1133897901"
         ]
       ]
       5 => array:5 [
         "fields" => array:4 [
           "id" => "20635"
           "prod_id" => "21896"
           "title_zh_cn" => "水滢光感美白水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1133897901"
         ]
       ]
       6 => array:5 [
         "fields" => array:4 [
           "id" => "19250"
           "prod_id" => "20511"
           "title_zh_cn" => "水颜清爽爽肤水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1133897901"
         ]
       ]
       7 => array:5 [
         "fields" => array:4 [
           "id" => "4820"
           "prod_id" => "5258"
           "title_zh_cn" => "水清颜水动力柔肤水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1133897901"
         ]
       ]
       8 => array:5 [
         "fields" => array:4 [
           "id" => "18240"
           "prod_id" => "19501"
           "title_zh_cn" => "拱辰享水 水沄喷雾"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1133897901"
         ]
       ]
       9 => array:5 [
         "fields" => array:4 [
           "id" => "19221"
           "prod_id" => "20482"
           "title_zh_cn" => "水颜平衡爽肤水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1133897901"
         ]
       ]
       10 => array:5 [
         "fields" => array:4 [
           "id" => "648"
           "prod_id" => "663"
           "title_zh_cn" => "本然水喷雾保湿水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1133897901"
         ]
       ]
       11 => array:5 [
         "fields" => array:4 [
           "id" => "16827"
           "prod_id" => "18088"
           "title_zh_cn" => "极水维生素C爽肤水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1132066846"
         ]
       ]
       12 => array:5 [
         "fields" => array:4 [
           "id" => "18184"
           "prod_id" => "19445"
           "title_zh_cn" => "拱辰享水 水沄平衡液"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1132066846"
         ]
       ]
       13 => array:5 [
         "fields" => array:4 [
           "id" => "6484"
           "prod_id" => "7091"
           "title_zh_cn" => "青苹果碳酸水爽肤水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1132066846"
         ]
       ]
       14 => array:5 [
         "fields" => array:4 [
           "id" => "5801"
           "prod_id" => "6407"
           "title_zh_cn" => "男士水颜呼吸爽肤水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1132066846"
         ]
       ]
       15 => array:5 [
         "fields" => array:4 [
           "id" => "3558"
           "prod_id" => "3873"
           "title_zh_cn" => "米水清亮美白卸妆水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1132066846"
         ]
       ]
       16 => array:5 [
         "fields" => array:4 [
           "id" => "25821"
           "prod_id" => "41133"
           "title_zh_cn" => "鲜果C水水唇漾"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1132066846"
         ]
       ]
       17 => array:5 [
         "fields" => array:4 [
           "id" => "18202"
           "prod_id" => "19463"
           "title_zh_cn" => "拱辰享水 水沄平衡乳"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1132066846"
         ]
       ]
       18 => array:5 [
         "fields" => array:4 [
           "id" => "18183"
           "prod_id" => "19444"
           "title_zh_cn" => "拱辰享水 水沄精华露"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1132066846"
         ]
       ]
       19 => array:5 [
         "fields" => array:4 [
           "id" => "8763"
           "prod_id" => "9690"
           "title_zh_cn" => "水满胶原焕活弹力保湿水"
           "index_name" => "Semillion_PreProduct"
         ]
         "property" => []
         "attribute" => []
         "variableValue" => []
         "sortExprValues" => array:1 [
           0 => "10000.1130388379"
         ]
       ]
     ]
     "facet" => []
   ]
   "errors" => []
   "tracer" => ""
 ]
 ```# laravel-opensearch
