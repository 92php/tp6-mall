<?php

namespace app\api\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username' => 'require',
        'phone_number' => 'require|mobile',
        'code' => 'require|number|min:4',
        //'type' => 'require|in:1,2',
        'type' => ["require", "in" => "1,2"],
        'sex' => ["require", "in" => "0, 1, 2"],
    ];

    protected $message = [
        'username' => '用户名必须',
        'phone_number.require' => '手机号必须',
        'phone_number.mobile' => '手机号不正确',
        'code.require' => '短信验证码必须',
        'code.number' => '短信验证码必须为数字',
        'type.require' => '类型必须',
        'type.in' => '类型数值错误',
        'sex.require' => '性别必须',
        'sex.in' => '性别数值错误',
    ];

    protected $scene = [
        'send_code' => ['phone_number'],
        'login' => ['phone_number', 'code', 'type'],
        'update_user' => ['username', 'sex'],
    ];
}