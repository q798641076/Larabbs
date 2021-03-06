<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Link;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(User $user,Link $link)
	{
        //预加载在模型里面

        $topics = Topic::withOrder(request('order'))->paginate();

        //加载活跃用户
        $active_users=$user->getActiveUsers();

        //获取资源推荐 利用缓存
        $active_links=$link->cacheActiveLink();

		return view('topics.index', compact('topics','active_users','active_links'));
	}

    public function show(Topic $topic , Request $request)
    {

        //强制跳转301
        if(!empty($topic->slug)&&$topic->slug!=$request->slug){

            return redirect($topic->link(),301);

        }


        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic,Category $category)
    {
        $category=$category->all();

		return view('topics.create_and_edit', compact('topic','category'));
	}

	public function store(TopicRequest $request,Topic $topic)
	{
        $topic->fill($request->all());
        $topic->user_id=Auth::id();
        $topic->save();
		return redirect()->to($topic->link())->with('success','创建成功');
	}

	public function edit(Topic $topic, Category $category)
	{
        $this->authorize('update',$topic);

        $category=$category->all();

		return view('topics.create_and_edit', compact('topic','category'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
        $this->authorize('update', $topic);

		$topic->update($request->all());

		return redirect()->to($topic->link())->with('success', '编辑成功.');
	}

	public function destroy(Topic $topic)
	{
        $this->authorize('destroy', $topic);

		$topic->delete();

		return redirect()->route('topics.index')->with('success', '删除成功.');
    }

    public function uploadImage(Request $request, ImageUploadHandler $file)
    {
        //初始化一下上传
        $data=[
            'success'=>false,
            'msg'=>'上传失败!',
            'file_path'=>''
        ];

        if($request->upload_file)
        {
            $image=$request->upload_file;

            $result=$file->save($image, 'topics', Auth::id(), 1024);

           if($result){
               $data['success']=true;
               $data['msg']='上传成功！';
               $data['file_path']=$result['path'];
           }
        }

        return $data;
    }
}
