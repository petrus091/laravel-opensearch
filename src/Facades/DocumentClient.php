<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/9/4
 * Time: 21:15
 */

namespace Kevin\OpenSearch\Facades;


use Illuminate\Support\Facades\Facade;

class DocumentClient extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'opensearch.document_client';
    }
}