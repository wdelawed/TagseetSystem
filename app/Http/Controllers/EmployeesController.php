<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth ;
use App\Permissions\Permissions ;
use App\Role;
use App\User;

class EmployeesController extends Controller
{
    // this controller will handle employees 
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $permissions = [ 'C' =>  Auth::user()->has(Permissions::$PERMISSION_CREATE, Permissions::$EMPLYEES) , 
                         'R' =>  Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$EMPLYEES),
                         'U' =>  Auth::user()->has(Permissions::$PERMISSION_UPDATE, Permissions::$EMPLYEES),
                         'D' =>  Auth::user()->has(Permissions::$PERMISSION_DELETE, Permissions::$EMPLYEES) , 
                         'T' =>  Auth::user()->has(Permissions::$PERMISSION_RESCHEDULE, Permissions::$EMPLYEES) , 
                         'S' =>  Auth::user()->has(Permissions::$PERMISSION_SEARCH, Permissions::$EMPLYEES) ,
                       ] ; 
        $roles = Role::get(['role_id','role_name']) ;

        $users = User::get() ; 
        return view('employees.index',['permissions' => $permissions , 'users' => $users,'roles' => $roles]) ;
    }

    public function create(Request $request) {
        if ($request->input('Pfile') != 'unchanged.jpg') {
            $request->Pfile->storeAs('profileImages',$request->Pfile->getClientOriginalName()) ;
             
        }
        if (User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'address' => $request->input('address'), 
            'identityNum' => $request->input('identityNum'),
            'bankAccount' => $request->input('bankAccount'),
            'profileImage' => 'storage/profileImages/'.$request->Pfile->getClientOriginalName() ,
            'role_id' => $request->input('role_id') ,
            'phone' => $request->input('phone')
        ]))
            return 'true' ;
        return 'false' ;
    }

    public function delete($id){
        if(User::where('user_id',$id)->delete())
            return 'true' ;
        return 'false' ;
    }
    public function get($id){
        
        $user = User::find($id) ;
        $user_role = User::find($id)->role()->get(['role_id','role_name'])->first() ;
        $roles = Role::get(['role_id','role_name']) ;
        return view('employees.get',['user' => $user,
                                     'user_role' => $user_role,
                                     'roles' =>$roles]) ;
    }

    public function update(Request $request) {
        $user = User::find($request->input('user_id')) ; 
        if ($request->input('name') != "") 
            $user->name = $request->input('name') ;

        if ($request->input('email') != "") 
            $user->email = $request->input('email') ;

        if ($request->input('password') != "") 
            $user->password = bcrypt($request->input('password')) ;

        if ($request->input('address') != "") 
            $user->address = $request->input('address') ;

        if ($request->input('identityNum') != "") 
            $user->identityNum = $request->input('identityNum') ;

        if ($request->input('bankAccount') != "") 
            $user->bankAccount = $request->input('bankAccount') ;

        if ($request->input('role_id') != "") 
            $user->role_id = $request->input('role_id') ;

        if ($request->input('phone') != "") 
            $user->phone = $request->input('phone') ;
            
        if ($request->input('Pfile') != 'unchanged.jpg') {
            $request->Pfile->storeAs('profileImages',$request->Pfile->getClientOriginalName()) ;
            $user->profileImage = 'storage/profileImages/'.$request->Pfile->getClientOriginalName() ;
        }

        if($user->save())
            return "true" ; 
        return "false" ; 

    }

    public function search(Request $request){
        $users = [] ;
        
        $name = $request->input('name') ;
        $phone = $request->input('phone') ;
        $address = $request->input('address') ;
        $identityNum = $request->input('identityNum') ;

       // return $request ;


        $q = User::query() ;

        if ($name != '') 
            $q->where("name","LIKE" , $name);
        if ($phone != '') 
            $q->where("phone","LIKE" , $phone);
        if ($address != '') 
            $q->where("address","LIKE" , $address) ;
        if ($identityNum != '') 
            $q->where("identityNum","LIKE" , $identityNum) ;
        $users = $q->get() ;

        return view('employees.search',['users' => $users]) ;

    }

    public function refresh() {
        $users = User::get() ;
        return view('employees.search',['users'=> $users]) ;
    }

}
