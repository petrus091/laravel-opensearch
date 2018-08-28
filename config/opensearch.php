<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2018/8/25
 * Time: 15:05
 */
return [
    'accessKeyId'=>env('OPENSEARCH_ACCESS_KEY_ID',''),
    'secret'=>env('OPENSEARCH_SECRET',''),
    'endPoint'=>env('OPENSEARCH_END_POINT',''),
    'appName'=>env('OPENSEARCH_APP_NAME',''),
    'suggestName'=>env('OPENSEARCH_SUGGEST_NAME',''),
    'options'=>[
        'debug'=>env('OPENSEARCH_DEBUG',false),
//        'gzip'=>'',
//        'timeout'=>'',
//        'connectTimeout'=>'',
        'per_page_num'=>20,
    ],
];