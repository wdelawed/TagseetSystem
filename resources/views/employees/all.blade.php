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
            <li><a href="javascript:void(0)" title="">التقارير</a></li>
            <li><a href="javascript:void(0)" title="">جرد عهد الموظفين </a></li>
        </ul>
        <div class="main-content-area">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-bold">
                        جرد عهد الموظفين
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if($permissions['R'])
                                @if (count($users))
                                    <div class="widget">
                                        <div class="widget-content" id="searchResult">
                                            <table class="table table-bordered"  width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>رقم</th>
                                                        <th>اسم الموظف</th>
                                                        <th>رصيد العهدة </th>
                                                        <th>المصروفات </th>
                                                        <th>اجمالي العقود </th>
                                                        <th>الرصيد المتبقي </th>
                                                        <th>ملاحظات </th>
                                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <td>{{$user->user_id}}</td>
                                                            <td>{{$user->name}}</td>
                                                            <td>{{$user->custody_balance}}</td>
                                                            <td>{{$user->spends}}</td>
                                                            <td>{{$user->total_contracts}}</td>
                                                            <td>{{$user->accountBalance}}</td>
                                                            <td>{{$user->notes}}</td>
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

