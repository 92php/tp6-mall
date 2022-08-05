<?php

namespace app\common\business;

class BusBase
{
    //新增
    public function add($data)
    {
        $data['status'] = config("status.mysql.table_normal");
        //todo：根据name查询$name是否存在
        try {
            $this->model->save($data);
        } catch (\Exception $e) {
            //记录日志
            trace("BusBase-add-SeverException" . $e->getMessage(), "error");
            return 0;
        }
        return $this->model->id;
    }
}