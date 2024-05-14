<?php

namespace Sumdy\LaravelWechat\Http\Controllers;


class WeChatController extends Controller
{
    public function index()
    {

        // 接收微信发送的参数
        $postObj = file_get_contents('php://input');
        $postArr = simplexml_load_string($postObj, "SimpleXMLElement", LIBXML_NOCDATA);
        //消息内容
        $content = $postArr->Content;
        //接受者
        $toUserName = $postArr->ToUserName;
        //发送者
        $fromUserName = $postArr->FromUserName;
        //获取时间戳
        $time = time();
        //你好，你的消息是: $content
        $content = "你好，你的消息是: $content"; //把百分号(%)符号替换成一个作为参数进行传递的变量: $info = sprintf('<xml>
        $info = sprintf('<ToUserName><![CDATA[%s]]></ToUserName> <FromUserName><![CDATA[%s]]></FromUserName> <CreateTime>%s</CreateTime> <MsgType><![CDATA[text]]></MsgType> <Content><![CDATA[%s]]></Content>
            </xml>', $fromUserName, $toUserName, $time, $content);
        return $info;
    }
}
