<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','identityNum','bankAccount','profileImage','role_id' ,'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $attributes = [
        'accountBalance' => 0,
    ];

    public function role(){
        return $this->belongsTo("App\Role","role_id") ; 
    }

    public function has($permission, $on) {
        $data = $this->role[$on] ; 
        $data = (int) $data & $permission ; 
        $data = $data / $permission ; 
        return $data  ;
    }

    public function custodies() {
        return $this->hasMany('App\Custody','user_id') ;
    }
    
}
