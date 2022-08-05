<?php

namespace app\common\model\mysql;

class GoodsSku extends ModelBase
{
    //protected $autoWriteTimestamp = true;

    public function goods()
    {
        //一对一关联查询
        return $this->hasOne(Goods::class, "id", "goods_id");
    }

    public function getNormalByGoodsId($goodsId = 0)
    {
        $where = [
            "goods_id" => $goodsId,
            "status" => config("status.mysql.table_normal")
        ];
        return $this->where($where)->select();
    }

    public function decStock($id, $num)
    {
        return $this->where("id", "=", $id)
            ->dec("stock", $num)
            ->update();
    }
}