<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OauthProvider extends Model
{
    use HasFactory;
    protected $table = 'oauth_providers';

    // Field yang boleh diisi (fillable)
    protected $fillable = [
        'user_id',
        'provider',
        'oauth_id',
    ];

    /**
     * Relasi ke model User.
     * Setiap OauthProvider berhubungan dengan satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
