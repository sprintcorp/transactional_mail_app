<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('mail',MailController::class);
Route::put('resend-mail/{mail}',[MailController::class,'resendMail']);
Route::get('recipient-mail/{mail}',[MailController::class,'getRecipient']);
