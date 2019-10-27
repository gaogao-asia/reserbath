<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

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

    public function upload($image)
    {
        $path = Storage::disk('s3')->putFile('reserbath', $image, 'public');
        $url = Storage::disk('s3')->url($path);

        return $url;
    }
}
