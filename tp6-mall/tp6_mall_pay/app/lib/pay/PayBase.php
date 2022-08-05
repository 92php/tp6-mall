<?php

namespace app\lib\pay;

interface PayBase
{
    public function unifiedOrder($data);
}