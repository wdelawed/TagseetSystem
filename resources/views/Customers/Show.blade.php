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
                                  <th>الجنسية</th>
                                  <th>رقم حفيظة النفوس</th>
                                  <th>مكان اصدار حفيظة النفوس</th>
                                  <th>تاريخ اصدار حفيظة النفوس</th>
                                  <th>جهة العمل</th>
                                  <th>المهنة</th>
                                  <th>النوع</th>
                              </tr>
                          </thead>
                          <tbody>
                                <tr>
                                    <td> {{ $customers->id }} </td>
                                    <td> {{ $customers->name}} </td>
                                    <td> {{ $customers->ident_number }}</td>
                                    <td> {{ $customers->phone }} </td>
                                    <td> {{ $customers->address }} </td>
                                    <td> {{ $customers->nationality }} </td>
                                    <td> {{ $customers->saudi_id }} </td>
                                    <td> {{ $customers->saudi_id_exp }} </td>
                                    <td> {{ $customers->saudi_id_date }} </td>
                                    <td> {{ $customers->company_name }} </td>
                                    <td> {{ $customers->job }} </td>
                                    <td>
                                      @if($customers->type = 1)
                                        ذكر
                                      @else
                                        انثي
                                      @endif
                                    </td>
                                </tr>
                          </tbody>
                          <a href="/Customers/{{ $customers->id }}/edit" class="btn btn-success mini"><span class="fa fa-edit"></span> تعديل</a>
                            {!! Form::open(['action' => ['CustomersController@destroy', $customers->id], 'method'=>'POST', 'style' => 'display: inline']) !!}
                              {{ Form::hidden('_method', 'DELETE') }}
                              <button class="btn btn-danger mini" type="submit"><span class="fa fa-trash"></span> حذف</button>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
