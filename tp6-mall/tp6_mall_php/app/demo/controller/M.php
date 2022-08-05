<?php

namespace app\demo\controller;

use \app\BaseController;
use app\common\business\Demo;
use app\model\demo as demo_new;


class M extends BaseController
{
    public function index()
    {
        $categoryId = $this->request->param("category_id", 0, "intval");
        if (empty($categoryId)) {
            return show(config("status.error"), "参数错误");
        }
        /*$model = new demo_new();
        //$results = $model->where("cagetory_id",$categoryId)
        //    ->limit(10)
        //    ->order("id","desc")
        //    ->select();
        //halt($results); // dump();exit();
        //if(empty($results->toArray())){
        //    return show(config("status.success"), "数据为空");
        //}
        $results = $model->getDemoDataByCategoryId($categoryId);
        if(empty($results)){
            return show(config("status.success"), "数据为空");
        }
        $categorys = config("category");
        foreach ($results as $key=>$result){
            $results[$key]['categoryName'] = $categorys[$result["category_id"]] ?? "其他";
        }*/

        //调用business层的方法
        $demo = new Demo();
        $results = $demo->getDemoDataByCategoryId($categoryId);
        return show(config("status.success"), "ok", $results);
    }
}