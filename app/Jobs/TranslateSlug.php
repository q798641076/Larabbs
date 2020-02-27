<?php

namespace App\Jobs;

use App\Handlers\SlugTranslateHandler;
use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

//该类实现了 Illuminate\Contracts\Queue\ShouldQueue 接口，
//该接口表明 Laravel 应该将该任务添加到后台的任务队列中，而不是同步执行。
class TranslateSlug implements ShouldQueue
{
    //引入了 SerializesModels trait，Eloquent 模型会被优雅的序列化和反序列化。
    //队列任务构造器中接收了 Eloquent 模型，将会只序列化模型的 ID。
    //这样子在任务执行时，队列系统会从数据库中自动的根据 ID 检索出模型实例。这样可以避免序列化完整的模型可能在队列中出现的问题
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topic;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
      return  $this->topic=$topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    //handle 方法会在队列任务执行时被调用。值得注意的是，我们可以在任务的 handle 方法中可以使用类型提示来进行依赖的注入。
    //Laravel 的服务容器会自动的将这些依赖注入进去，与控制器方法类似。
    public function handle()
    {
        $slug=app(SlugTranslateHandler::class)->translate($this->topic->title);

        \DB::table('topics')->where('id', $this->topic->id)->update(['slug'=>$slug]);
    }
    //还有一点需要注意，我们将会在模型监控器中分发任务，任务中要避免使用 Eloquent
    //模型接口调用，如：create(), update(), save() 等操作。否则会陷入调用死循环 —— 模型监控器分发任务，任务触发模型监控器，
    //模型监控器再次分发任务，任务再次触发模型监控器.... 死循环。在这种情况下，使用 DB 类直接对数据库进行操作即可。
}
