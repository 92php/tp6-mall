<?php

namespace app\admin\controller;

use app\BaseController;
use think\exception\HttpResponseException;

class AdminBase extends BaseController
{
    public $adminUser = null;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        // 判断是否登录 判断是否登录切换到中间件中
        //if (empty($this->isLogin())) {
        //    return redirect(url("login/index")); //不能跳转，需要在真正的控制器下设置
        //    return $this->redirect(url("login/index"), 302);
        //}
        if(!empty($this->isLogin())){
            $this->adminUser = session(config("admin.session_admin"));
        }

    }

    /**
     * 判断是否登录
     * @return bool
     */
    public function isLogin()
    {
        $this->adminUser = session(config("admin.session_admin"));
        if (empty($this->adminUser)) {
            return false;
        } else {
            return true;
        }
    }

    //...$args 动态参数
    public function redirect(...$args)
    {
        throw new HttpResponseException(redirect(...$args));
    }
}