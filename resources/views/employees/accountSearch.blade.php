@if($permissions['S'])
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
        <h3 class="text-center"> لم يسفر بحثك هن اي نتائج</h3>
    @endif  
@else 
    <h3>ليس لديك الاذن للبحث في الموظفين</h3>
@endif