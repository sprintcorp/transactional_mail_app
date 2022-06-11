<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['updated_at'];

    public function emails(): BelongsTo
    {
        return $this->belongsTo(Email::class,'email_id','id');
    }
}
