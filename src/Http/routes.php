<?php 
Route::any('/', 'WeChatController@index');

Route::get('wechat-check',function()  {
    return '333333';
})->middleware('swechat.check');

Route::get('wechat-views',function()  {
    return view('swechat::welcome');
});
