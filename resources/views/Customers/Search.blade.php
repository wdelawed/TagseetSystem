@extends('layouts.app')
@section('content')
  <div class="panel-content">
    <div class="main-content-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-title">
                      بيانات العميل
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
                          </tbody>

                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
