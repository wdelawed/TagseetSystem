<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth ;
use App\Permissions\Permissions ;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $x = Auth::user()->has(Permissions::$PERMISSION_CREATE, Permissions::$EMPLYEES) ;
        
        if ($x) 
            return 'true' ; 
        return 'false' ;
    }
}
