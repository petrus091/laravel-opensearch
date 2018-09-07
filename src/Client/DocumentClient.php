<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/9/1
 * Time: 15:21
 */

namespace Kevin\OpenSearch\Client;


use Illuminate\Support\Facades\Log;
use Kevin\OpenSearch\OpenSearchAbstract\OpenSearchAbstract;

class DocumentClient extends OpenSearchAbstract
{
    protected $pushClient;
    const ADD_CMD_FOR_OPENSEARCH = 'ADD';
    const UPDATE_CMD_FOR_OPENSEARCH = 'UPDATE';
    public function getParamsBuilder()
    {
        // TODO: Implement getParamsBuilder() method.
    }
    public function getPushClient()
    {
        if(is_null($this->pushClient)) {
            $this->initPushClient();
        }
        return $this->pushClient;
    }
    public function initPushClient()
    {
        $this->pushClient = new \OpenSearch\Client\DocumentClient($this->getClient());
    }

    /**
     * 除了push()方法，其他方法只是增加数据到 client buffer中，没有正式提交到服务端，只有调用了commit方法才会被提交到服务端。
     * 可以add/update/remove多次，然后调用commit() 统一提交。
     * @param array $fields
     * @return $this
     */
    public function __call($name,$arguments)
    {
        $ret = $this->getPushClient()->$name(...$arguments);
        return $this;
    }
    public function push($json,$tableName)
    {
        $ret = $this->getPushClient()->push($json,$this->appName,$tableName);
        $res = json_decode($ret->result,true);
        $this->initPushClient();
        return $res;
    }
    public function commit($tableName)
    {
        Log::info('Doc Array',$this->getPushClient()->docs);
        $ret = $this->getPushClient()->commit($this->appName,$tableName);
        $res = json_decode($ret->result,true);
        $this->initPushClient();
        return $res;
    }
}