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
            <li><a href="javascript:void(0)" >التقارير</a></li>
            <li><a href="javascript:void(0)" >كشف حساب موظف </a></li>
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
                                                        <option value="{{$user->user_id}}" selected="{{$user->user_id === $selectedUser->user_id}}">{{$user->name}}</option>  
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <br/>
                                    <div class="form-group">
                                        @if($permissions['S'])
                                            <button class="btn btn-info" type="button" onclick="searchAccount('searchForm','searchResult')">بحث</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-12" id="searchResult">
                            @if($permissions['R'])
                                @if (count($custodies))
                                    <div class="widget" >
                                        <div class="widget-title">
                                            <div class="col-md-6">
                                                تفاصيل عهدة : {{$selectedUser->name}}
                                            </div>
                                            <div class="col-md-6">
                                                الرصيد النهائي : {{$selectedUser->accountBalance}}
                                            </div>
                                        </div>
                                        <div class="widget-content" >
                                            <table class="table table-bordered"  width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>رقم</th>
                                                        <th>التاريخ </th>
                                                        <th>مدين  </th>
                                                        <th>دائن</th>
                                                        <th>الرصيد</th>
                                                        <th>الشرح</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($custodies as $custody)
                                                        <tr>
                                                            <td>{{$custody->id}}</td>
                                                            <td>{{$custody->created_at}}</td>
                                                            @if ($custody->amount > 0 )
                                                                <td>{{$custody->amount}}</td>
                                                                <td>0</td>
                                                            @else
                                                                <td>0</td>
                                                                <td>{{$custody->amount * -1}}</td>
                                                            @endif
                                                            <td>{{$custody->balanceAfter}}</td>
                                                            <td>{{$custody->term}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @else 
                                <h3 class="text-center">  لايوجد عهد حاليا   </h3>
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
    <script type="text/javascript" src="{{asset('js/employees.js')}}"></script>
@endsection