<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //

    public function getInstallment() {
        return $this->belongsTo('App\Installment','installment_id','id') ;
    }
}
