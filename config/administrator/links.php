<?php

use App\Models\Link;

return [
    'title'=>'资源管理',
    'model'=>Link::class,
    'single'=>'资源管理',

    'permission'=>function(){
        return Auth::check() && Auth::user()->hasRole('Founder');
    },

    'columns'=>
    [
        'id'=>[
            'title'=>'ID',
        ],
        'title'=>[
            'title'=>'资源名称',
            'sortable'=>false
        ],
        'link'=>[
            'title'=>'资源链接',
            'sortable'=>false
        ],
        'operation'=>[
            'title'=>'管理',
            'sortable'=>false
        ]
    ],

    'edit_fields'=>
    [
        'title'=>[

        'title'=>'资源名称',
    ],
    'link'=>[
        'title'=>'资源链接',
        ],
    ],

    'filters'=>
    [
        'id'=>[
            'title'=>'ID',
        ],
        'title'=>[
            'title'=>'资源名称',
        ],

    ]
];
