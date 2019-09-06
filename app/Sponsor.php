<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = ['name','phone','address','identityNum','bankAccount','salary','sponsorshipImage'] ; 
}
