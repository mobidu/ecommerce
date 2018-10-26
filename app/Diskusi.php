<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diskusi extends Model
{
    protected $table = 'diskusi';

    protected $with = 'child';

    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'id_customer');
    }

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    public function child()
    {
        return $this->hasMany(self::class, 'parent', 'id');
    }
}
