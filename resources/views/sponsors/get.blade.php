@if(Auth::user()->has(Permissions::$PERMISSION_UPDATE, Permissions::$SPONSORS))
        <div class="row" id="updateModalContent">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-content">
                        <form method="post" action="sponsors/update" enctype="multipart/form-data" id="updateForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$sponsor->id}}">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name">اسم الكفيل</label>
                                    <input type="text" value="{{$sponsor->name}}" placeholder="" id="name" name="name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">رقم الجوال</label>
                                    <input type="tel" value="{{$sponsor->phone}}" placeholder="" id="phone" name="phone" class="form-control">
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="address">السكن</label>
                                    <input type="text" value="{{$sponsor->address}}" placeholder="" id="address" name="address" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="identityNum">رقم الهوية</label>
                                    <input type="text" value="{{$sponsor->identityNum}}" placeholder="" id="identityNum" name="identityNum" class="form-control">
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="bankAccount">
                                        رقم الحساب البنكي
                                    </label>
                                    <input type="number" value="{{$sponsor->bankAccount}}" placeholder="" id="bankAccount" name="bankAccount" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="salary">تعاريف بالراتب</label>
                                    <input type="number" value="{{$sponsor->salary}}" placeholder="" id="salary" name="salary" class="form-control">
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <h4 style="font-weight:bold">صورة الكفالة</h4>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100%;">
                                            <img src="{{$sponsor->sponsorshipImage}}" style="width:100%;height:auto !important;" />
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 10px;"></div>
                                        <div class="">
                                            <span class="btn btn-file btn-dark">
                                                <span class="fileinput-new"> اختر الصورة </span>
                                                <span class="fileinput-exists"> تغيير </span>
                                                <input type="hidden" value="unchanged.jpg" name="Pfile"><input type="file" accept="image/*" name="Pfile">
                                            </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="button" onclick="submitForm('updateForm','updateItModal')" class="btn btn-success"> <span class="fa fa-save"></span> تعديل الكفيل</button>
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