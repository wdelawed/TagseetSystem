<?php

namespace App\Http\Controllers;

use App\Commodity;
use App\Bank ;
use App\Customer;
use App\Installment ;
use App\Schedule;
use Auth ;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth') ;
    }
    public function create(Request $request){
        $commodities = Commodity::get() ;
        $banks = Bank::get() ; 
        $customers = Customer::get() ;
        return view('installments.create',['commodities' => $commodities , 'banks' => $banks , 'customers' => $customers]) ;
    }
    public function getCommodity($id){
        $com = Commodity::find($id) ;
        return $com['name'].','.$com['description'].','.$com['price'] ;
    }

    public function store (Request $request){
        // $table->increments('id');
        // $table->string('description') ;
        // $table->bigInteger('price') ;
        // $table->integer('commodity_id')->unsigned() ; //foreign key 
        // $table->integer('customer_id')->unsigned() ;  //foreign key
        // $table->bigInteger('total_cost')->unsigned() ;
        // $table->integer('installment_duration') ;
        // $table->bigInteger('monthly_payment') ; 
        // $table->bigInteger('first_payment') ;
        // $table->float('interest') ;
        // $table->integer('schedule_id')->unsigned() ; // foreign key
        // $table->integer('schedule_duration') ;
        // $table->integer('management_fees') ;
        // $table->integer('creater_id')->unsigned() ; //foreign key

        $duration = (int) $request->input('duration') ; 
        $price = Commodity::find($request->input('commodity_id'))['price'] ; 
        $interest = (float) $request->input('interest') ; 
        $first_payment = (int) $request->input('first_payment') ; 
        $management_fees = (int) $request->input('management_fees') ; 
        $total = $price * (1+$interest) + $management_fees - $first_payment ;

        //return ['duration' => $duration , 'price' => $price, 'interest' => $interest , 'total' => $total] ;

        $installment = new Installment ;
        $installment->customer_id = $request->input('customer_id') ;
        $installment->commodity_id = $request->input('commodity_id') ;
        $installment->description = $request->input('description') ;
        $installment->price = Commodity::find($request->input('commodity_id'))['price'] ;
        $installment->total_cost = $total ;
        $installment->installment_duration = $request->input('duration') ;
        $installment->monthly_payment = floor($total/$duration) ;
        $installment->first_payment = $request->input('first_payment') ;
        $installment->interest = $request->input('interest') ;
        $installment->schedule_duration = 1;
        $installment->management_fees = $request->input('management_fees') ;
        $installment->creater_id = Auth::user()['user_id'] ;
        $installment->schedule_id = 0 ;

        if($installment->save()) {

            $monthly = floor($total/ $duration) ;
            $lastMonth = floor($monthly + $total % $duration) ;

            for ($i = 0 ; $i < $duration ; $i ++){
                //schedule table 
                // $table->increments('id');
                // $table->integer('installment_id')->unsigned() ; //foreign key
                // $table->integer('bank_id')->unsigned() ; //foreign key
                // $table->string('bank_receipt') ;
                // $table->date('scheduled_date') ;
                // $table->bigInteger('amount') ;
                // $table->bigInteger('payed') ;
                // $table->bigInteger('remaining') ;
                // $table->string('status') ;
                // $table->boolean('cash') ;

                $d=strtotime("+$i Months");

                $schedule = new  Schedule ; 
                $schedule->installment_id = $installment->id ;
                $schedule->bank_id = 1 ;
                $schedule->bank_receipt = "00000000" ;
                $schedule->scheduled_date = date("Y-m-d", $d) ;
                $schedule->payed = 0 ;
                $schedule->remaining = 1 ;
                $schedule->status = "جديد" ;
                $schedule->cash = false ;
                if($i === ($duration -1)){
                    $schedule->amount = $lastMonth ;
                }else{
                    $schedule->amount = $monthly ;
                }

                $schedule->save() ;

            }

            return 'true' ;
            
        }else {
            return 'false' ;
        }
        
    }

    public function getSchedule($id){
        $banks = Bank::get() ;
        $schedule = Schedule::find($id) ;
        $customerSchedules = $schedule->getInstallment()->first()->schedules()->get() ;
        //return $customerSchedules->get() ;
        $msg = '' ;
        $customer = $schedule->getInstallment()->first()->getCustomer()->first() ;
        $creater  = $schedule->getInstallment()->first()->creater['name'] ;
        return view('installments.getSchedule',['schedule' => $schedule , 'customerSchedules' => $customerSchedules , 'customer' => $customer , 'creater' => $creater , 'banks' => $banks, 'msg' => $msg]) ;
    }

    public function pay(Request $request){
        $banks = Bank::get() ;
        $schedule = Schedule::find($request->input('schedule_id')) ;

        if ($request->input('bank_id'))
            $schedule->bank_id = $request->input('bank_id') ;
        if($request->input('receipt'))
            $schedule->bank_receipt = $request->input('receipt') ;
        $schedule->payed   = $schedule->payed + (float) $request->input('amount') ;
        $schedule->remaining = $schedule->amount - $schedule->payed ;
        $schedule->cash = $request->input('cash') === "1" ? true : false ;

        if($schedule->save()) {
            $msg = '<div class="alert alert-success" role="alert">
                        تم الدفع بنجاح
                    </div>' ; 
        }else {
            $msg = '<div class="alert alert-danger" role="alert">
                        فشل في عمليه الدفع
                    </div>' ;
        }

        $customerSchedules = $schedule->getInstallment()->first()->schedules()->get() ;
        //return $customerSchedules->get() ;
        $customer = $schedule->getInstallment()->first()->getCustomer()->first() ;
        $creater  = $schedule->getInstallment()->first()->creater['name'] ;
        return view('installments.getSchedule',['schedule' => $schedule , 'customerSchedules' => $customerSchedules , 'customer' => $customer , 'creater' => $creater , 'banks' => $banks, 'msg' => $msg]) ;
    }
}
