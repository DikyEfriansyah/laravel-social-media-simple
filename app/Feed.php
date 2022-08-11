<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $table='feeds';  //nama tabel
    protected $fillable = [
        'id','caption', 'img', 'likes_cnt','comments_cnt','users_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Users','users_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    
    public function comment()
    {
        return $this->hasMany('App\Comment', 'feeds_id');
    }
}
