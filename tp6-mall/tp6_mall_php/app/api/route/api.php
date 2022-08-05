<?php

use \think\facade\Route;

Route::rule("smscode", "sms/code", "POST");
Route::resource('user', "User");  //资源路由  RESTful API
//RESTful:用URL定位资源、用HTTP动词（GET、POST、PUT、DELETE)描述操作
Route::rule("lists", "mall.lists/index");
Route::rule("subcategory/:id", "category/sub");
Route::rule("detail/:id", "mall.detail/index");
Route::resource("order", "order.index");