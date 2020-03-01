<?php
use App\Models\Category;

return [
   'title'=>'分类',
   'single'=>'分类',
   'model'=>Category::class,

    // 对 CRUD 动作的单独权限控制，其他动作不指定默认为通过
    'action_permissions'=>[
        //只有站长才能进行删除
        'delete'=>function (){
            return Auth::user()->hasRole('Founder');
        }
    ],

    'columns'=>[
        'id'=>[
            'title'=>'ID',
            'sortable'=>false
        ],
        'name'=>[
            'title'=>'分类名称',
            'sortable'=>false,
        ],
        'description'=>[
            'title'=>'分类描述',
            'sortable'=>false
        ],
        'operation'=>[
            'title'=>'管理',
            'sortable'=>false,
        ]
    ],

    'edit_fields'=>[
        'name'=>[
            'title'=>'分类名称'
        ],
        'description'=>[
            'title'=>'分类描述',
            'type'=>'textarea'
        ],
    ],

    'filters'=>[
        'id'=>[
            'title'=>'ID'
        ],
        'name'=>[
            'title'=>'分类名称',
        ],
        'description'=>[
            'title'=>'分类描述'
        ]
    ],

    'rules'=>[
        'name'=>'required|unique:categories,name|max:10',
        'description'=>'required|min:3'
    ],
    'massages'=>[
        'name.required'=>'分类名称不能为空',
        'name.unique'=>'分类名称不能重复',
        'name.max'=>'分类名称不能超过十个字',
        'description.required'=>'分类描述不能为空',
        'description.min'=>'分类描述不能少于3个字',
    ]
];
