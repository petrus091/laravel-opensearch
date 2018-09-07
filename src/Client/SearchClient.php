<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2018/8/25
 * Time: 15:29
 */

namespace Kevin\OpenSearch\Client;


use Kevin\OpenSearch\Client\Traits\SearchParamsTrait;
use Kevin\OpenSearch\OpenSearchAbstract\OpenSearchAbstract;
use OpenSearch\Client\SearchClient as Client;
use OpenSearch\Util\SearchParamsBuilder;

class SearchClient extends OpenSearchAbstract
{
    private $searchClient;
    private $paramBuilder;
//    private $searchIndex = 'default';
    private $params;
    private $query;
    public function __construct($appId, $secret, $host, $options)
    {
        parent::__construct($appId, $secret, $host, $options);
    }

//    public function setSearchIndex($indexName)
//    {
//        $this->searchIndex = $indexName;
//        return $this;
//    }
    public function search($index,$keyword)
    {
        if(!$this->appName)
            throw new \Exception('请先设置 AppName !');
        $query = $this->getQueryString($index,$keyword);
        $this->query = $query;
        return $this;
    }
    public function orSearch($index,$keyword)
    {
        $query = $this->getQueryString($index,$keyword);
        $this->query = sprintf('%s OR %s',$this->query,$query);
        return $this;
    }
    public function andSearch($index,$keyword)
    {
        $query = $this->getQueryString($index,$keyword);
        $this->query = sprintf('$s AND $s',$this->query,$query);
        return $this;
    }
    public function get(array $fields = [])
    {
        if(count($fields)) {
            $this->getParamsBuilder()->setFetchFields($fields);
        }
        $this->getParamsBuilder()->setQuery($this->query);
        $params = $this->getParamsBuilder()->build();
        $this->params = $params;
        $res = $this->getSearchClient()->execute($this->params);
        $this->initParamsBuilder();
        return $this->parseResult($res);
    }
    protected function parseResult($res)
    {
        $data = json_decode($res->result,true);
        if($data['status'] === 'OK' && count($data['result']['items'])) {
            $arr = [];
            foreach ($data['result']['items'] as $item) {
                $arr[] = $item['fields'];
            }
            return [
                'data'=>$arr,
                'total'=>$data['result']['total']
            ];
        } else {
            return [
                'data'=>[],
                'total'=>0,
            ];
        }
    }

    protected function getParamsBuilder()
    {
        if(!$this->paramBuilder) {
            $this->initParamsBuilder();
        }
        return $this->paramBuilder;
    }
    protected function initParamsBuilder()
    {
        $this->paramBuilder = new SearchParamsBuilder();
        $this->paramBuilder->setFormat('fulljson');
        $this->paramBuilder->setAppName($this->appName);
    }

    protected function getQueryString($index,$keyword)
    {
        $str = sprintf('%s:\'%s\'',$index,$keyword);
        return $str;
    }
    protected function getSearchClient()
    {
        if(!$this->searchClient) {
            $this->searchClient = new Client($this->getClient());
        }
        return $this->searchClient;
    }

}