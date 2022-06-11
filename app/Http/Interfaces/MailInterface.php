<?php


namespace App\Http\Interfaces;


interface MailInterface
{
    public function createMail($data);
    public function getMail();
}
