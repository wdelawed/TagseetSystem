<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    //
    public function getCustomer(){
        return $this->belongsTo('App\Customer','customer_id','id');
    }

    public function schedules(){
        return $this->hasMany('App\Schedule','installment_id','id') ;
    }

    public function creater(){
        return $this->belongsTo('App\User','creater_id','user_id') ;
    }
}

