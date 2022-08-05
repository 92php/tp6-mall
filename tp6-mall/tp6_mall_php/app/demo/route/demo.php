<?php

use think\facade\Route;

Route::rule("test", "index/hello", "GET");
Route::rule("detail", "detail/index", "GET")->middleware(\app\demo\middleware\Detail::class);
