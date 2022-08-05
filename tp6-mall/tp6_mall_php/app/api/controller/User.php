<?php

namespace app\api\controller;

use app\common\business\User as UserBis;

class User extends AuthBase
{
    public function index()
    {
        $user = (new UserBis())->getNormalUserById($this->userId);
        $resultUser = [
            "id" => $this->userId,
            "username" => $user['username'],
            "sex" => $user['sex']
        ];
        return show(config("status.success"), "OK", $resultUser);
    }

    public function update()
    {
        $username = input("param.username", "", "trim");
        $sex = input("param.sex", "", "trim");
        //用户名一般不让修改，只修改一次？
        $data = [
            "username" => $username,
            "sex" => $sex
        ];
        $validate = (new \app\api\validate\User())->scene("update_user");
        if (!$validate->check($data)) {
            return show(config("status.error"), $validate->getError());
        }
        $userBisObj = new UserBis();
        $user = $userBisObj->update($this->userId, $data);
        if (!$user) {
            return show(config("status.error"), "更新失败");
        }
        //TODO: 用户名被修改redis做数据更新
        return show(1, "ok");
    }
}