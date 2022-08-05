<?php

namespace app\admin\controller;

class Image extends AdminBase
{
    public function upload()
    {
        //dump($_FILES);
        if (!$this->request->isPost()) {
            return show(config("status.error"), "请求不合法");
        }
        $file = $this->request->file("file");
        //todo:文件大小限制、后缀限制、长宽限制
        //$filename = \think\facade\Filesystem::putFile('upload', $file);
        $filename = \think\facade\Filesystem::disk("public")->putFile("image", $file);
        if (!$filename) {
            return show(config("status.error"), "上传图片失败");
        }
        //dump($filename);
        $imageUrl = [
            "image" => "/upload/" . $filename
        ];
        return show(config("status.success"), "图片上传成功", $imageUrl);
    }

    public function layUpload()
    {
        if (!$this->request->isPost()) {
            return show(config("status.error"), "请求不合法");
        }
        $file = $this->request->file("file");
        $filename = \think\facade\Filesystem::disk("public")->putFile("image", $file);
        if (!$filename) {
            return json(["code" => 1, "data" => []], 200);
        }
        $result = [
            "code" => 0,
            "data" => [
                "src" => "/upload/" . $filename
            ],
        ];
        return json($result, 200);
    }
}