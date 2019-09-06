@if(Auth::user()->has(Permissions::$PERMISSION_SEARCH,Permissions::$EMPLYEES))
    <table class="table table-bordered" id="searchTable" width="100%">
        <thead>
            <tr>
                <th>رقم</th>
                <th>اسم الموظف</th>
                <th>رقم الجوال</th>
                <th>رقم الهوية</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->user_id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->identityNum}}</td>
                    <td>
                        <a href="#" class="taction" data-toggle="modal" onclick="edit({{$user->user_id}})" data-id="{{$user->user_id}}"><span class="fa fa-edit" ></span></a>
                        <a href="#" class="taction" data-toggle="modal" onclick="deleteFunc({{$user->user_id}},'{{$user->name}}',{{$user->identityNum}})"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>  
@else 
    <h3>ليس لديك الاذن للبحث في الموظفين</h3>
@endif