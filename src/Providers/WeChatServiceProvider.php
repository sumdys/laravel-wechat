<?php

namespace Sumdy\LaravelWechat\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class WeChatServiceProvider extends ServiceProvider
{

    protected $routeMiddleware = [
        'swechat.check' => \Sumdy\LaravelWechat\Http\Middleware\SWeChatCheck::class,
    ];
    protected $middlewareGroups = [];

    protected $commands = [
        \Sumdy\LaravelWechat\Console\Commands\ControllerMakeCommand::class,
    ];
    
    public function register() // register 先执行一般是配置 
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/swechat.php', 'swechat');
        $this->registerRouteMiddleware();
        $this->registerPublishing();
        $this->commands($this->commands);
    }

    public function boot() // 后执行 
    {
        $this->registerRoutes();
        $this->loadViewsFrom(
            __DIR__ . '/../Resources/views',
            'swechat'
        );
    }


    protected function registerPublishing()  
    {
        //php artisan vendor:publish --provider="Sumdy\LaravelWechat\Providers\WeChatServiceProvider"
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../Config'=>config_path()],'swechat');
        }
    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }

    private function routeConfiguration()
    {
        return [
            'namespace' => 'Sumdy\LaravelWechat\Http\Controllers',
            'prefix' => 'swechat',
        ];
    }

    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        });
    }
}
