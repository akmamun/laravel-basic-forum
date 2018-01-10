<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $guarded= [];

  public function owner()
  {
      return $this->belongsTo(User::class, 'user_id');
  }

    public function isTheOwner($user)
    {
        return $this->user_id == $user->id;
    }
    public function creator()//users
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
