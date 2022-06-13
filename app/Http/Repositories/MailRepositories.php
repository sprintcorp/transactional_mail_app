<?php


namespace App\Http\Repositories;


use App\Events\SendMailEvent;
use App\Filters\Recipient;
use App\Filters\Sender;
use App\Filters\Subject;
use App\Http\Interfaces\MailInterface;
use App\Models\Attachment;
use App\Models\Email;
use App\Traits\ApiResponse;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

class MailRepositories implements MailInterface
{
    use ApiResponse;

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
        $mails = app(Pipeline::class)
            ->send(Email::query()->with('currentStatus'))
            ->through([
                Recipient::class,
                Sender::class,
                Subject::class
            ])
            ->thenReturn()
            ->get();

        return $this->showAll($mails);
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
        $recipient = Email::with(['currentStatus'])
            ->where('recipient',$mail)->get();
        return $this->showModel($recipient,'mail fetched successfully');
    }
}
