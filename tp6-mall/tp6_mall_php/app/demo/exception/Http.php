<?php

namespace app\demo\exception;

use think\exception\Handle;
use think\Response;
use Throwable;

class Http extends Handle
{
    public $httpStatus = 500;

    public function render($request, Throwable $e): Response
    {
        //对象$e 下面是否有getStatusCode方法
        if (method_exists($e, "getStatusCode")) {
            $httpStatus = $e->getStatusCode();
        } else {
            $httpStatus = $this->httpStatus;
        }
        // 添加自定义异常处理机制
        return show(config("status.error"), $e->getMessage(), [], $httpStatus);
    }
}
