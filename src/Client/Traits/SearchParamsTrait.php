<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 2018/8/26
 * Time: 11:35
 */

namespace Kevin\OpenSearch\Client\Traits;


use OpenSearch\Util\SearchParamsBuilder;

trait SearchParamsTrait
{
    /**
     * 合并 setStart 及 setHits
     * @Date: 2018/8/26
     * @User: Kevin
     * @param $start
     * @param $count
     * @return $this
     */
    public function limit($start,$count)
    {
        $this->setStart($start);
        $this->setHits($count);
        return $this;
    }
    public function setStart($start)
    {
        $this->getParamsBuilder()->setStart($start);
        return $this;
    }
    public function setHits($count)
    {
        $this->getParamsBuilder()->setHits($count);
        return $this;
    }
    public function setAppName($name)
    {
        $this->appName = $name;
        $this->getParamsBuilder()->setAppName($name);
        return $this;
    }
    public function setFormat($format)
    {
        $this->getParamsBuilder()->setFormat($format);
        return $this;
    }
    public function setKvPairs($kvpairs)
    {
        $this->getParamsBuilder()->setKvPairs($kvpairs);
        return $this;
    }
    public function setFetchFields($fetchFields)
    {
        $this->getParamsBuilder()->setFetchFields($fetchFields);
        return $this;
    }
    public function setRouteValue($routeValue)
    {
        $this->getParamsBuilder()->setRouteValue($routeValue);
        return $this;
    }

    /**
     * 修改原 key-value 形式为 array
     * @Date: 2018/8/26
     * @User: Kevin
     * @param array $config
     * @return $this
     */
    public function setCustomConfig(array $config)
    {
        foreach ($config as $k=>$v) {
            $this->getParamsBuilder()->setCustomConfig($k,$v);
        }
        return $this;
    }
    public function setFilter($filter)
    {
        $this->getParamsBuilder()->setFilter($filter);
        return $this;
    }
    public function addFilter($filter,$condition = 'AND')
    {
        $this->getParamsBuilder()->addFilter($filter,$condition);
        return $this;
    }
    public function addSort(array $sort)
    {
        foreach ($sort as $s) {
            if (!isset($s['order'])) {
                $s['order'] = SearchParamsBuilder::SORT_DECREASE;
            }
            $this->getParamsBuilder()->addSort($s['field'], $s['order']);
        }
        return $this;
    }
    public function setFirstRankName($firstRankName)
    {
        $this->getParamsBuilder()->setFIrstRankName($firstRankName);
        return $this;
    }
    public function setSecondRankName($secondRankName)
    {
        $this->getParamsBuilder()->setSecondRankName($secondRankName);
        return $this;
    }
    public function addAggregate($aggregate)
    {
        if(isset($aggregate['groupKey'])) {
            $this->getParamsBuilder()->addAggregate($aggregate);
        } else if (isset($aggregate[0])) {
            foreach ($aggregate as $v) {
                $this->getParamsBuilder()->addAggregate($v);
            }
        }
        return $this;
    }

    /**
     * @Date: 2018/8/26
     * @User: Kevin
     * @param $distinct
     * @return $this
     * Key - Value
     */
    public function addDistinct($distinct)
    {
        if(isset($distinct[0])) {
            foreach ($distinct as $v) {
                $this->getParamsBuilder()->addDistinct($v);
            }
        } else if ($distinct['key']) {
            $this->getParamsBuilder()->addDistinct($distinct);
        }
        return $this;
    }

    /**
     * @Date: 2018/8/26
     * @User: Kevin
     * @param array $summaries
     * @return $this
     */
    public function addSummary(array $summaries)
    {
        foreach ($summaries as $summary) {
            $this->getParamsBuilder()->addSummary($summary);
        }
        return $this;
    }
    public function addQueryProcessor($qp)
    {
        if(is_array($qp)) {
            $qp = array($qp);
        }
        foreach ($qp as $v) {
            $this->getParamsBuilder()->addQueryProcessor($v);
        }
        return $this;
    }
    public function addDisableFunctions($disableFunctions)
    {
        if(is_array($disableFunctions)) {
            foreach ($disableFunctions as $fun) {
                $this->getParamsBuilder()->addDisableFunctions($fun);
            }
        } else {
            $this->getParamsBuilder()->addDisableFunctions($disableFunctions);
        }
    }
    public function setCustomParams(array $customParams)
    {
        if(is_array($customParams)) {
            foreach ($customParams as $k=>$v) {
                $this->getParamsBuilder()->setCustomParam($k,$v);
            }
        }
        return $this;
    }
    public function setReRankSize($reRankSize){
        $this->getParamsBuilder()->setReRankSize($reRankSize);
    }
    public function setScrollExpire($expiredTime)
    {
        $this->getParamsBuilder()->setScrollExpire($expiredTime);
        return $this;
    }
    public function setScrollId($scrollId)
    {
        $this->getParamsBuilder()->setScrollId($scrollId);
        return $this;
    }
}