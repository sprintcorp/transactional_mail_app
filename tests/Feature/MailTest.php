<?php

namespace Tests\Feature;

use App\Events\SendMailEvent;
use App\Listeners\SendMailListener;
use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A user can create mail.
     *
     * @return void
     */
    public function testUserCanCreateEmail()
    {
        $listener = \Mockery::spy(SendMailEvent::class);
        $this->app->instance(SendMailListener::class, $listener);

        $mail = Email::factory()->make();

        $upload_file = UploadedFile::fake()->image('dummy.png');

        $response = $this->post("/api/mail",$mail->toArray(), [
            'attachments' => [
                0 => $upload_file
            ]
        ]);
        $response->assertStatus(201);
    }

    public function testUserCanFetchMails()
    {
        $response = $this->get('/api/mail');
        $response->assertStatus(200);
    }

    public function testUserCanViewMail()
    {
        $mail = Email::factory()->create();
        $response = $this->get("/api/mail/{$mail->id}");
        $response->assertStatus(200);
    }

    public function testUserCanResendMail()
    {
        $mail = Email::factory()->create();
        $response = $this->put("/api/resend-mail/{$mail->id}");
        $response->assertStatus(200);
    }

    public function testUserCanViewRecipient()
    {
        $mail = Email::factory()->create();
        $response = $this->get("/api/recipient-mail/{$mail->recipient}");
        $response->assertStatus(200);
    }

    public function testUserCanSearch()
    {
        $mail = Email::factory()->create();
        $response = $this->get("/api/mail?search={$mail->recipient}");
        $response->assertStatus(200);
    }


    public function testUserCanFetchPaginatedData()
    {
        $response = $this->get("/api/mail?page=2");
        $response->assertStatus(200);
    }
}
