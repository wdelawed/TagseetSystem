@if(Auth::user()->has(Permissions::$PERMISSION_UPDATE, Permissions::$EMPLYEES))
        <div class="row" id="updateModalContent">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-content">
                        <form id="updateForm" method="POST" enctype="multipart/form-data" action="employees/update/">
                            <input type="hidden" name="user_id" value="{{$user->user_id}}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name">اسم الموظف</label>
                                    <input type="text" placeholder="السلعه" id="name" name="name" class="form-control" value="{{$user->name}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">رقم الجوال</label>
                                    <input type="tel" placeholder="الوصف" id="phone" name="phone" class="form-control" value="{{$user->phone}}">
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="address">السكن</label>
                                    <input type="text" placeholder="السلعه" id="address" name="address" class="form-control" value="{{$user->address}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="identityNum">رقم الهوية</label>
                                    <input type="text" placeholder="رقم الهوية" id="identityNum" name="identityNum" class="form-control" value="{{$user->identityNum}}">
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="bankAccount">
                                        رقم الحساب البنكي
                                    </label>
                                    <input type="number" placeholder="السلعه" id="bankAccount" name="bankAccount" class="form-control" value="{{$user->bankAccount}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">الدور</label>
                                    <select class="form-control" name="role_id">
                                        @foreach($roles as $role)
                                            @if($role->role_id === $user_role->role_id)
                                                <option value="{{$role->role_id}}" selected="true">{{$role->role_name}}</option>
                                            @else
                                                <option value="{{$role->role_id}}">{{$role->role_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                            <img src="{{asset($user->profileImage)}}" />
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 10px;"></div>
                                        <div class="">
                                            <span class="btn btn-file btn-dark">
                                                <span class="fileinput-new"> اختر الصورة </span>
                                                <span class="fileinput-exists"> تغيير </span>
                                                <input type="hidden" value="unchanged.jpg" name="Pfile"><input type="file" accept="image/*" name="Pfile" value="unchanged.jpg">
                                            </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">   
                                            <label for="password">كلمة السر</label>
                                            <input type="password" name="password" placeholder="كلمة السر" id="password" class="form-control">
                                            <br/>
                                        </div>
                                        <div class="col-md-12">   
                                            <label for="email">البريد الالكتروني</label>
                                            <input type="text" placeholder="البريد الالكتروني" id="email" name="email" class="form-control" value="{{$user->email}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="button" onclick="submitForm('updateForm','updateItModal')" class="btn btn-success"> <span class="fa fa-save"></span> حفظ</button>
                                    <button type="button" class="btn  btn-danger" data-dismiss="modal">اغلاق</button>
                                </div>   
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else 
        <h3> ليس لديك اذن لتعديل هذا المحتوى </h3>
    @endif