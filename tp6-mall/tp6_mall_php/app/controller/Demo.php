<?php

namespace app\controller;

use app\BaseController;

class Demo extends BaseController
{
    public function show()
    {
        //return "abcdefg";
        $result = [
            "status" => 1,
            "message" => "OK",
            "result" => [
                'id' => 1,
            ]
        ];
        $header = [
            "Token" => "e3gijk",
        ];
        //json
        return json($result, 201, $header);
    }

    public function request()
    {
        //第一种方式 通过构造方法实现request
        dump($this->request->post());
        dump($this->request->get());
        dump($this->request->param("abc", 1, "intval"));
    }
}
