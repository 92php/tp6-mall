<?php
declare (strict_types = 1);

namespace app\demo\controller;
use app\common\lib\Snowflake;

class Index
{
    public function index()
    {
        return '您好！这是一个[demo]示例应用';
    }

    public function hello()
    {
        return time();
    }

    public function test()
    {
        //workId 最大1023
        $orderId = Snowflake::getInstance()->setWorkId(1)->id();
        dump($orderId);
        exit();
    }
}
