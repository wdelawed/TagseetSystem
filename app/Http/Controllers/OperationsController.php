<?php

namespace App\Http\Controllers;

use App\Operation;
use Auth ;
use App\Permissions\Permissions ;
use App\User ;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $permissions = [ 'C' =>  Auth::user()->has(Permissions::$PERMISSION_CREATE, Permissions::$OPERATIONS_LOG) , 
                         'R' =>  Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$OPERATIONS_LOG),
                         'U' =>  Auth::user()->has(Permissions::$PERMISSION_UPDATE, Permissions::$OPERATIONS_LOG),
                         'D' =>  Auth::user()->has(Permissions::$PERMISSION_DELETE, Permissions::$OPERATIONS_LOG) , 
                         'T' =>  Auth::user()->has(Permissions::$PERMISSION_RESCHEDULE, Permissions::$OPERATIONS_LOG) , 
                         'S' =>  Auth::user()->has(Permissions::$PERMISSION_SEARCH, Permissions::$OPERATIONS_LOG) ,
                       ] ; 
        //return $permissions ;
        $operations = Operation::get() ; 
        $users = User::get() ;
        return view('operations.index',['permissions' => $permissions , 'operations' => $operations,'users' => $users]) ;
    }

    public function search(Request $request){
        $permissions = [ 'C' =>  Auth::user()->has(Permissions::$PERMISSION_CREATE, Permissions::$OPERATIONS_LOG) , 
                         'R' =>  Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$OPERATIONS_LOG),
                         'U' =>  Auth::user()->has(Permissions::$PERMISSION_UPDATE, Permissions::$OPERATIONS_LOG),
                         'D' =>  Auth::user()->has(Permissions::$PERMISSION_DELETE, Permissions::$OPERATIONS_LOG) , 
                         'T' =>  Auth::user()->has(Permissions::$PERMISSION_RESCHEDULE, Permissions::$OPERATIONS_LOG) , 
                         'S' =>  Auth::user()->has(Permissions::$PERMISSION_SEARCH, Permissions::$OPERATIONS_LOG) ,
                       ] ;
        $operations = [] ;
        
        $user_id = $request->input('user_id','') ;
        $details = $request->input('details','') ;
        $from = $request->input('from','') ;
        $to = $request->input('to','') ;

        //return $request ;

    
        $q = Operation::query() ;

        if ($user_id != '') 
            $q->where("user_id","LIKE" , $user_id);
        if ($details != '') 
            $q->where("details","LIKE" , '%'.$details.'%');
        if ($from != '') 
            $q->where("created_at",">=" , $from) ;
        if ($to != '') 
            $q->where("created_at","<=" , $to) ;
        $operations = $q->get() ;

        return view('operations.search',['operations' => $operations,'permissions'=>$permissions]) ;

    }

}
