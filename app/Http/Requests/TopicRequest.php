<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                   'title'=>'required|min:3',
                   'category_id'=>'required|exists:categories,id',
                   'body'=>'required|min:3'
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
          'title.requried'=>'标题不能为控',
          'title.min'=>'标题最少三个字符',
          'category_id.requried'=>'分类不能为控',
          'category_id.exists'=>'分类不存在',
          'body.requried'=>'内容不能为控',
          'body.min'=>'内容最少三个字符',
        ];
    }
}
