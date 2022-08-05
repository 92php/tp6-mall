<?php

namespace app\api\controller;

use app\common\business\Goods as GoodsBis;
use app\common\lib\Show;

class Index extends ApiBase
{
    //首页推荐大图
    public function getRotationChart()
    {
        $result = (new GoodsBis())->getRotationChart();
        return Show::success($result);
    }

    /**
     * 分类商品推荐
     * @return \think\response\Json
     */
    public function categoryGoodsRecommend()
    {
        //71：女装 72：男装
        $categoryIds = [
            110,
            113
        ];
        $result = (new GoodsBis())->categoryGoodsRecommend($categoryIds);
        return Show::success($result);
    }
}