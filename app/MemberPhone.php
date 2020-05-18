<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberPhone extends Model
{
    protected $fillable = ['user_id', 'phone'];
    

    public function member(){
        return $this->belongsTo('App\AdminMember' , 'id');
    }
}
