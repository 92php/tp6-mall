<?php

namespace app\common\lib;

class Status
{
    public static function getTableStatus()
    {
          $mysqlStatus = config('status.mysql');
          return array_values($mysqlStatus);
    }
}