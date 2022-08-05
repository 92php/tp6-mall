<?php

namespace app\controller;

use app\BaseController;
use think\facade\Db;
use app\model\Demo;

class Data extends BaseController
{
    public function index()
    {
        //通过门面模式
        //$result = Db::table("mall_demo")->where("id", 2)->find();
        //dump($result);

        //通过容器的方式来处理
        //$result = app("db")->table("mall_demo")->where("id", 2)->find();
        //dump($result);

        $result = Db::table("mall_demo")
            //->order("id", "desc")
            //->limit(0, 2)
            //->page(1, 1)
            //->where('id','>',3)
            //->where(['id'=>2])
            //->where([["id", ">", 2], ["category_id","=",3]])
            ->where([["id", "in", "1,2,3,5"], ["category_id","=",3]])
            ->select();
        dump($result);
    }

    public function abc()
    {
        //1.
        //$result = Db::table("mall_demo")->where("id", 20)->fetchSql()->find();
        //dump($result);

        //2.
        $result = Db::table("mall_demo")->where("id", 20)->find();
        echo Db::getLastSql();exit();
        dump($result);
    }

    public function demo1()
    {
        /*$data = [
            'title' => '007',
            'content' => '比较',
            'category_id' => 1,
            'create_time' => time(),
        ];
        $result = Db::table('mall_demo')->insert($data);
        echo Db::getLastSql();
        dump($result);*/

        //$result = Db::table("mall_demo")->where(['id'=>1])->delete();
        //echo Db::getLastSql();
        //dump($result);

        $result = Db::table("mall_demo")->where(['id'=>2])->update(['title'=>'3333']);
        echo Db::getLastSql();
        dump($result);
    }

    public function model1()
    {
        $result = Demo::find(2);
        dump($result->toArray());
    }

    public function model2()
    {
        $modelObj = new Demo();
        $results = $modelObj->where("category_id", 3)
            ->limit(2)
            ->order("id", "desc")
            ->select();
        //print_r($results);
        foreach ($results as $result) {
            //$result->content
            //ArrayAccess像数组一样访问对象
            dump($result['content']);
            dump($result->status_text);
        }
    }
}