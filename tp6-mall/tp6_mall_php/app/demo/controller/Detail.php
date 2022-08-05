<?php

namespace app\demo\controller;

use app\BaseController;

class Detail extends BaseController
{
    public function index()
    {
        dump($this->request->type);
    }
}