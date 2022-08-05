<?php

namespace app\common\model\mysql;

class SpecsValue extends ModelBase
{
    public function getNormalBySpecsId($specsId, $field = "*")
    {
        $where = [
            "specs_id" => $specsId,
            "status" => config("status.mysql.table_normal")
        ];
        $res = $this->where($where)
            ->field($field)
            ->select();
        return $res;
    }

    public function getSpecsValueByName($name)
    {
        $results = $this->where("name", $name)
            ->select()->toArray();
        return $results;
    }
}