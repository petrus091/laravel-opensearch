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
    use SearchParamsTrait;
    private $searchClient;
    private $paramBuilder;
    private $appName;
    private $searchIndex = 'default';
    private $params;
    public function __construct($appId, $secret, $host, $options)
    {
        parent::__construct($appId, $secret, $host, $options);
    }

    public function setSearchIndex($indexName)
    {
        $this->searchIndex = $indexName;
        return $this;
    }
    public function search($string)
    {
        if(!$this->appName)
            throw new \InvalidArgumentException();
        $query = $this->getQueryString($string);
        $this->getParamsBuilder()->setQuery($query);
        $params = $this->getParamsBuilder()->build();
        $this->params = $params;
        return $this;
    }
    public function get(array $fields = [])
    {
        if(count($fields)) {
            $this->getParamsBuilder()->setFetchFields($fields);
        }
        $res = $this->getSearchClient()->execute($this->params);
        return $this->parseResult($res);
    }
    protected function getParamsBuilder()
    {
        if(!$this->paramBuilder) {
            $this->paramBuilder = new SearchParamsBuilder();
            $this->paramBuilder->setFormat('fulljson');
        }
        return $this->paramBuilder;
    }

    protected function getQueryString($string)
    {
        return sprintf('%s:\'%s\'',$this->searchIndex,$string);
    }
    protected function getSearchClient()
    {
        if(!$this->searchClient) {
            $this->searchClient = new Client($this->getClient());
        }
        return $this->searchClient;
    }

}