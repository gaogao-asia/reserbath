<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomFile extends Model
{
    protected $table = 'room_files';

    protected $fillable = [
        'room_id',
        'file_id',
    ];

    // Relations
    public function file()
    {
        return $this->belongsTo(\App\Models\File::class, 'file_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id', 'id');
    }
}
