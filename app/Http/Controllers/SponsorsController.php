<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth ;
use App\Permissions\Permissions ; 
use App\Sponsor ;

class SponsorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $permissions = [ 'C' =>  Auth::user()->has(Permissions::$PERMISSION_CREATE, Permissions::$SPONSORS) , 
                         'R' =>  Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$SPONSORS),
                         'U' =>  Auth::user()->has(Permissions::$PERMISSION_UPDATE, Permissions::$SPONSORS),
                         'D' =>  Auth::user()->has(Permissions::$PERMISSION_DELETE, Permissions::$SPONSORS) , 
                         'T' =>  Auth::user()->has(Permissions::$PERMISSION_RESCHEDULE, Permissions::$SPONSORS) , 
                         'S' =>  Auth::user()->has(Permissions::$PERMISSION_SEARCH, Permissions::$SPONSORS) ,
                       ] ; 

        $sponsors = Sponsor::get() ; 
        return view('sponsors.index',['permissions' => $permissions , 'sponsors' => $sponsors]) ;
    }

    public function create(Request $request) {
        if ($request->input('Pfile') != 'unchanged.jpg') {
            $request->Pfile->storeAs('sponsorsImages',$request->Pfile->getClientOriginalName()) ;
             
        }
        if (Sponsor::create([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'address' => $request->input('address'), 
            'identityNum' => $request->input('identityNum'),
            'bankAccount' => $request->input('bankAccount'),
            'sponsorshipImage' => 'storage/sponsorsImages/'.$request->Pfile->getClientOriginalName() ,      
            'phone' => $request->input('phone') ,
            'salary' =>$request->input('salary')
        ]))
            return 'true' ;
        return 'false' ;
    }

    public function delete($id){
        if(Sponsor::where('id',$id)->delete())
            return 'true' ;
        return 'false' ;
    }
    public function get($id){
        
        $sponsor = Sponsor::find($id) ;
        return view('sponsors.get',['sponsor' => $sponsor]) ;
    }

    public function update(Request $request) {
        $sponsor = Sponsor::find($request->input('id')) ; 
        if ($request->input('name') != "") 
            $sponsor->name = $request->input('name') ;


        if ($request->input('address') != "") 
            $sponsor->address = $request->input('address') ;

        if ($request->input('identityNum') != "") 
            $sponsor->identityNum = $request->input('identityNum') ;

        if ($request->input('bankAccount') != "") 
            $sponsor->bankAccount = $request->input('bankAccount') ;

        if ($request->input('salary') != "") 
            $sponsor->salary = $request->input('salary') ;

        if ($request->input('phone') != "") 
            $sponsor->phone = $request->input('phone') ;
            
        if ($request->input('Pfile') != 'unchanged.jpg') {
            $request->Pfile->storeAs('sponsorsImages',$request->Pfile->getClientOriginalName()) ;
            $sponsor->sponsorshipImage = 'storage/sponsorsImages/'.$request->Pfile->getClientOriginalName() ;
        }

        if($sponsor->save())
            return "true" ; 
        return "false" ; 

    }

    public function search(Request $request){
        $sponsors = [] ;
        
        $name = $request->input('name') ;
        $phone = $request->input('phone') ;
        $address = $request->input('address') ;
        $identityNum = $request->input('identityNum') ;

       // return $request ;


        $q = Sponsor::query() ;

        if ($name != '') 
            $q->where("name","LIKE" , $name);
        if ($phone != '') 
            $q->where("phone","LIKE" , $phone);
        if ($address != '') 
            $q->where("address","LIKE" , $address) ;
        if ($identityNum != '') 
            $q->where("identityNum","LIKE" , $identityNum) ;
        $sponsors = $q->get() ;

        return view('sponsors.search',['sponsors' => $sponsors,'operation' => 'search']) ;

    }

    public function refresh() {
        $sponsors = Sponsor::get() ;
        return view('sponsors.search',['sponsors'=> $sponsors,'operation'=>'refresh']) ;
    }

}
