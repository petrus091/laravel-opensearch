<?php

namespace Kevin\OpenSearch;

use Kevin\OpenSearch\Client\SearchClient;
use Illuminate\Support\ServiceProvider;

class OpenSearchProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/opensearch.php');
        $this->publishes([$source => config_path('opensearch.php')]);
        $this->mergeConfigFrom($source, 'opensearch');
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->setupConfig();
        $this->app->singleton('opensearch.search_client',function(){
            $config = config('opensearch');
            $searchClient = new SearchClient($config['accessKeyId'],$config['secret'],$config['endPoint'],$config['options']);
            $searchClient->setAppName($config['appName']);
            return $searchClient;
        });
    }

}
