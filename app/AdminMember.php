<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMember extends Model
{
    protected $fillable = ['avatar', 'name', 'nickname', 'account' , 'password', 'email'];
 

    public function phone()
    {
        return $this->hasOne('App\MemberPhone', 'user_id');
    }

}