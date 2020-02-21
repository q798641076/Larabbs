<?php
namespace App\Handlers;

use Illuminate\Support\Str;

class ImageUploadHandler{

    protected $ext=['png', 'jpeg', 'jpg','gif'];
    /**
     * $file 文件信息
     * $folder 文件夹
     * $file_prefix 文件前缀
     */
    public function save($file, $floder, $file_prefix){

         // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
         $folder_name="/upload/image/$floder/".date('Ym/d',time());

         //文件具体存储的物理路径，’public_path()' 获取的时‘public’文件夹的物理路径
         $upload_file=public_path().'/'.$folder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
         $extension=strtolower($file->extension())? :'png';

         //图片名 1_123545.png
         $filename=$file_prefix. '_' . time() . '.' . $extension;

         if(!in_array($extension, $this->ext)){
             return false;
         }

         $file->move($upload_file, $filename);
         return [
             'path'=>config('app.url').$folder_name.'/'.$filename
         ];


    }
}
