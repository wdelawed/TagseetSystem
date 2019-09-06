<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $primaryKey = 'role_id';

    protected $fillable = ['role_name', 
                            'installments'  , 
                            'users'          ,  
                            'store'          ,  
                            'customers'      ,
                            'custody'        ,
                            'roles'          ,
                            'sponsors'       ,
                            'reports'       , 
                            'operations_log'  ] ;

    public function hasPermission($permission, $on) {
        $data = $this->fresh()->value($on) ; 
        $data = (int) $data & $permission ; 
        $data = $data / $permission ; 
        return $data ;
    }
}
