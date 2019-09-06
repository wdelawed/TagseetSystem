@if(Auth::user()->has(Permissions::$PERMISSION_SEARCH,Permissions::$CUSTODIS) || $operation === 'refresh')
    <table class="table table-bordered"  width="100%">
        <thead>
            <tr>
                <th>رقم</th>
                <th>اسم الموظف</th>
                <th>العهدة الحالية </th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->user_id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->accountBalance}}</td>
                    <td>
                        
                        @if(Auth::user()->has(Permissions::$PERMISSION_READ,Permissions::$CUSTODIS))
                            <a href="#" class="taction" data-toggle="modal" onclick="edit({{$user->user_id}})" data-id="{{$user->user_id}}"><span class="fa fa-eye" ></span></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> 
@else 
    <h3>ليس لديك الاذن للبحث  </h3>
@endif