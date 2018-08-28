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
    function __call($name, $arguments)
    {
        try {
            $this->getParamsBuilder()->$name(...$arguments);
        } catch (\Exception $e) {

        }
        return $this;
    }

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
    public function setAppName($name)
    {
        $this->appName = $name;
        $this->getParamsBuilder()->setAppName($name);
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
}