<?php
return [
    'title'=>'站点设置',

    //访问权限判断
    'permissions'=> function(){
        //只允许站长配置站点
        return Auth::user()->hasRole('Founder');
    },

    //站点配置的表单
    'edit_fields'=>[
        'site_name'=>[

            //站点名称
            'title'=>'站点名称',

            //站点类型框
            'type'=>'text',

            //限制字数
            'limit'=>50
        ],

        'contact_email'=>[

            'title'=>'联系邮箱',
            'type'=>'text',
            'limit'=>50
        ],

        'site_description'=>[

            'title'=>'SEP_DESCRIPTION',
            'type'=>'textarea',
            'limit'=>250
        ],

        'site_keyword'=>[

            'title'=>'SEO_KETWORD',
            'type'=>'textarea',
            'limit'=>250
        ],
    ],
        //表单验证规则
        'rules' => [
            'site_name' => 'required|max:50',
            'contact_email' => 'email',
        ],

        'messages' => [
            'site_name.required' => '请填写站点名称。',
            'contact_email.email' => '请填写正确的联系人邮箱格式。',
        ],

        //数据保存的时添加钩子,避免重复添加
        'before_save'=>function(&$data)
        {
            if(strpos($data['site_name'],'- YszeJ Larabbs')===false)
            {
                $data['site_name'].='YszeJ-Larabbs';
            }
        },

        //你可以自定义多个动作，每一个动作为设置页面底部的『其他操作』区块
        'actions'=>[

             'cache_clear'=>[
                 'title'=>'清理缓存',

                 'messages'=>[
                    'active'=>'清理缓存中。。。',
                    'success'=>'清理缓存完毕',
                    'error'=>'清理缓存失败'
                 ],

                 'action'=>function ($data){
                     \Artisan::call('cache:clear');
                     return true;
                 },
             ]

        ],

];
