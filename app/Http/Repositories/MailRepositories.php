<?php


namespace App\Http\Repositories;


use App\Events\SendMailEvent;
use App\Http\Interfaces\MailInterface;
use App\Jobs\UserMailJob;
use App\Mail\MessageMail;
use App\Models\UserMail;
use App\Traits\ApiResponse;
use App\Traits\FileManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class MailRepositories implements MailInterface
{
    use ApiResponse;

    public function createMail($data)
    {
        event(new SendMailEvent($data));

//         dispatch(new UserMailJob($data));
//        return $this->showMessage('mail sent successfully',201);
    }


    public function getMail(): JsonResponse
    {
        return $this->showAll(UserMail::all(),200);
    }
}
