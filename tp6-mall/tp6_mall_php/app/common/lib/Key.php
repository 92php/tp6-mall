<?php

namespace app\common\lib;

class Key
{
    /**
     * 用户购物车的redis Key
     * @param $userId
     * @return string
     */
    public static function UserCart($userId)
    {
        return config("redis.cart_pre") . $userId;
    }
}