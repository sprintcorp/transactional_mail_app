<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['updated_at'];

    public function email(): BelongsTo
    {
        return $this->belongsTo(Email::class,'email_id','id');
    }

    public static function uploadAttachment($files): array
    {
        $mailAttachments = [];
        foreach ($files as $file) {
            $encodedFilename = $file->hashName();
            $store = Storage::disk('local');
            $store->put('attachments/', $file);

            $mailAttachments[] = self::query()->make([
                'filename' => $encodedFilename,
                'original_filename' => $file->getClientOriginalName()
            ]);
        }
        return $mailAttachments;
    }

}
