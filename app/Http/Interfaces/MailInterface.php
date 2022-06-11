<?php


namespace App\Http\Interfaces;


interface MailInterface
{
    public function createMail($data);
    public function resendMail($data);
    public function getMail();
    public function getRecipient($data);
}
