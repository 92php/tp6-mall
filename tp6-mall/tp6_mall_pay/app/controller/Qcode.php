<?php

namespace app\controller;

use app\BaseController;

use app\lib\phpqrcode\QRcode;

class Qcode extends BaseController
{

    /**
     * 生成二维码
     */
    public function index()
    {
        //$url = urldecode($_GET["data"]);
        $url = urldecode(input("param.data", ""));
        if (substr($url, 0, 6) == "weixin") {
            QRcode::png($url);
        } else {
            header('HTTP/1.1 404 Not Found');
        }
    }
}