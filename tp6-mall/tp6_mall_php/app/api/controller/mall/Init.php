<?php

namespace app\api\controller\mall;

use app\api\controller\AuthBase;
use app\common\lib\Show;
use app\common\business\Cart;

class Init extends AuthBase
{
    public function index()
    {
        if (!$this->request->isPost()) {
            return Show::error();
        }
        $count = (new Cart())->getCount($this->userId);
        $result = [
            "cart_num" => $count,
        ];
        return Show::success($result);
    }
}