<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">سداد</h4>
    </div>
    <div class="modal-body">
        @if ($msg)
            {!!$msg!!}
        @endif
        <form action="/installments/pay" method="post" id="payForm">
            {{ csrf_field() }}
            <input type="hidden" name="schedule_id" value="{{$schedule->id}}">
            <div class="row">
                <div class="col-md-6">
                <label>  :العميل  </label><h4><b>{{$customer->name}}</b></h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-2" for="schedule_id">تاريخ القسط</label>
                        <select class="form-control" name="schedule_id" id="schedule_id" onchange="getSchedule($(this).val())">
                            @foreach ($customerSchedules as $_schedule)
                                <option value="{{$_schedule->id}}" {{$schedule->id === $_schedule->id ? 'selected' : ''}}>{{$_schedule->scheduled_date}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="radio-group ">
                        <input value="0" onclick="choose(1)" type="radio" class="radio-group" name="cash" id="bank" checked>
                        <label for="bank" >بنك</label>
                        <input value="1" onclick="choose(0)" type="radio" class="radio-group" name="cash" id="cash" >
                        <label for="cash">كاش</label><br>
                        <div class="form-group">
                            <label for="bank_id">اسم البنك</label>
                            <select name="bank_id" id="bank_id" class="form-control" {{$schedule->payed ? 'disabled' : ''}}>
                                @foreach ($banks as $bank)
                                    <option value="{{$bank->id}}" {{($schedule->payed > 0 && $schedule->bank_id == $bank->id) ? 'selected' : ''}}>{{$bank->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="receipt">رقم الايصال</label>
                            <input type="number" class="form-control" name="receipt" id="receipt" value="{{$schedule->payed > 0 ? $schedule->bank_receipt : ''}}" {{$schedule->payed ? 'disabled' : ''}}>
                        </div>
                        <div class="form-group">
                            <label for="payed">المدفوع</label>
                            <input type="number" class="form-control" name="payed" id="payed" value="{{$schedule->payed > 0 ? $schedule->payed : ''}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="amount">ادفع الان</label>
                            <input type="number" class="form-control" name="amount" id="amount" value="0">
                        </div>
                    </div>
                    <div>
                        تم فتح القسط بواسطة الموظف: <br />
                        <b>{{$creater}}</b>
                    </div>
                    <hr />
                    <div class="form-group">
                        <button type="button" class="btn btn-success"  onclick="submitForm('payForm')">سداد القسط</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">حفظ واغلاق</button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="widget">
                        <div class="widget-title">
                            جدولة السداد
                        </div>
                        <div class="widget-content" style="overflow: auto;max-height: 202px;">
                            <table  class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            رقم
                                        </th>
                                        <th>التاريخ</th>
                                        <th>المبلغ</th>
                                        <th>المسدد</th>
                                        <th>الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-info">
                                        <td>{{$schedule->id}}</td>
                                        <td>{{$schedule->scheduled_date}}</td>
                                        <td>{{$schedule->amount}}</td>
                                        <td>{{$schedule->payed}}</td>
                                        <td>{{$schedule->status}}</td>
                                    </tr>
                                    @foreach ($customerSchedules as $__schedule)
                                        @if ($__schedule->id !== $schedule->id)
                                            <tr class="{{$schedule->status === 'تم السداد' ? 'bg-success' : ''}}{{$__schedule->id === $schedule->id ? 'bg-info' : ''}}">
                                                <td>{{$__schedule->id}}</td>
                                                <td>{{$__schedule->scheduled_date}}</td>
                                                <td>{{$__schedule->amount}}</td>
                                                <td>{{$__schedule->payed}}</td>
                                                <td>{{$__schedule->status}}</td>
                                            </tr>   
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>