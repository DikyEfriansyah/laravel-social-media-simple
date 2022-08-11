<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table='users';  //nama tabel

    protected $fillable =['name','email','password','date_birth','address','bio','photo'];  //nama-nama kolom yang akan di oleh (CRUD)

    public function feeds()
    {
        return $this->hasMany('App\Feed');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
