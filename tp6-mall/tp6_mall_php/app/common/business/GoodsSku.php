<?php

namespace app\common\business;

use app\common\model\mysql\GoodsSku as GoodsSkuModel;

class GoodsSku extends BusBase
{
    public $model = NULL;

    public function __construct()
    {
        $this->model = new GoodsSkuModel();
    }

    public function saveAll($data)
    {
        if (!$data['skus']) {
            return false;
        }

        foreach ($data['skus'] as $value) {
            $insertData[] = [
                "goods_id" => $data['goods_id'],
                "specs_value_ids" => $value['propvalnames']['propvalids'],
                "price" => $value['propvalnames']['skuSellPrice'],
                "cost_price" => $value['propvalnames']['skuMarketPrice'],
                "stock" => $value['propvalnames']['skuStock'],
            ];
        }

        //number_format round
        try {
            $result = $this->model->saveAll($insertData);
            return $result->toArray();
        } catch (\Exception $e) {
            ///echo $e->getMessage();exit;
            //记录日志
            trace("GoodsSku-saveAll-SeverException" . $e->getMessage(), "error");
            return false;
        }
    }

    public function getNormalSkuAndGoods($id)
    {
        try {
            //两次查询
            $result = $this->model->with("goods")->find($id);
            //一次查询，一个sql(inner join)
            //$result = $this->model->withJoin("goods")->find($id);
        } catch (\Exception $e) {
            return [];
        }
        if (!$result) {
            return [];
        }
        $result = $result->toArray();
        if ($result["status"] != config("status.mysql.table_normal")) {
            return [];
        }
        return $result;
    }

    public function getSkusByGoodsId($goodsId = 0)
    {
        if (!$goodsId) {
            return [];
        }
        try {
            $skus = $this->model->getNormalByGoodsId($goodsId);
        } catch (\Exception $e) {
            return [];
        }
        return $skus->toArray();
    }

    public function getNormalInIds($ids)
    {
        try {
            $result = $this->model->getNormalInIds($ids);
        } catch (\Exception $e) {
            return [];
        }
        return $result->toArray();
    }

    public function updateStock($data)
    {
        // 10 sku_id stock  1 => 10 2= > 4  2 1  1 =>   9 3
        // todo:批量更新方式去处理
        //减库存
        foreach ($data as $value) {
            $this->model->decStock($value['id'], $value['num']);
        }
        return true;
    }
}