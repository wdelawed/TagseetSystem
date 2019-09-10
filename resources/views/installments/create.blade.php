@extends('layouts.app')
@section('content')
<div class="panel-content">
    <div class="main-title-sec">
        <div class="row">
            <div class="col-md-3 column">
                <div class="heading-profile">
                    <h2> لوحة التحكم </h2>
                    <span>مرحباً بعودتك</span>
                </div>
            </div>
            <div class="col-md-9 column">
                <!--      <div id="reportrange" class="date-range">
                <i class="fa fa-calendar-o"></i>
                <span></span> <b class="caret"></b>
                </div>
                <div class="quick-btn-title">
                    <a href="javascript:void(0)" title=""><i class="fa fa-plus"></i> New Tasks</a>
                    <a href="javascript:void(0)" title=""><i class="fa fa-cloud-upload"></i> Upload Files</a>
                </div> -->
            </div>
        </div>
    </div><!-- Heading Sec -->
    <ul class="breadcrumbs">
        <li><a href="javascript:void(0)" title="">الاقساط</a></li>
        <li><a href="javascript:void(0)" title="">قسط جديد</a></li>
    </ul>
    <div class="main-content-area">
        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <div class="widget-title">
                        <h3>قسط جديد</h3>
                        <div class="widget-controls">
                            <span class="close-content"><i class="fa fa-trash-o"></i></span>
                            <span class="expand-content"><i class="fa fa-expand"></i></span>
                            <span class="refresh-content"><i class="fa fa-refresh"></i></span>
                        </div><!-- Widget Controls -->
                    </div>
                    <div class="widget-content">
                        <form role="form" class="sec" method="post" >
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="customer_id">اسم العميل</label>
                                    <select class="form-control" name="customer_id" id="customer_id"> 
                                        @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" style="margin-top:20px;" class="btn btn-lg btn-info" data-toggle="modal" data-target=".large-modal3"><span class="fa fa-plus"></span>اضافة عميل</button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="commodity_id">السلعه</label>
                                    <select name="commodity_id" class="form-control" id="commodity_id" onchange="getCommodity(this.options[this.selectedIndex].value)">
                                        <option value="-1">اختر من القائمه</option>
                                        @foreach ($commodities as $commodity)
                                            <option value="{{$commodity->id}}">{{$commodity->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="description">الوصف</label>
                                    <input type="text" placeholder="الوصف" id="description" name="description" class="form-control">
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="price"> سعر السلعه الاساسي</label>
                                    <input type="number" disabled placeholder="" id="price" name="price" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="installment_duration" >مدة القسط</label>
                                    <select class="form-control" onchange="calculateTotal()" name="duration" id="duration">
                                        <option value="0">اختر من القائمه </option>
                                        <option value="6">6 اشهر</option>
                                        <option value="12">سنه</option>
                                        <option value="18">سنه ونصف </option>
                                        <option value="24">سنتين  </option>
                                    </select>
                                </div>
                            </div>
                    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="monthly_payment">القسط الشهري</label>
                                            <input type="number" disabled placeholder="القسط الشهري" id="monthly_payment" name="monthly_payment" class="form-control">
                                        </div>
                                    </div> <br />
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="first_payment" >الدفعه الاولى</label>
                                            <input type="number" value="0" onkeyup="calculateTotal()" placeholder="الدفعه الاولى" id="first_payment" name="first_payment" class="form-control">
                                        </div>
                                    </div> <br />
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="interest" >نسية الفائدة</label>
                                            <select class="form-control" name="interest" id="interest" onchange="calculateTotal()">
                                                <option value=".05">5 %</option>
                                                <option value=".1">10 %</option>
                                                <option value=".2">20 %</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="management_fees">رسوم ادارية</label>
                                            <input type="number" value="100" onkeyup="calculateTotal()" placeholder="رسوم ادارية" id="management_fees" name="management_fees" class="form-control">
                                        </div>
                                    </div>
                                    <br />
                                    <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="total"> اجمالي المبلغ</label>
                                                <input type="number" disabled placeholder="" id="total" name="total" class="form-control">
                                            </div>
                                        </div>
                                        <br />
                                </div>
                                <div class="col-md-6">
                                    <div class="widget">
                                        <div class="widget-title">
                                            جدولة السداد
                                        </div>
                                        <div class="widget-content" style="max-height:347px; overflow:auto;" id="scheduleTableHolder">
                                            <h4>جدول السداد سيظهر هنا</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group">
                                <button class="btn green-bg pull-right" type="submit">حفظ</button>
                            </div>
                        </form>
                    </div><!-- Save Draft -->
                </div>
            </div>
        </div>
    </div>
</div><!-- Panel Content -->
@endsection

@section('customSrcipts')
    <script type="text/javascript" src="{{asset('js/installments.js')}}"></script>
@endsection