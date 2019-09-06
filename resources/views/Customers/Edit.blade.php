@extends('layouts.app')
@section('content')
<div class="panel-content">
    <div class="main-content-area">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget">
                            <div class="widget-title">
                                اضافة عميل
                            </div>
                            <div class="widget-content">
                              {!! Form::open(['action' => ['CustomersController@update', $Customer->id], 'enctype' => 'multipart/form-data' ]) !!}
                              {{ Form::hidden('_method', 'PUT') }}
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        {{ Form::label('رقم الهوية') }}
                                        {{ Form::number('ident_number', $Customer->ident_number, [
                                        'class' => 'form-control',
                                        'id' => 'exampleInputEmail1' ]) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::label('إسم العميل') }}
                                        {{ Form::text('name', $Customer->name, [
                                        'placehold' => 'مثال: محمد احمد',
                                        'class' => 'form-control',
                                        'id' => 'exampleInputEmail1' ]) }}
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        {{ Form::label('رقم الجوال') }}
                                        {{ Form::number('phone', $Customer->phone, [
                                        'placehold' => '+24912345678',
                                            'class' => 'form-control',
                                            'id' => 'exampleInputEmail1' ]) }}
                                        </div>
                                        <div class="col-md-6">
                                            {{ Form::label('الجنسية') }}
                                            {{ Form::select('nationality',
                                                ['سوداني' => 'سوداني', 'يمني' => 'يمني'],
                                                null,
                                                [
                                            'placehold' => 'الجنسية',
                                                'class' => 'form-control',
                                                'id' => 'exampleInputEmail1' ]) }}
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        {{ Form::label('رقم حفيظة النفوس') }}
                                        {{ Form::number('saudi_id', $Customer->saudi_id, [
                                        'placehold' => 'رقم حفيظة النفوس',
                                            'class' => 'form-control',
                                            'id' => 'exampleInputEmail1' ]) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::label('العنوان') }}
                                        {{ Form::text('address', $Customer->address, [
                                        'placehold' => 'العنوان',
                                            'class' => 'form-control',
                                            'id' => 'exampleInputEmail1' ]) }}
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-6">
                                            {{ Form::label('تاريخ حفيظة النفوس') }}
                                            {{ Form::date('saudi_id_date', \Carbon\Carbon::parse($Customer->saudi_id_date), [
                                            'class' => 'form-control',
                                            'id' => 'exampleInputEmail1' ]) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::label('مكان الاصدار') }}
                                        {{ Form::text('saudi_id_exp', $Customer->saudi_id_exp, [
                                        'placehold' => 'مكان اصدار حفظية النفوس',
                                        'class' => 'form-control',
                                        'id' => 'exampleInputEmail1' ]) }}
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-6">
                                          {{ Form::label('المهنة') }}
                                          {{ Form::text('job', $Customer->job, [
                                          'placehold' => 'المهنة',
                                           'class' => 'form-control',
                                           'id' => 'exampleInputEmail1' ]) }}
                                    </div>
                                    <div class="col-md-6">
                                      {{ Form::label('جهة العمل') }}
                                      {{ Form::text('company_name', $Customer->company_name, [
                                      'placehold' => 'جهة العمل',
                                       'class' => 'form-control',
                                       'id' => 'exampleInputEmail1' ]) }}
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                  <div class="col-md-6 col-md-offset-6">
                                    @if($Customer->type = 1)
                                        {{ Form::label('النوع : ') }}
                                        {{ Form::label('ذكر') }}
                                        {{ Form::radio('type', '1', true) }}

                                        {{ Form::label('انثى') }}
                                        {{ Form::radio('type', '0') }}
                                    @else
                                        {{ Form::label('النوع : ') }}
                                        {{ Form::label('ذكر') }}
                                        {{ Form::radio('type', '1') }}

                                        {{ Form::label('انثى') }}
                                        {{ Form::radio('type', '0' , true) }}
                                    @endif
                                  </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <button type="button" name="button" class = 'btn btn-info' style="margin-top: 25px">كفيل جديد</button>
                                    </div>
                                    <div class="col-md-6">
                                      {{ Form::label('الكفيل') }}
                                      {{ Form::select('sp_id',
                                       ['1' => 'محمد', '2' => 'احمد'],
                                        null,
                                        [
                                      'placehold' => 'الكفيل',
                                       'class' => 'form-control',
                                       'id' => 'exampleInputEmail1' ]) }}
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-6 col-md-offset-6">
                                        {{ Form::label('ملف') }}
                                        {{ Form::file('file', [
                                         'class' => 'form-control',
                                         'id' => 'exampleInputEmail1' ]) }}
                                    </div>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        {{ Form::submit('تعديل', ['class' => 'btn btn-success']) }}
                                    </div>
                                </div>
                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
