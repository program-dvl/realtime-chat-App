<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message','to_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sender() {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function recipient() {
        return $this->belongsTo('App\User', 'to_user_id');
    }
}
