<?php

namespace app\common\lib;

class ClassArr
{
    public static function smsClassStat()
    {
        return [
            "ali" => "app\common\lib\sms\AliSms",
            "baidu" => "app\common\lib\sms\BaiduSms",
            "jd" => "app\common\lib\sms\JdSms"
        ];
    }

    public static function uploadClassStat()
    {
        return [
            'file' => '',
            'image' => '',
            'video' => ''
        ];
    }

    public static function initClass($type, $class, $params = [], $needInstance = false)
    {
        //工厂模式调用的方法是静态的返回类库，不是静态的返回对象
        if (!array_key_exists($type, $class)) {
            return false;
        }
        $className = $class[$type];
        //利用反射机制 new ReflectionClass('A') => 建立A反射类
        //->newInstanceArgs($args) => 相当于实例化A对象
        //$needInstance == true 需要实例化
        return $needInstance == true ? (new \ReflectionClass($className))->newInstanceArgs($params) : $className;
    }
}

