@if(Auth::user()->has(Permissions::$PERMISSION_SEARCH,Permissions::$SPONSORS) || $operation === 'refresh')
    <table class="table table-bordered" id="searchTable" width="100%">
        <thead>
            <tr>
                <th>رقم</th>
                <th>اسم الكفيل</th>
                <th>رقم الجوال</th>
                <th>رقم الهوية</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sponsors as $sponsor)
                <tr>
                    <td>{{$sponsor->id}}</td>
                    <td>{{$sponsor->name}}</td>
                    <td>{{$sponsor->phone}}</td>
                    <td>{{$sponsor->identityNum}}</td>
                    <td>
                        <a href="#" class="taction" data-toggle="modal" onclick="edit({{$sponsor->id}})"><span class="fa fa-edit" ></span></a>
                        <a href="#" class="taction" data-toggle="modal" onclick="deleteFunc({{$sponsor->id}},'{{$sponsor->name}}',{{$sponsor->identityNum}})"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>  
@else 
    <h3>ليس لديك الاذن   </h3>
@endif