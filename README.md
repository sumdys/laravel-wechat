

<h1 align='center'>laravel-wechat</h1>
<p align='center'>a sumdy laravel wechat.</p>

## Describe
这是基于laravel框架编辑的,微信公众号的组件

## Installation
```shell
$ composer require sumdy/laravel-wechat:master-dev
```

## Then run these commands to publish assets and config：
``` shell
$ php artisan vendor:publish --provider="Sumdy\LaravelWechat\Providers\WeChatServiceProvider"
```


## Config
Laravel 应用
在 config/app.php 注册 ServiceProvider 和 Facade (Laravel 5.5 无需手动注册)
```
'providers' => [
    // ...
    Sumdy\LaravelWechat\WeChatServiceProvider::class,
]
```
然后在浏览器中访问的路由如下:  http://localhost/swechat
```
Route::any('/', 'WeChatController@index')->middleware('swechat.check');
```