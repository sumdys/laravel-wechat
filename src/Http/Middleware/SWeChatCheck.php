<?php

namespace Sumdy\LaravelWechat\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SWeChatCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // return 1;
        $signature = $request->input('signature');
        $timestamp = $request->input('timestamp');
        $nonce = $request->input('nonce');
        // 手动新增的参数
        // 只有在第一次对接的时候才会存在
        // 因此可以根据这个参数来判断是否之前校验过
        $echostr = $request->input('echostr');

        $token = "familyHe";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            // 额外修改的代码
            if (empty($echostr)) { 
                // 是否有关联 // 回复信息
                return $next($request);
            } else {
                return \response($echostr);
            }
        } else {
            return response('false');
        }
       
    }
}
