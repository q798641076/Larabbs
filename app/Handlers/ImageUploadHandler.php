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
    public function save($file, $floder, $file_prefix,$max_width = false){

         // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
         $folder_name="/upload/image/$floder/".date('Ym/d',time());

         //文件具体存储的物理路径，’public_path()' 获取的时‘public’文件夹的物理路径
         $upload_file=public_path().'/'.$folder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
         $extension=strtolower($file->extension())? :'png';

         //图片名 1_123545.png
         $filename=$file_prefix. '_' . time() .Str::random(10).'_'. '.' . $extension;

         if(!in_array($extension, $this->ext)){
             return false;
         }

         // 将图片移动到我们的目标存储路径中
         $file->move($upload_file, $filename);

        // //  // 如果限制了图片宽度，就进行裁剪
        //  if($max_width && $extension!='gif'){

        //     // 此类中封装的函数，用于裁剪图片
        //     $this->resizeImage($upload_file.$folder_name, $max_width);

        //  }

         return [
             'path'=>config('app.url').$folder_name.'/'.$filename
         ];
    }

    //   public function resizeImage($path, $max_width){

    //      // 先实例化，传参是文件的磁盘物理路径
    //      $image=Image::make($path);

    //      $image->resize($max_width, null , function($constraint){
    //      //约束
    //             // 设定宽度是 $max_width，高度等比例缩放
    //             $constraint->aspectRatio();

    //             // 防止裁图时图片尺寸变大
    //             $constraint->upsize();
    //      });

    //       //最后保存
    //       $image->save();

    //   }
}
