<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DB;
use Auth ;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);

        return view("Customers.Index", compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Customers.Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file_name = time() . '.' . $request->file->getClientOriginalExtension();
        //echo $file_name;

        $customer = new Customer();

        $customer->name = $request->input('name');
        $customer->ident_number = $request->input('ident_number');
        $customer->type = $request->input('type');
        $customer->saudi_id = $request->input('saudi_id');
        $customer->saudi_id_date = $request->input('saudi_id_date');
        $customer->saudi_id_exp = $request->input('saudi_id_exp');
        $customer->address = $request->input('address');
        $customer->nationality = $request->input('nationality');
        $customer->phone = $request->input('phone');
        $customer->job	 = $request->input('job');
        $customer->company_name	 = $request->input('company_name');
        $customer->file = $file_name;
        $customer->sp_id = $request->input('sp_id');
        $customer->created_by = Auth::user()->user_id ;
        $customer->updated_by = Auth::user()->user_id ;
        $customer->save();

        $request->file->move(public_path('files'), $file_name);

        return redirect('/Customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers = Customer::find($id);

        return view('Customers.Show', compact('customers'));
    }

    public function search(Request $request)
    {
      $name = $request->get('name');
      $ident_number = $request->get('ident_number');

      $customers = DB::table('customers')->where([['name', 'like', '%' . $name . '%'], ['ident_number', '=', $ident_number]])->get();

      return view('Customers.Search', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $Customer = customer::find($id);

      return view('Customers.Edit', compact('Customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (isset($request->file)) {
        $file_name = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('files'), $file_name);
      }else {
        $file_name = '';
      }

      $customer = Customer::find($id);

      $customer->name = $request->input('name');
      $customer->ident_number = $request->input('ident_number');
      $customer->type = $request->input('type');
      $customer->saudi_id = $request->input('saudi_id');
      $customer->saudi_id_date = $request->input('saudi_id_date');
      $customer->saudi_id_exp = $request->input('saudi_id_exp');
      $customer->address = $request->input('address');
      $customer->nationality = $request->input('nationality');
      $customer->phone = $request->input('phone');
      $customer->job	 = $request->input('job');
      $customer->company_name	 = $request->input('company_name');
      $customer->file = $file_name;
      $customer->sp_id = $request->input('sp_id');

      $customer->save();

      return redirect('/Customers/'. $customer->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        $customer->delete();

        return redirect('/Customers');
    }
}
