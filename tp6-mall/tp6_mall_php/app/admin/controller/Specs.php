<?php

namespace app\admin\controller;

class Specs extends AdminBase
{
    public function dialog()
    {
        return view("", [
            "specs" => json_encode(config("specs"))
        ]);
    }
}