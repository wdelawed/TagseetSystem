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
                </div>
            </div>
        </div><!-- Heading Sec -->
        <ul class="breadcrumbs">
            <li><a href="home/" title="">الرئيسية</a></li>
            <li><a href="javascript:void(0)" title="">الكفلاء</a></li>
            <li><a href="javascript:void(0)" title="">ادارة الكفلاء </a></li>
        </ul>
        <div class="main-content-area">
            <div class="row">
                <div class="col-md-12">
                        <div class="widget">
                            <div class="widget-content">
                                <form role="form" class="sec" id="searchForm">
                                    {{ csrf_field() }}
                                    @if ($permissions['S'])
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="name">اسم الكفيل</label>
                                                <input type="text" placeholder="اسم الموظف" name="name" id="name" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone">رقم الجوال </label>
                                                <input type="text" placeholder="رقم الجوال" name="phone" id="phone" class="form-control">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="address">السكن</label>
                                                <input type="text" placeholder="السكن" id="address" name="address" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="identityNum">رقم الهوية</label>
                                                <input type="text" placeholder="رقم الهوية" id="identityNum" name="identityNum" class="form-control">
                                            </div>
                                        </div>
                                        <br />
                                    @endif
                                    <div class="form-group">
                                        @if($permissions['S'])
                                            <button class="btn btn-info" type="button" onclick="search('searchForm','searchResult')">بحث</button>
                                        @endif
                                        @if($permissions['C'])
                                            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#createModal">جديد</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if($permissions['R'])
                                @if (count($sponsors))
                                    <div class="widget">
                                        <div class="widget-title">
                                            الجدول
                                        </div>
                                        <div class="widget-content" id="searchResult">
                                            <table class="table table-bordered"  width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>رقم</th>
                                                        <th>اسم الكفيل</th>
                                                        <th>رقم الجوال</th>
                                                        <th>رقم الهوية</th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($sponsors as $sponsor)
                                                        <tr>
                                                            <td>{{$sponsor->id}}</td>
                                                            <td>{{$sponsor->name}}</td>
                                                            <td>{{$sponsor->phone}}</td>
                                                            <td>{{$sponsor->identityNum}}</td>
                                                            <td>
                                                                <a href="#" class="taction" data-toggle="modal" onclick="edit({{$sponsor->id}})"><span class="fa fa-edit" ></span></a>
                                                                <a href="#" class="taction" data-toggle="modal" onclick="deleteFunc({{$sponsor->id}},'{{$sponsor->name}}',{{$sponsor->identityNum}})"><span class="fa fa-trash"></span></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else 
                                <h3 class="text-center">  لايوجد كفلاء حاليا   </h3>
                                @endif
                            @else 
                                <h3 class="text-center"> ليس لديك الاذن لعرض هذا المحتوى </h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Panel Content -->
@endsection

@section('create_modal')
    <div class="row">
        <div class="col-lg-12">
            <div class="widget">
                <div class="widget-title">
                    اضافة كفيل
                </div>
                <div class="widget-content">
                    <form method="post" action="sponsors/create" enctype="multipart/form-data" id="createForm">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="name">اسم الكفيل</label>
                                <input type="text" placeholder="" id="name" name="name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="phone">رقم الجوال</label>
                                <input type="tel" placeholder="" id="phone" name="phone" class="form-control">
                            </div>
                        </div>
                        <br />
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="address">السكن</label>
                                <input type="text" placeholder="" id="address" name="address" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="identityNum">رقم الهوية</label>
                                <input type="text" placeholder="" id="identityNum" name="identityNum" class="form-control">
                            </div>
                        </div>
                        <br />
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="bankAccount">
                                    رقم الحساب البنكي
                                </label>
                                <input type="number" placeholder="" id="bankAccount" name="bankAccount" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="salary">تعاريف بالراتب</label>
                                <input type="number" placeholder="" id="salary" name="salary" class="form-control">
                            </div>
                        </div>
                        <br />
                        <div class="form-group row">
                            <div class="col-md-6">
                                <h4 style="font-weight:bold">صورة الكفالة</h4>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 100%;">
                                        <img src="images/noimage.png" style="width:100%;height:auto !important;" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 10px;"></div>
                                    <div class="">
                                        <span class="btn btn-file btn-dark">
                                            <span class="fileinput-new"> اختر الصورة </span>
                                            <span class="fileinput-exists"> تغيير </span>
                                            <input type="hidden" value="" name="Pfile"><input type="file" accept="image/*" name="Pfile">
                                        </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" onclick="submitForm('createForm','createModal')" class="btn btn-success"> <span class="fa fa-save"></span> اضافه الكفيل</button>
                                <button type="button" class="btn  btn-danger" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('delete_modal')
    @if($permissions['D'])
        <div class="row">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-title">
                        حذف موظف
                    </div>
                    <div class="widget-content">
                        <form>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="employeeName">اسم الموظف</label>
                                    <input type="text" placeholder="" value="" id="employeeName" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="identityCard">رقم الهوية</label>
                                    <input type="text" placeholder="" value="" id="identityCard" class="form-control">
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="button" id="deleteButton" class="btn btn-success"> <span class="fa fa-save"></span> حذف العميل</button>
                                    <button type="button" class="btn  btn-danger" data-dismiss="modal">اغلاق</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else 
        <h3> ليس لديك اذن لحذف هذا المحتوى </h3>
    @endif
@endsection

@section('update_modal')
    @if($permissions['U'])
        <div class="row" id="updateModalContent">
        </div>
    @else 
        <h3> ليس لديك اذن لتعديل هذا المحتوى </h3>
    @endif
@endsection

@section('customSrcipts')
    <script type="text/javascript" src="{{asset('js/sponsors.js')}}"></script>
@endsection