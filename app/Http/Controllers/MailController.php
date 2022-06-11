<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\MailInterface;
use App\Http\Requests\MailRequest;
use App\Models\UserMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MailController extends Controller
{
    public function __construct(protected MailInterface $mail){}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->mail->getMail();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MailRequest $request
     * @return Response
     */
    public function store(MailRequest $request)
    {
        return $this->mail->createMail($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param UserMail $mail
     * @return Response
     */
    public function show(UserMail $mail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param UserMail $mail
     * @return Response
     */
    public function update(Request $request, UserMail $mail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserMail $mail
     * @return Response
     */
    public function destroy(UserMail $mail)
    {
        //
    }
}
