<?php

namespace app\api\controller\mall;

use app\api\controller\ApiBase;
use app\common\lib\Show;


class Recommend extends ApiBase
{
    public function index()
    {
        return Show::success();
    }

    public function searchTop()
    {
        return Show::success();
    }
}