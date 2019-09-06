<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth ; 
use App\User;
use App\Custody;
use App\Permissions\Permissions ;
use App\Operation;

class CustodyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $__permissions = [ 'C' =>  Auth::user()->fresh()->has(Permissions::$PERMISSION_CREATE, Permissions::$CUSTODIS) , 
                         'R' =>  Auth::user()->fresh()->has(Permissions::$PERMISSION_READ, Permissions::$CUSTODIS),
                         'U' =>  Auth::user()->fresh()->has(Permissions::$PERMISSION_UPDATE, Permissions::$CUSTODIS),
                         'D' =>  Auth::user()->fresh()->has(Permissions::$PERMISSION_DELETE, Permissions::$CUSTODIS) , 
                         'T' =>  Auth::user()->fresh()->has(Permissions::$PERMISSION_RESCHEDULE, Permissions::$CUSTODIS) , 
                         'S' =>  Auth::user()->fresh()->has(Permissions::$PERMISSION_SEARCH, Permissions::$CUSTODIS) ,
                       ] ; 
        //return ['role' => Auth()->user()->role , 'permissions' =>$__permissions] ;
        $users = User::get(['user_id','name','accountBalance']) ; 
        return view('custodies.index',['permissions' => $__permissions , 'users' => $users]) ;
    }

    public function create(Request $request) {

        $user = User::find($request->input('user_id')) ; 
        $balance = $user->accountBalance ;
        $amount  = $request->input('amount') ;
        
        $afterBalance = $balance + (float) $amount ; 
        $user->accountBalance = $afterBalance ;
        
        if ($user->save()) {
            if (Custody::create([
                'user_id' => $request->input('user_id'),
                'amount' => $request->input('amount'),
                'term' => $request->input('term'),
                'balanceAfter' => $afterBalance
                
            ]))
                {
                    $name = User::find($request->input('user_id'))['name'] ;
                    Operation::create([
                        'user_id' => Auth::user()->user_id , 
                        'details' => "عهده جديدة للموظف $name" ,
                    ]) ;
                    return 'true' ;
                }   
            return 'false' ;
        }
        else
            return 'false' ;
    }

    
    public function get($id){
        $user = User::find($id) ;
        $custodies = Custody::where('user_id',$id)->get() ;
        return view('custodies.get',['custodies' => $custodies, 'user' => $user]) ;
    }


    public function search(Request $request){
        $users = [] ;
        
        $name = $request->input('name') ;

       // return $request ;


        $q = User::query() ;

        if ($name != '') 
            $q->where("name","LIKE" , $name);
        $users = $q->get() ;

        return view('custodies.search',['users' => $users,'operation' => 'search']) ;

    }

    public function refresh() {
        $users = User::get() ;
        return view('custodies.search',['users'=> $users,'operation' => 'refresh']) ;
    }

}
