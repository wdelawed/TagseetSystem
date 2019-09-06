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
            <li><a href="javascript:void(0)" title="">العهد</a></li>
            <li><a href="javascript:void(0)" title="">ادارة العهد</a></li>
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
                                                <label for="name">اسم الموظف</label>
                                                <input type="text" placeholder="اسم الموظف" name="name" id="name" class="form-control">
                                            </div>
                                        </div>
                                    @endif
                                    <br/>
                                    <div class="form-group">
                                        @if($permissions['S'])
                                            <button class="btn btn-info" type="button" onclick="search('searchForm','searchResult')">بحث</button>
                                        @endif
                                        @if($permissions['C'])
                                            <button type="button" data-target="#createModal" data-toggle="modal" class="btn btn-success">اضافه عهده جديدة</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if($permissions['R'])
                                @if (count($users))
                                    <div class="widget">
                                        <div class="widget-title">
                                            الجدول
                                        </div>
                                        <div class="widget-content" id="searchResult">
                                            <table class="table table-bordered"  width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>رقم</th>
                                                        <th>اسم الموظف</th>
                                                        <th>العهدة الحالية </th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <td>{{$user->user_id}}</td>
                                                            <td>{{$user->name}}</td>
                                                            <td>{{$user->accountBalance}}</td>
                                                            <td>
                                                                
                                                                @if($permissions['U'])
                                                                    <a href="#" class="taction" data-toggle="modal" onclick="edit({{$user->user_id}})" data-id="{{$user->user_id}}"><span class="fa fa-eye" ></span></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else 
                                <h3 class="text-center">  لايوجد موظفين حاليا   </h3>
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
 @if ($permissions['C'])
 <div class="modal-body">
    <form id="createForm" action="custodies/create" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <div class="col-md-6">
                <label for="exampleInputEmail1">اسم الموظف</label>
                <select class="form-control" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{$user->user_id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="amount"> المبلغ</label>
                <input type="number" placeholder="" id="amount" name="amount" class="form-control">
            </div>
            <br>
            <div class="col-md-6">
                <label for="term"> البند</label>
                <input type="text" placeholder="" id="term" name="term" class="form-control">
            </div>
        </div>
        <hr />
        <div class="form-group row">
            <div class="col-md-12">
                <button type="button" class="btn btn-success" onclick="submitForm('createForm','createModal')"> <span class="fa fa-save"></span> اضافه العهده</button>
                <button type="button" class="btn  btn-danger" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </form>
</div>  
 @else 
    <h3>ليس لديك الاذن لاضافه العهد</h3>
@endif
@endsection



@section('update_modal')
    @if($permissions['R'])
        <div class="row" id="updateModalContent">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-content">
                        <form>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">اسم الموظف</label>
                                    <input type="text" placeholder="السلعه" id="exampleInputEmail1" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">رقم الجوال</label>
                                    <input type="tel" placeholder="الوصف" id="exampleInputEmail1" class="form-control">
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">السكن</label>
                                    <input type="text" placeholder="السلعه" id="exampleInputEmail1" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">رقم الهوية</label>
                                    <input type="text" placeholder="" id="exampleInputEmail1" class="form-control">
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">
                                        رقم الحساب البنكي
                                    </label>
                                    <input type="number" placeholder="السلعه" id="exampleInputEmail1" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">الدور</label>
                                <select class="form-control">
                                    <option>موظف</option>
                                    <option>موظف</option>
                                    <option>موظف</option>
                                    <option>موظف</option>
                                </select>
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                            <img src="images/noimage.png" />
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
                                    <button type="submit" class="btn btn-success"> <span class="fa fa-save"></span> حفظ</button>
                                    <button type="button" class="btn  btn-danger" data-dismiss="modal">اغلاق</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else 
        <h3> ليس لديك اذن لعرض هذا المحتوى </h3>
    @endif
@endsection

@section('customSrcipts')
    <script type="text/javascript" src="{{asset('js/custodies.js')}}"></script>
@endsection