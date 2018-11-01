<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='post';

    public function gambar()
    {
        return $this->hasOne('App\Media_image', 'id','id_media');
    }
}
