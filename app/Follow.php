<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table='following';  //nama tabel
    protected $fillable = [
        'id', 'users_id', 'following_id','following_username'
    ];

    public function user()
    {
        return $this->belongsTo('App\Users','users_id');
    }
}
