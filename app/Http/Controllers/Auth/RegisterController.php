<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'string|max:255',
            'identityNum' => 'string|max:255' ,
            'bankAccount' => 'string|max:255' ,
            'profileImage' => 'string|max:255' ,
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

     /**
      * $table->increments('user_id');
         *   $table->string('name');
          *  $table->string('email')->unique();
          *  $table->string('password');
          *  $table->string('address') ;
          *  $table->string('identityNum') ;
          *  $table->string('bankAccount') ;
          *  $table->string('profileImage') ;
          *  $table->rememberToken();
          *  $table->timestamps();
      */
    protected function create(array $data)
    {
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'address' => 'alSoog Alarabi', //data['address'] ,
            'identityNum' => '12123122433',//data['identity_num'] ,
            'bankAccount' => '123123433',//data['bank_account'] ,
            'profileImage' => 'sdskssss.img',//data['profile_mage'] ,
            'role_id' => 1 ,
            'phone' => '249110015422'
        ]);
    }
}
