<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth ;
use App\Permissions\Permissions ;
use App\Role ;
use View ;
use App\Operation ;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $permissions = [ 'C' =>  Auth::user()->has(Permissions::$PERMISSION_CREATE, Permissions::$ROLES) , 
                         'R' =>  Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$ROLES),
                         'U' =>  Auth::user()->has(Permissions::$PERMISSION_UPDATE, Permissions::$ROLES),
                         'D' =>  Auth::user()->has(Permissions::$PERMISSION_DELETE, Permissions::$ROLES) , 
                         'T' =>  Auth::user()->has(Permissions::$PERMISSION_RESCHEDULE, Permissions::$ROLES) , 
                         'S' =>  Auth::user()->has(Permissions::$PERMISSION_SEARCH, Permissions::$ROLES) ,
                       ] ; 
        $roles = Role::get() ;
 
        return view('roles.index',['roles' => $roles,'permissions' => $permissions]) ;
    }

    public function create(Request $request) {
        if (Role::create([
            'role_name' => $request->input('role_name'),
            'installments'   => 0, 
            'users'          => 0,  
            'store'          => 0,  
            'customers'      => 0,  
            'custody'        => 0,  
            'roles'          => 0,  
            'sponsors'       => 0,
            'reports'        => 0,
            'operations_log' => 0 
        ])) {
            $name = $request->input('role_name') ;
            Operation::create([
                'user_id' => Auth::user()->user_id , 
                'details' => "اضافه دور جديد باسم $name" ,
            ]) ;
            return 'true' ;
        }
        return 'false' ;
    }

    public function delete($id){
        $name = Role::find($id)['role_name'] ;
        if(Role::where('role_id',$id)->delete()){
            Operation::create([
                'user_id' => Auth::user()->user_id , 
                'details' => "حذف الدور $name" ,
            ]) ;
            return 'true' ;
        }
        return 'false' ;
    }
    public function get($id){
        
        $role = Role::find($id) ;
    
        return view('roles.get',['role'=>$role]); 
    }

    public function update(Request $request) {
        $installment = 0 ;
        if ($request->has('installments_c')) 
            $installment += ($request->input('installments_c')==="on" ? 1 : 0) * 1 ;
        if ($request->has('installments_r')) 
            $installment += ($request->input('installments_c')==="on" ? 1 : 0) * 2 ;
        if ($request->has('installments_u')) 
            $installment += ($request->input('installments_c')==="on" ? 1 : 0) * 4 ;
        if ($request->has('installments_d')) 
            $installment += ($request->input('installments_c')==="on" ? 1 : 0) * 8 ;
        if ($request->has('installments_t')) 
            $installment += ($request->input('installments_c')==="on" ? 1 : 0) * 16 ;
        if ($request->has('installments_s')) 
            $installment += ($request->input('installments_c')==="on" ? 1 : 0) * 32 ;

        $customers = 0; 
        if ($request->has('customers_c')) 
            $customers += ($request->input('customers_c')==="on" ? 1 : 0) * 1 ;
        if ($request->has('customers_r')) 
            $customers += ($request->input('customers_r')==="on" ? 1 : 0) * 2 ;
        if ($request->has('customers_u')) 
            $customers += ($request->input('customers_u')==="on" ? 1 : 0) * 4 ;
        if ($request->has('customers_d')) 
            $customers += ($request->input('customers_d')==="on" ? 1 : 0) * 8 ;
        if ($request->has('customers_t')) 
            $customers += ($request->input('customers_t')==="on" ? 1 : 0) * 16 ;
        if ($request->has('customers_s')) 
            $customers += ($request->input('customers_s')==="on" ? 1 : 0) * 32 ;

        $roles = 0 ; 
        if ($request->has('roles_c')) 
            $roles += ($request->input('roles_c')==="on" ? 1 : 0) * 1 ;
        if ($request->has('roles_r')) 
            $roles += ($request->input('roles_r')==="on" ? 1 : 0) * 2 ;
        if ($request->has('roles_u')) 
            $roles += ($request->input('roles_u')==="on" ? 1 : 0) * 4 ;
        if ($request->has('roles_d')) 
            $roles += ($request->input('roles_d')==="on" ? 1 : 0) * 8 ;
        if ($request->has('roles_t')) 
            $roles += ($request->input('roles_t')==="on" ? 1 : 0) * 16 ;
        if ($request->has('roles_s')) 
            $roles += ($request->input('roles_s')==="on" ? 1 : 0) * 32 ;

        $users = 0 ; 
        if ($request->has('users_c')) 
            $users += ($request->input('users_c')==="on" ? 1 : 0) * 1 ;
        if ($request->has('users_r')) 
            $users += ($request->input('users_r')==="on" ? 1 : 0) * 2 ;
        if ($request->has('users_u')) 
            $users += ($request->input('users_u')==="on" ? 1 : 0) * 4 ;
        if ($request->has('users_d')) 
            $users += ($request->input('users_d')==="on" ? 1 : 0) * 8 ;
        if ($request->has('users_t')) 
            $users += ($request->input('users_t')==="on" ? 1 : 0) * 16 ;
        if ($request->has('users_s')) 
            $users += ($request->input('users_s')==="on" ? 1 : 0) * 32 ;

        $reports = 0 ; 
        if ($request->has('reports_c')) 
            $reports += ($request->input('reports_c')==="on" ? 1 : 0) * 1 ;
        if ($request->has('reports_r')) 
            $reports += ($request->input('reports_r')==="on" ? 1 : 0) * 2 ;
        if ($request->has('reports_u')) 
            $reports += ($request->input('reports_u')==="on" ? 1 : 0) * 4 ;
        if ($request->has('reports_d')) 
            $reports += ($request->input('reports_d')==="on" ? 1 : 0) * 8 ;
        if ($request->has('reports_t')) 
            $reports += ($request->input('reports_t')==="on" ? 1 : 0) * 16 ;
        if ($request->has('reports_s')) 
            $reports += ($request->input('reports_s')==="on" ? 1 : 0) * 32 ;

        $custodies = 0 ; 
        if ($request->has('custodies_c')) 
            $custodies += ($request->input('custodies_c')==="on" ? 1 : 0) * 1 ;
        if ($request->has('custodies_r')) 
            $custodies += ($request->input('custodies_r')==="on" ? 1 : 0) * 2 ;
        if ($request->has('custodies_u')) 
            $custodies += ($request->input('custodies_u')==="on" ? 1 : 0) * 4 ;
        if ($request->has('custodies_d')) 
            $custodies += ($request->input('custodies_d')==="on" ? 1 : 0) * 8 ;
        if ($request->has('custodies_t')) 
            $custodies += ($request->input('custodies_t')==="on" ? 1 : 0) * 16 ;
        if ($request->has('custodies_s')) 
            $custodies += ($request->input('custodies_s')==="on" ? 1 : 0) * 32 ;

        $stock = 0 ; 
        if ($request->has('stock_c')) 
            $stock += ($request->input('stock_c')==="on" ? 1 : 0) * 1 ;
        if ($request->has('stock_r')) 
            $stock += ($request->input('stock_r')==="on" ? 1 : 0) * 2 ;
        if ($request->has('stock_u')) 
            $stock += ($request->input('stock_u')==="on" ? 1 : 0) * 4 ;
        if ($request->has('stock_d')) 
            $stock += ($request->input('stock_d')==="on" ? 1 : 0) * 8 ;
        if ($request->has('stock_t')) 
            $stock += ($request->input('stock_t')==="on" ? 1 : 0) * 16 ;
        if ($request->has('stock_s')) 
            $stock += ($request->input('stock_s')==="on" ? 1 : 0) * 32 ;

        $operations = 0 ; 
        if ($request->has('operations_c')) 
            $operations += ($request->input('operations_c')==="on" ? 1 : 0) * 1 ;
        if ($request->has('operations_r')) 
            $operations += ($request->input('operations_r')==="on" ? 1 : 0) * 2 ;
        if ($request->has('operations_u')) 
            $operations += ($request->input('operations_u')==="on" ? 1 : 0) * 4 ;
        if ($request->has('operations_d')) 
            $operations += ($request->input('operations_d')==="on" ? 1 : 0) * 8 ;
        if ($request->has('operations_t')) 
            $operations += ($request->input('operations_t')==="on" ? 1 : 0) * 16 ;
        if ($request->has('operations_s')) 
            $operations += ($request->input('operations_s')==="on" ? 1 : 0) * 32 ;

        $sponsors = 0 ; 
        if ($request->has('sponsors_c')) 
            $sponsors += ($request->input('sponsors_c')==="on" ? 1 : 0) * 1 ;
        if ($request->has('operations_r')) 
            $sponsors += ($request->input('sponsors_r')==="on" ? 1 : 0) * 2 ;
        if ($request->has('sponsors_u')) 
            $sponsors += ($request->input('sponsors_u')==="on" ? 1 : 0) * 4 ;
        if ($request->has('sponsors_d')) 
            $sponsors += ($request->input('sponsors_d')==="on" ? 1 : 0) * 8 ;
        if ($request->has('sponsors_t')) 
            $sponsors += ($request->input('sponsors_t')==="on" ? 1 : 0) * 16 ;
        if ($request->has('sponsors_s')) 
            $sponsors += ($request->input('sponsors_s')==="on" ? 1 : 0) * 32 ;

        $role = Role::find($request->input('role_id')) ;

        $role->role_name = $request->input('name') ;
        $role->installments = $installment ;
        $role->custody = $custodies ;
        $role->users = $users ;
        $role->customers = $customers ;
        $role->reports   =$reports ;
        $role->sponsors = $sponsors ;
        $role->operations_log = $operations ;
        $role->roles = $roles ;
        $role->store = $stock ;

        if($role->save()){
            $name = $request->input('name') ;
            Operation::create([
                'user_id' => Auth::user()->user_id , 
                'details' => "التعديل على الدور $name" ,
            ]) ;
            return 'true' ;
        }
        return 'false' ;


    }


    public function refresh() {
        $roles = Role::get() ;
        return view('roles.search',['roles'=> $roles]) ;
    }
}
