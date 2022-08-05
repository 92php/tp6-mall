<?php

namespace app\model;

use think\Model;

class Demo extends Model
{
    public function getStatusTextAttr($value,$data)
    {
        $status = [
            0 => '删除',
            1 => '正常',
        ];
        return $status[$data['status']];
    }

    public function getDemoDataByCategoryId($categoryId,$limit = 10)
    {
        if(empty($categoryId)){
            return [];
        }
        $results = $this->where("cagetory_id",$categoryId)
            ->limit($limit)
            ->order("id","desc")
            ->select()
            ->toArray();
        return $results;
    }

}
