<?php
declare (strict_types=1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param App $app 应用对象
     */
    public function __construct(App $app)  //依赖注入一个对象
    {
        $this->app = $app;
        $this->request = $this->app->request;  //app对象调用request属性
        //App类继承容器类Container 触发 __get方法（对象中获取一个不存在的属性的时候触发对应的__get方法）
        //最终是 容器中make方法生成 request对象

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {
    }

    /**
     * 验证数据
     * @access protected
     * @param array $data 数据
     * @param string|array $validate 验证器名或者验证规则数组
     * @param array $message 提示信息
     * @param bool $batch 是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

    /**
     * @param $name string 方法
     * @param $arguments  string 参数
     * @return \think\response\Json
     */
    public function __call($name, $arguments)
    {
        //当我们访问一个类中不存在的方法的时候，会走__call逻辑
        // TODO: Implement __call() method.
        //dump($name, $arguments);
        //逻辑：如果我们的模块是API模块的话，需要输出API的数据格式
        //如果我们是模板引擎的方式，我们只需要输出错误的页面
//        $result = [
//            'status' => 0,
//            'message' => '找不到{$name}方法',
//            'result' => null
//        ];
//        return json($result, 400);
        return show(config("status.action_not_found"), "找不到{$name}方法", null, 404);
    }

}
