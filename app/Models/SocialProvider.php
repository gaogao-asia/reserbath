<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $table = 'social_providers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'provider_id',
        'provider',
    ];

    const PROVIDER_TWITTER = 'twitter';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
