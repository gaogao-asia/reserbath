<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomScore extends Model
{
    protected $table = 'room_scores';

    protected $fillable = [
        'room_id',
        'user_id',
        'score'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id', 'id');
    }
}
