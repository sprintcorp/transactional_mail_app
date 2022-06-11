<?php

namespace App\Jobs;

use App\Mail\MessageMail;
use App\Models\UserMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected $details)
    {

    }

    /**
     * Execute the job.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle()
    {
//        dd($this->details);
        try {
           Mail::to($this->details['recipient'])->send(new MessageMail($this->details));
            if(Mail::failures()) {
                Log::info('mail no sent');
            }


//           return response()->json(['message'=>'message sent successfully','status'=>200]);
        }catch (\Exception $exception){
            if(Mail::failures()) {
                foreach ($this->details['recipient'] as $key => $email_address) {
                    UserMail::create([
                        'sender' => $this->details['sender'],
                        'recipient' => $this->details['recipient'][$key],
                        'subject' => $this->details['subject'],
                        'text_content' => $this->details['text_content'],
                        'html_content' => $this->details['html_content'],
                        'status' => 2,
                    ]);
                }
            }
        }
    }
}
