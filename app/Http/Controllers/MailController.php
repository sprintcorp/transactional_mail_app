<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\MailInterface;
use App\Http\Requests\MailRequest;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MailController extends Controller
{
    public function __construct(protected MailInterface $mailInterface){}

    /**
     * Display a listing of the mails.
     *
     * @return Response
     */
    public function index()
    {
        return $this->mailInterface->getMail();
    }

    /**
     * Store a newly created mail.
     *
     * @param MailRequest $request
     * @return Response
     */
    public function store(MailRequest $request)
    {
        return $this->mailInterface->createMail($request->all());
    }

    /**
     * Display mail information.
     *
     * @param Email $mail
     */
    public function show(Email $mail)
    {
        return $mail->with('status','attachments','currentStatus')->first();
    }

    /**
     * resend failed mail
     *
     * @param Email $mail
     * @return Response
     */
    public function resendMail(Email $mail)
    {
        return $this->mailInterface->resendMail($mail);
    }

    /**
     * Get recipient mail info
     *
     * @param $mail
     */
    public function getRecipient($mail)
    {
        return $this->mailInterface->getRecipient($mail);
    }
}
