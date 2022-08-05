<?php


namespace app\api\controller;

use app\common\business\Goods as GoodsBis;
use app\common\lib\Show;
use think\facade\Cache;

class Limit extends ApiBase
{
    /**
     * php + redis 服务限流
     */
    public function index()
    {
        //我们有某一个场景，某一个API会去请求mysql,这个mysql主要是些操作
        //但是我们mysql qps 写 只能抗500，  我们如何做？

        //限流策略 500内的请求，  之外的不请求，给出提示，请稍后重试这类的
        $key = "mall_limit_".time();
        $get = Cache::inc($key);

        if($get <= 500){
            //放行 执行你的业务逻辑代码
            return $get;
        }else{
            //给出提示
            return 0;
        }
    }

    //大公司 采用 nginx + lua + redis
    //推荐使用 openresty



    //高并发服务
    //1.缓存 2.降级 3.限流

    //商品抢购
    /*
    用户----》 server(减库存) ------》
              server(减库存)-------》   kafka    -----> 创建订单-----》 mysql
                  |
                  |
                  |
                  V
               redis   redis
    */
}