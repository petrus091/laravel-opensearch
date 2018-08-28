<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2018/8/25
 * Time: 15:41
 */

namespace Kevin\OpenSearch\OpenSearchAbstract;


use OpenSearch\Client\OpenSearchClient;

abstract class OpenSearchAbstract
{
    private $appId;
    private $secret;
    private $host;
    private $options;
    private $client;
    /**
     * OpenSearchAbstract constructor.
     * @param $appId
     * @param $secret
     * @param $host
     * @param $options
     */
    public function __construct($appId,$secret,$host,$options)
    {
        if(!$appId || !$secret || !$host || !$options || !is_array($options))
            throw new \Exception('配置信息不能为空');
        $this->appId = $appId;
        $this->secret = $secret;
        $this->host = $host;
        $this->options = $options;
    }

    abstract public function search($query);

    public function getClient()
    {
        if(!$this->client) {
            $this->client = new OpenSearchClient($this->appId,$this->secret,$this->host,$this->options);
        }
        return $this->client;
    }

    public function parseResult($res)
    {
        $data = json_decode($res->result,true);
        if($data['status'] === 'OK') {
            return $data['result']['items'];
        } else {
            return [];
        }
    }


}