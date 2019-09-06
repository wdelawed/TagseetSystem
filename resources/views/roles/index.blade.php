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
            <li><a href="roles/" title="">ادارة الادوار</a></li>
        </ul>
        <div class="main-content-area">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-12">
                            @if($permissions['R'])
                                @if (count($roles))
                                    <div class="widget">
                                        <div class="widget-title row">
                                           <div class="col-md-10">
                                               جدول الادوار
                                           </div>
                                           <div class="col-md-2">
                                               <button role="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">اضافة دور جديد</button>
                                           </div>
                                        </div>
                                        <div class="widget-content" id="searchResult">
                                            <table class="table table-bordered"  width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الدور </th>
                                                        <th>العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($roles as $role)
                                                        <tr>
                                                            <td>{{$role->role_id}}</td>
                                                            <td>{{$role->role_name}}</td>
                                                            <td>
                                                                <a href="#" class="taction" data-toggle="modal" onclick="edit({{$role->role_id}})""><span class="fa fa-edit" ></span></a>
                                                                <a href="#" class="taction" data-toggle="modal" onclick="deleteFunc({{$role->role_id}},'{{$role->role_name}}')"><span class="fa fa-trash"></span></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else 
                                <h3 class="text-center">  لايوجد ادوار حاليا   </h3>
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
                    اضافة دور
                </div>
                <div class="widget-content">
                    <form method="POST" action="roles/create" enctype="multipart/form-data" id="createForm">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="role_name">اسم الدور</label>
                                <input type="text" placeholder="اسم الدور" id="role_name" name="role_name" class="form-control">
                            </div>
                        </div>
                        <hr />
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success" onclick="submitForm('createForm','createModal')"> <span class="fa fa-save"></span> اضافة دور جديد</button>
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
                        حذف دور
                    </div>
                    <div class="widget-content">
                        <form>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="roleName">اسم الدور</label>
                                    <input type="text" placeholder="" value="" id="roleName" class="form-control">
                                </div>   
                            </div>
                            <hr />
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="button" id="deleteButton" class="btn btn-success"> <span class="fa fa-save"></span> حذف الدور</button>
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
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-content">
                        <form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else 
        <h3> ليس لديك اذن لتعديل هذا المحتوى </h3>
    @endif
@endsection

@section('customSrcipts')
    <script type="text/javascript" src="{{asset('js/roles.js')}}"></script>
@endsection