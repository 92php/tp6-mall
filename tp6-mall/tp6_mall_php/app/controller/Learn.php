<?php

namespace app\controller;

use app\Request;
use think\facade\Request as ABC;

class Learn
{

    public function index(Request $request)
    {
        //第二种方式  通过方法的依赖注入去实现request获取url里面的参数
        dump($request->param("abc"));
        dump($request->request("abc"));

        //第三种方式
        dump(input("abc"));

        //第四种方法
        dump(request()->param("abc"));

        //第五种方法 门面模式  静态方式去调用
        dump(ABC::param("abc"));

        //$request->isPost();
        //$request->isAjax();
        //$request->isGet();
    }
}