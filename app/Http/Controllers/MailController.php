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
     * @return Response
     */
    public function show(Email $mail)
    {
        return $mail->with('status','attachments')->first();
    }

    /**
     * resend failed mail
     *
     * @param Email $mail
     * @return Response
     */
    public function update(Email $mail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Email $mail
     * @return Response
     */
    public function destroy(Email $mail)
    {
        //
    }
}
