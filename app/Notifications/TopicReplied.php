<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reply;

class TopicReplied extends Notification
{
    use Queueable;

    protected $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply=$reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //我们这边定义的是数据库通知 ， 需要一个todatabase
        return ['database'];
    }



    public function toDatabase($notifiable)
    {
        
        $topic=$this->reply->topic;
        $link=$topic->link(['#reply'.$this->reply->id]);
        $user=$this->reply->user;

        return [
            'reply_id'=>$this->reply->id,
            'reply_content'=>$this->reply->content,
            'user_id'=>$user->id,
            'user_name'=>$user->name,
            'user_avatar'=>$user->avatar,
            'topic_title'=>$topic->title,
            'topic_id'=>$topic->id,
            'topic_link'=>$link
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */



    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
