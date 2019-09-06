@extends('layouts.app')
@section('content')
    <div class="panel-content">
        <div class="main-title-sec">
            <div class="row">
                <div class="col-md-3 column">
                    <div class="heading-profile">
                        <h2>إدارة العملاء</h2>
                        <span></span>
                    </div>
                </div>
            </div>
        </div><!-- Heading Sec -->
        <ul class="breadcrumbs">
            <li><a href="javascript:void(0)" title="">بحث</a></li>
            <li><a href="javascript:void(0)" title="">إضافة</a></li>
            <li><a href="javascript:void(0)" title="">تعديل</a></li>
        </ul>
        <div class="main-content-area">
            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <div class="widget-content">
                        {!! Form::open(['action' => 'CustomersController@search', 'method' => 'get' ]) !!}
                            <div class="form-group row">
                                <div class="col-md-6">
                                    {{ Form::label('رقم الهوية') }}
                                    {{ Form::number('ident_number', '', [
                                    'class' => 'form-control',
                                    'id' => 'exampleInputEmail1' ]) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('إسم العميل') }}
                                    {{ Form::text('name', '', [
                                    'placeholder' => 'مثال: محمد احمد',
                                    'class' => 'form-control',
                                    'id' => 'exampleInputEmail1' ]) }}
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        {{ Form::submit('بحث', ['class' => 'btn btn-success']) }}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <div class="widget-title">
                            جدول العملاء
                        </div>
                        <div class="widget-content">
                        <!--Show Table Customer -->
                        <table id="example2" class="table table-bordered text-center" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th>رقم</th>
                                    <th>اسم العميل</th>
                                    <th>رقم الهوية</th>
                                    <th>رقم الجوال</th>
                                    <th>العنوان</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($customers->count() > 0)
                                @foreach($customers as $cust)
                                            <tr>
                                                <td> {{ $cust->id }} </td>
                                                <td> {{ $cust->name}} </td>
                                                <td> {{ $cust->ident_number }}</td>
                                                <td> {{ $cust->phone }} </td>
                                                <td> {{ $cust->address }} </td>
                                                <td class="text-center">
                                                    <a href="/Customers/{{ $cust->id }}/edit" class="btn btn-success mini"><span class="fa fa-edit"></span> تعديل</a>
                                                    <a href="/Customers/{{ $cust->id }}" class="btn btn-info mini"><span class="fa fa-eye"></span> عرض</a>
                                                    {!! Form::open(['action' => ['CustomersController@destroy', $cust->id], 'method'=>'POST', 'style' => 'display: inline']) !!}
                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        <button class="btn btn-danger mini" type="submit"><span class="fa fa-trash"></span> حذف</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                    @endforeach
                                    @else
                                        <div class="alert alert-info">
                                        <strong>عفوا</strong> ليس هنالك عملاء
                                        </div>
                                    @endif
                            </tbody>
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
