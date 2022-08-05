<?php

namespace app\admin\controller;

use think\facade\View;

class Login extends AdminBase
{
    public function initialize()
    {
        if ($this->isLogin()) {
            return $this->redirect(url("index/index"));
        }
    }

    public function index()
    {
        return View::fetch();
    }

    public function md5()
    {
        //admin admin
        halt(session(config("admin.session_admin")));
        echo md5("admin_tp6_mall");
    }

    public function check()
    {
        if (!$this->request->isPost()) {
            return show(config("status.error"), "请求方式错误");
        }

        // 1.原生验证  2.tp6的参数校验机制
        $username = $this->request->param("username", "", "trim");
        $password = $this->request->param("password", "", "trim");
        $captcha = $this->request->param("captcha", "", "trim");
        /*if(empty($usernam) || empty($password) || empty($captcha)){
            return show(config("status.error"), "参数不能为空");
        }
        if(!captcha_check($captcha)){
            return show(config("status.error"), "验证码不正确");
        }*/
        $data = [
            'username' => $username,
            'password' => $password,
            'captcha' => $captcha
        ];
        $validate = new \app\admin\validate\AdminUser();
        if (!$validate->check($data)) {
            return show(config("status.error"), $validate->getError());
        }
        try {
            $adminUserObj = new \app\admin\business\AdminUser();
            $result = $adminUserObj->login($data);
        } catch (\Exception $e) {
            return show(config("status.error"), $e->getMessage());
        }
        if ($result) {
            return show(config("status.success"), "登录成功");
        }
        return show(config("status.error"), $validate->getError());
    }
}