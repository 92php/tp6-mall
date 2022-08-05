<?php

namespace app\api\validate;

use think\Validate;

class Cart extends Validate
{
    protected $rule = [
        "id" => "require|number",
        "num" => "require|number"
    ];
    protected $message = [
        "id.require" => "id必须",
        "id.number" => "id必须为数字",
        "num.require" => "num必须",
        "num.number" => "num必须为数字"
    ];
}