<?php

namespace App\Console\Commands;

use App\Models\Message;
use Carbon\Carbon;
use Error;
use Illuminate\Console\Command;
use Pusher\Pusher;

class ScheduleMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All Schedule Message Sent to the User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now()->format('Y-m-d');
        $query = Message::where('is_schedule' , false)->where('is_read' , false);
        $messages = $query->whereRaw("DATE(schedule_date) = '{$date}'")->get();
        if(!empty($messages) && count($messages) > 0){
            foreach ($messages as  $message) {
                $data = [
                    'user_id' => $message->sender_id,
                    'message' => $message
                ];
                $pusher = new \Pusher\Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), array('cluster' => env('PUSHER_APP_CLUSTER')));
                if (!$pusher->trigger('chat-' . $message->chat_id, 'message', $data)) throw new Error("Message not send");
                $message->is_schedule = true;
                if (!$message->save()) throw new Error("Message not schedule");
            }
        }
    }
}