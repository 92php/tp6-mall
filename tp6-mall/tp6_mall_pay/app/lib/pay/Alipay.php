<?php

namespace app\lib\pay;

class Alipay implements PayBase
{
    /**
     * 统一下单API
     * @param $data
     * @return string
     */
    public function unifiedOrder($data)
    {
        return "等待接入开发等工作";
    }
}