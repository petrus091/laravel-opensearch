# laravel-opensearch
阿里云开放搜索服务 SDK For Laravel
> PHP7.2 已弃用 each 函数,阿里云 SDK 部分做了相关改动,其余部份保持原 SDK

## 安装
目前开发版本中暂放入 `packages` 文件夹中进行开发集成,待版本稳定可发布 package 包
 * laravel 5.5及以上已集成包自动发现,无需手动注册服务提供者及外观
 * 本地开发版本通过设置 composer path 属性加载本地包
 * `composer.json`中添加如下配置:
 ```json
    "repositories": [
        {
            "type": "path",
            "url": "packages/opensearch"
        }
    ]
```
 * 使用 `composer require` 加载包(`composer require kevin/laravel-opensearch:dev-master`)

##  SearchClient 搜索服务
### 使用
 * `php artisan vendor:publish --provider="Kevin\OpenSearch\OpenSearchProvider"` 发布配置
 * `config/opensearch.php` 中配置相关信息
 * $params 调用方法参考阿里云 `opensearch`的 `SearchParamsBuilder`
```php
        $searchClient = app('opensearch.search_client');
        $params = $searchClient->getParamsBuilder();
        $params->setStart(0);
        $params->setHits(20);
        $res = $searchClient->search('水');
```
 * 通过外观调用,支持链式调用
```php
        SearchClient::limit(0,20)->search('水')->get(['id','title_zn_cn']);
```
### 注意事项
 * 参数设置方法参照原 `SearchParamsBuilder` 类方法,以下变更需注意(!!!):
  * `setCustomConfig` 方法 参数 改为 array 形式,如 `['key'=>'value']`
  * `setKvPairs` 方法 参数 改为 array 形式,如 `['key'=>'value']`
  * `addDistinct` 方法 参数 改为 array 形式,如上
  * `addSummary` 方法 参数 改为 array , 如 `[$summary1,$summary2]`
  * `setCustomParam` 改为 `setCustomParams` ,参数改为 array 形式
  * 新增 `limit($start,$count)` 方法 , 用以合并原 `setStart($start)` 及 `setHits($count)` 方法,原`setStart`及`setHits`依然可用
 
