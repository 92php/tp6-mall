<?php

namespace app\demo\controller;

use app\BaseController;

class E extends BaseController
{
    public function index()
    {
        //echo $abc;
        throw new \think\exception\HttpException(404, "找不到相应的数据");
    }

    public function abc()
    {
        dump($this->request->type);
    }
}