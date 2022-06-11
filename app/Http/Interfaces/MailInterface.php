<?php


namespace App\Http\Interfaces;


use App\Models\Email;

interface MailInterface
{
    public function createMail(array $data);
    public function resendMail(Email $email);
    public function getMail();
    public function getRecipient(String $mail);
}
