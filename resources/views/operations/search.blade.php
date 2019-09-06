
@if($permissions['S'])
    @if (count($operations))
        <table class="table table-bordered"  width="100%">
            <thead>
                <tr>
                    <th>رقم</th>
                    <th>التاريخ </th>
                    <th>الموظف </th>
                    <th>التفاصيل </th>
                </tr>
            </thead>
            <tbody>
                @foreach($operations as $operation)
                    <tr>
                        <td>{{$operation->id}}</td>
                        <td>{{$operation->created_at}}</td>
                        <td>{{$operation->user()->value('name')}}</td>
                        <td>{{$operation->details}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
    @else 
        <h3>لاتوجد نتائج لبحثك</h3>
    @endif
@else
    <h3>ليس لديك الاذن للبحث في العمليات</h3>
@endif