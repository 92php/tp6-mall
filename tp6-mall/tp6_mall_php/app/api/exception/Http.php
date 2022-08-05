<?php

namespace app\api\exception;

use think\exception\Handle;
use think\Response;
use Throwable;

class Http extends Handle
{
    public $httpStatus = 500;

    /**
     * Render an exception into an HTTP response.
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        //php中 instanceof有什么作用
        //作用：（1）判断一个对象是否是某个类的实例，（2）判断一个对象是否实现了某个接口。
        if ($e instanceof \think\Exception) {
            return show($e->getCode(), $e->getMessage());
        }
        if ($e instanceof \think\exception\HttpResponseException) {
            return parent::render($request, $e);
        }
        if (method_exists($e, "getStatusCode")) {
            $httpStatus = $e->getStatusCode();
        } else {
            $httpStatus = $this->httpStatus;
        }
        // 添加自定义异常处理机制
        return show(config("status.error"), $e->getMessage(), [], $httpStatus);
    }
}
