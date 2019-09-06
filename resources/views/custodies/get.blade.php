@if(Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$CUSTODIS))
<div class="row">
        <div class="col-lg-12">
            <div class="widget">
                <div class="widget-title">
                   تفاصيل عهدة:  {{$user->name}} 
                </div>
                <div class="widget-content">
                    <table id="example3" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>رقم</th>
                                <th>التاريخ</th>
                                <th>البند</th>
                                <th>الملبغ</th>
                                <th>الرصيد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($custodies as $custody)
                                <tr>
                                <td>{{$custody->id}}</td>
                                    <td>{{$custody->created_at}}</td>
                                    <td>{{$custody->term}}</td>
                                    <td>{{$custody->amount}}</td>
                                    <td>{{$custody->balanceAfter}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else 
        <h3> ليس لديك اذن لعرض هذا المحتوى </h3>
    @endif