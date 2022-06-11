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
                return  $this->showModel($mail,'mail created',201);
        }catch(\Exception $exp) {
            DB::rollBack();
            return $this->errorResponse($exp->getMessage(),400);
        }
    }


    public function getMail()
    {
        $paginate = request()->get('paginate') ?? 10;
        $mails = Email::all();

        if(!empty(request()->get('search'))){
            $mails = Email::whereLike('sender',request()->get('search'))
                ->whereLike('recipient',request()->get('search'))
                ->whereLike('subject',request()->get('search'))
                ->latest()->get();
        }

        return $this->showAll($mails,$paginate);
    }

    /**
     * @param Email $email
     * @return mixed
     */
    public function resendMail(Email $email)
    {
        $email->setReposted();
        event(new SendMailEvent($email));
        return $this->showModel($email,'mail resent',200);
    }

    /**
     * @param $mail
     */
    public function getRecipient($mail)
    {
        $recipient = Email::with(['status','attachments','currentStatus'])
            ->where('recipient',$mail)->first();
        return $this->showModel($recipient,'mail fetched successfully');
    }
}
