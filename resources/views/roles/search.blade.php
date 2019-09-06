@if(Auth::user()->has(Permissions::$PERMISSION_READ,Permissions::$ROLES))
    <table class="table table-bordered"  width="100%">
        <thead>
            <tr>
                <th>الرقم</th>
                <th>الدور </th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->role_id}}</td>
                    <td>{{$role->role_name}}</td>
                    <td>
                        <a href="#" class="taction" data-toggle="modal" onclick="edit({{$role->role_id}})""><span class="fa fa-edit" ></span></a>
                        <a href="#" class="taction" data-toggle="modal" onclick="deleteFunc({{$role->role_id}},'{{$role->role_name}}')"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>  
@else 
    <h3>ليس لديك الاذن للبحث في الموظفين</h3>
@endif