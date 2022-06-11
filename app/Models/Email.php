<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Email extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['updated_at'];

    public static string $STATUS_SENT = 'Sent';
    public static string $STATUS_FAILED = 'Failed';
    public static string $STATUS_POSTED = 'Posted';
    public static string $STATUS_REPOSTED = 'Reposted';

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class)
            ->orderBy('created_at', 'DESC');
    }

    public function status(): HasMany
    {
        return $this->hasMany(Status::class)
            ->orderBy('created_at', 'DESC');
    }

    public function setPosted($message='Email is queued for sending')
    {
        $this->status()->create([
                'status' => self::$STATUS_POSTED,
                'description' => $message
            ]
        );
    }

    public function setReposted($message='Email is queued again for sending')
    {
        $this->status()->create([
                'status' => self::$STATUS_REPOSTED,
                'description' => $message
            ]
        );
    }

    public function setSent($message='Email is sent')
    {
        $this->status()->create([
                'status' => self::$STATUS_SENT,
                'description' => $message
            ]
        );
        self::query()->update(['status'=>1]);
    }

    public function setFailed($message='Email failed')
    {
        $this->status()->create([
                'status' => self::$STATUS_FAILED,
                'description' => $message
            ]
        );
    }

}
