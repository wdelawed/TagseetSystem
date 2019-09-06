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
            <li><a href="javascript:void(0)" title="">العمليات</a></li>
            <li><a href="javascript:void(0)" title="">سجل العمليات </a></li>
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
                                                <label for="user_id">اسم الموظف</label>
                                                <select name="user_id" id="user_id" class="form-control">
                                                    @foreach ($users as $user)
                                                        <option value="{{$user->user_id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="details">النص  </label>
                                                <input type="text" placeholder="" name="details" id="details" class="form-control">
                                            </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="from">من</label>
                                                <input type="date"  id="from" name="from" class="form-control calendar">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="to">الى </label>
                                                <input type="date"  id="to" name="to" class="form-control calendar">
                                            </div>
                                        </div>
                                        <br />
                                    @endif
                                    <div class="form-group">
                                        @if($permissions['S'])
                                            <button class="btn btn-info" type="button" onclick="search('searchForm','searchResult')">بحث</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if($permissions['R'])
                                @if (count($operations))
                                    <div class="widget">
                                        <div class="widget-title">
                                            الجدول
                                        </div>
                                        <div class="widget-content" id="searchResult">
                                            <table class="table table-bordered"  width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>رقم</th>
                                                        <th>التاريخ </th>
                                                        <th>الموظف </th>
                                                        <th>التفاصيل </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($operations as $operation)
                                                        <tr>
                                                            <td>{{$operation->id}}</td>
                                                            <td>{{$operation->created_at}}</td>
                                                            <td>{{$operation->user()->value('name')}}</td>
                                                            <td>{{$operation->details}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else 
                                <h3 class="text-center">  لايوجد عمليات حاليا   </h3>
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






@section('customSrcipts')
    <script type="text/javascript" src="{{asset('js/operations.js')}}"></script>
@endsection