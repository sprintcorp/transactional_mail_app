<?php


namespace App\Http\Repositories;


use App\Events\SendMailEvent;
use App\Http\Interfaces\MailInterface;
use App\Models\Attachment;
use App\Models\Email;
use App\Traits\ApiResponse;
use App\Traits\FileManager;
use Illuminate\Support\Facades\DB;

class MailRepositories implements MailInterface
{
    use ApiResponse,FileManager;

    public function createMail($data)
    {
        try {
            DB::beginTransaction();
                unset($data['attachments']);
                $mail = Email::create($data);
                if (request()->has('attachments')) {
                   $attachments = Attachment::uploadAttachment(request()->file('attachments'));
                    $mail->attachments()->saveMany($attachments);
                }
                $mail->setPosted();
                event(new SendMailEvent($mail));
            DB::commit();
                return  $this->showModel($mail,201);
        }catch(\Exception $exp) {
            DB::rollBack();
            return $this->errorResponse($exp->getMessage(),400);
        }
    }


    public function getMail()
    {
        return $this->showAll(Email::all(),200);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function resendMail($data)
    {

    }

    /**
     * @param $data
     * @return mixed
     */
    public function getRecipient($data)
    {

    }
}
