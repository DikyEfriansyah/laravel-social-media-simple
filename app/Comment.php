<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
    // public $timestamps = false; //kalau tidak ada kolom timestamps jadi perlu ini 
    protected $fillable=['comment','feeds_id','users_id','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Users','users_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Feed', 'id');
    }
}
