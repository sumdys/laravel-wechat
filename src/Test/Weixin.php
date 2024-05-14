<?php
namespace Sumdy\LaravelWechat;

class Weixin
{
    
}


$signature = $_GET["signature"];
$timestamp = $_GET["timestamp"];
$nonce = $_GET["nonce"];

$echostr = $_GET['echostr'];

$token = 'familyHe';
$tmpArr = array($token, $timestamp, $nonce);
sort($tmpArr, SORT_STRING);
$tmpStr = implode($tmpArr);
$tmpStr = sha1($tmpStr);

if ($tmpStr == $signature) {
    if (empty($echostr)) {
        return true;
    } else {
        echo $echostr;
    }
} else {
    return false;
}
