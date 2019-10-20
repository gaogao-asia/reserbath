<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'url',
        'title',
        'entity_type',
        's3_key',
        's3_bucket',
        's3_region',
    ];

    // Relations
}
