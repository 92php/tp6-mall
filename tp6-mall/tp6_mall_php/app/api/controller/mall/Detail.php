<?php

namespace app\api\controller\mall;

use app\api\controller\ApiBase;
use app\common\lib\Show;
use app\common\business\Goods as GoodsBis;

class Detail extends ApiBase
{
    public function index()
    {
        //id为sku_id
        $id = input("param.id", 0, "intval");
        if (!$id) {
            //商品详情获取不到前端会直接跳转到首页
            return Show::error();
        }
        $result = (new GoodsBis())->getGoodsDetailBySkuId($id);
        if (!$result) {
            return Show::error();
        }
        return Show::success($result);
    }
}