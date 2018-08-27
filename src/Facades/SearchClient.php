<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2018/8/26
 * Time: 11:29
 */

namespace Kevin\OpenSearch\Facades;


use Illuminate\Support\Facades\Facade;

class SearchClient extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'opensearch.search_client';
    }
}