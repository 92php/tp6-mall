<?php

namespace app\common\business;

use app\common\model\mysql\OrderGoods as OrderGoodsModel;

class OrderGoods extends BusBase
{
    public $model = NULL;

    public function __construct()
    {
        $this->model = new OrderGoodsModel();
    }

    public function saveAll($data)
    {
        try {
            $result = $this->model->saveAll($data);
            return $result->toArray();
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     *
     * 根据订单ID 获取order_goods表中的数据
     * @param $orderId
     * @return array|bool|\think\Collection
     */
    public function getByOrderId($orderId)
    {
        $condition = [
            "order_id" => $orderId,
        ];

        try {
            $orders = $this->model->getByCondition($condition);
        } catch (\Exception $e) {
            $orders = [];
        }
        if (!$orders) {
            return [];
        }

        $orders = $orders->toArray();
        return $orders;
    }
}