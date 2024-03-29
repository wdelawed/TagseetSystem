<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    //
    protected $guarded = [] ; 

    public function user() {
        return $this->belongsTo('App\User','user_id','user_id') ;
    }
}
