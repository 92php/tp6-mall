<?php

declare (strict_types=1);  //强制类型

namespace app\admin\middleware;

class Auth
{
    public function handle($request, \Closure $next)
    {
        // 前置中间件
        if (empty(session(config("admin.session_admin"))) && !preg_match("/login/", $request->pathinfo())) {
            return redirect((string)url("login/index"));
        }

        $response = $next($request);
        // 当退出后跳转登录页面
        //if (empty(session(config("admin.session_admin"))) && $request->controller() != "Login") {
        //return redirect((string)url("login/index"));
        //}
        return $response;
        // 后置中间件
    }

    /**
     * 中间件结束调度
     * @param \think\Response $response
     */
    public function end(\think\Response $response)
    {

    }
}