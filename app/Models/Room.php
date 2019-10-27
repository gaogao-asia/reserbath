<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'content'
    ];

    // Relations
    public function roomScores()
    {
        return $this->hasMany(\App\Models\RoomScore::class, 'room_id', 'id');
    }

    public function roomFiles()
    {
        return $this->hasMany(\App\Models\RoomFile::class, 'room_id', 'id');
    }
}
