<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public static function getMailInformation($id)
    {
        return self::query()->with(['status','attachments','currentStatus'])->where('id',$id)->first();
    }

    public function currentStatus(): HasOne
    {
        return $this->hasOne(Status::class)
            ->orderBy('id', 'DESC')
            ->latest();
    }

    public function setPosted($message='Mail posted')
    {
        $this->status()->create([
                'status' => self::$STATUS_POSTED,
                'description' => $message
            ]
        );
    }

    public function setReposted($message='Mail reposted')
    {
        $this->status()->create([
                'status' => self::$STATUS_REPOSTED,
                'description' => $message
            ]
        );
    }

    public function setSent($message='Mail sent')
    {
        $this->status()->create([
                'status' => self::$STATUS_SENT,
                'description' => $message
            ]
        );
    }

    public function setFailed($message='Mail failed')
    {
        $this->status()->create([
                'status' => self::$STATUS_FAILED,
                'description' => $message
            ]
        );
    }

}
