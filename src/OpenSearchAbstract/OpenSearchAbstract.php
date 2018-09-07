<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2018/8/25
 * Time: 15:41
 */

namespace Kevin\OpenSearch\OpenSearchAbstract;


use Kevin\OpenSearch\OpenSearchAbstract\Traits\SearchParamsTrait;
use OpenSearch\Client\OpenSearchClient;

abstract class OpenSearchAbstract
{
    use SearchParamsTrait;
    protected $appId;
    protected $secret;
    protected $host;
    protected $appName;
    protected $options;
    protected $client;
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

    public function getClient()
    {
        if(!$this->client) {
            $this->client = new OpenSearchClient($this->appId,$this->secret,$this->host,$this->options);
        }
        return $this->client;
    }
    abstract protected function getParamsBuilder();


}