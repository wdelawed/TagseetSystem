@php
    function gotPermission($role,$permission,$on){
        $data = (int) $role[$on] ; 
        $data = $data & $permission ;
        $data = $data / $permission ;
        return $data ; 
    }
@endphp


@if(Auth::user()->has(Permissions::$PERMISSION_UPDATE, Permissions::$ROLES))
        <div class="row" id="updateModalContent">
            <div class="col-lg-12">
                <form id="updateForm" method="POST"  action="roles/update/">
                    <input type="hidden" name="role_id" value="{{$role->role_id}}">
                    {{ csrf_field() }}
                    <div class="widget">
                        <div class="widget-content">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="name">اسم الدور </label>
                                    <input type="text" placeholder="" id="name" name="name" class="form-control" value="{{$role->role_name}}">
                                </div> 
                            </div>
                            <br/>
                            <div class="form-group row">
                                <div class="col-md-4">
                                <input type="checkbox" id="installments_r" name="installments_r" {!!(gotPermission($role,Permissions::$PERMISSION_READ, Permissions::$INSTALLMENTS))? 'checked>' : '>'!!}
                                    <label for="installments_r">الاقساط</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" id="users_r" name="users_r" {!!(gotPermission($role, Permissions::$PERMISSION_READ, Permissions::$EMPLYEES))? 'checked>' : '>'!!}
                                    <label for="users_r">الموظفين</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" id="stock_r" name="stock_r" {!!(gotPermission($role, Permissions::$PERMISSION_READ, Permissions::$STORE))? 'checked>' : '>'!!}
                                    <label for="stock_r">المخزن</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" id="customers_r" name="customers_r" {!!(gotPermission($role, Permissions::$PERMISSION_READ, Permissions::$CUSTOMERS))? 'checked>' : '>'!!}
                                    <label for="customers_r">العملاء</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" id="custodies_r" name="custodies_r" {!!(gotPermission($role, Permissions::$PERMISSION_READ, Permissions::$CUSTODIS))? 'checked>' : '>'!!}
                                    <label for="custodies_r">العهد</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" id="roles_r" name="roles_r" {!!(gotPermission($role, Permissions::$PERMISSION_READ, Permissions::$ROLES))? 'checked>' : '>'!!}
                                    <label for="roles_r">الادوار</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" id="sponsors_r" name="sponsors_r" {!!(gotPermission($role, Permissions::$PERMISSION_READ, Permissions::$SPONSORS))? 'checked>' : '>'!!}
                                    <label for="sponsors_r">الكفلاء</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" id="reports_r" name="reports_r" {!!(gotPermission($role, Permissions::$PERMISSION_READ, Permissions::$REPORTS))? 'checked>' : '>'!!}
                                    <label for="reports_r">التقارير</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" id="operations_r" name="operations_r" {!!(gotPermission($role, Permissions::$PERMISSION_READ, Permissions::$OPERATIONS_LOG))? 'checked>' : '>'!!}
                                    <label for="operations_r">سجل العمليات</label>
                                </div>      
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="widget">
                        <div class="widget-content">
                            <div class="form-group row">
                                <div class="cold-md-12 text-bold" >الاقساط</div>
                                <div class="widget">
                                    <div class="widget-content">
                                        <div class="col-md-3">
                                                <input type="checkbox" id="installments_c" name="installments_c" {!!(gotPermission($role, Permissions::$PERMISSION_CREATE, Permissions::$INSTALLMENTS))? 'checked>' : '>'!!}
                                                <label for="installments_c">جديد</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="installments_u" name="installments_u" {!!(gotPermission($role, Permissions::$PERMISSION_UPDATE, Permissions::$INSTALLMENTS))? 'checked>' : '>'!!}
                                            <label for="installments_u">تعديل</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="installments_d" name="installments_d" {!!(gotPermission($role, Permissions::$PERMISSION_DELETE, Permissions::$INSTALLMENTS))? 'checked>' : '>'!!}
                                            <label for="installments_d">حذف</label>
                                        </div>
                                        <div class="col-md-3">
                                                <input type="checkbox" id="installments_t" name="installments_t" {!!(gotPermission($role, Permissions::$PERMISSION_RESCHEDULE, Permissions::$INSTALLMENTS))? 'checked>' : '>'!!}
                                                <label for="installments_t">اعادة جدوله</label>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="cold-md-12 text-bold">العملاء</div>
                                <div class="widget">
                                    <div class="widget-content">
                                        <div class="col-md-3">
                                                <input type="checkbox" id="customers_c" name="customers_c" {!!(gotPermission($role, Permissions::$PERMISSION_CREATE, Permissions::$CUSTOMERS))? 'checked>' : '>'!!}
                                                <label for="customers_c">جديد</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="customers_u" name="customers_u" {!!(gotPermission($role, Permissions::$PERMISSION_UPDATE, Permissions::$CUSTOMERS))? 'checked>' : '>'!!}
                                            <label for="customers_u">تعديل</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="customers_d" name="customers_d" {!!(gotPermission($role, Permissions::$PERMISSION_DELETE, Permissions::$CUSTOMERS))? 'checked>' : '>'!!}
                                            <label for="customers_d">حذف</label>
                                        </div>
                                        <div class="col-md-3">
                                                <input type="checkbox" id="customers_s" name="customers_s" {!!(gotPermission($role, Permissions::$PERMISSION_SEARCH, Permissions::$CUSTOMERS))? 'checked>' : '>'!!}
                                                <label for="customers_s">بحث </label>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="cold-md-12 text-bold">الكفلاء</div>
                                <div class="widget">
                                    <div class="widget-content">
                                        <div class="col-md-3">
                                                <input type="checkbox" id="sponsors_c" name="sponsors_c" {!!(gotPermission($role, Permissions::$PERMISSION_CREATE, Permissions::$SPONSORS))? 'checked>' : '>'!!}
                                                <label for="sponsors_c">جديد</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="sponsors_u" name="sponsors_u" {!!(gotPermission($role, Permissions::$PERMISSION_UPDATE, Permissions::$SPONSORS))? 'checked>' : '>'!!}
                                            <label for="sponsors_u">تعديل</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="sponsors_d" name="sponsors_d" {!!(gotPermission($role, Permissions::$PERMISSION_DELETE, Permissions::$SPONSORS))? 'checked>' : '>'!!}
                                            <label for="sponsors_d">حذف</label>
                                        </div>
                                        <div class="col-md-3">
                                                <input type="checkbox" id="sponsors_s" name="sponsors_s" {!!(gotPermission($role, Permissions::$PERMISSION_SEARCH, Permissions::$SPONSORS))? 'checked>' : '>'!!}
                                                <label for="sponsors_s">بحث </label>
                                        </div>
                                    </div>
                                </div>
                            
                                
                                <div class="cold-md-12">الموظفين</div>
                                <div class="widget">
                                    <div class="widget-content">
                                        <div class="col-md-3">
                                                <input type="checkbox" id="users_c" name="users_c" {!!(gotPermission($role, Permissions::$PERMISSION_CREATE, Permissions::$EMPLYEES))? 'checked>' : '>'!!}
                                                <label for="users_c">جديد</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="users_u" name="users_u" {!!(gotPermission($role, Permissions::$PERMISSION_UPDATE, Permissions::$EMPLYEES))? 'checked>' : '>'!!}
                                            <label for="users_u">تعديل</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="users_d" name="users_d" {!!(gotPermission($role, Permissions::$PERMISSION_DELETE, Permissions::$EMPLYEES))? 'checked>' : '>'!!}
                                            <label for="users_d">حذف</label>
                                        </div>
                                        <div class="col-md-3">
                                                <input type="checkbox" id="users_s" name="users_s" {!!(gotPermission($role, Permissions::$PERMISSION_SEARCH, Permissions::$EMPLYEES))? 'checked>' : '>'!!}
                                                <label for="users_s">بحث </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="cold-md-12">العهد</div>
                                <div class="widget">
                                    <div class="widget-content">
                                        <div class="col-md-3">
                                                <input type="checkbox" id="custodies_c" name="custodies_c" {!!(gotPermission($role, Permissions::$PERMISSION_CREATE, Permissions::$CUSTODIS))? 'checked>' : '>'!!}
                                                <label for="custodies_c">جديد</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="custodies_u" name="custodies_u" {!!(gotPermission($role, Permissions::$PERMISSION_UPDATE, Permissions::$CUSTODIS))? 'checked>' : '>'!!}
                                            <label for="custodies_u">تعديل</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="custodies_d" name="custodies_d" {!!(gotPermission($role, Permissions::$PERMISSION_DELETE, Permissions::$CUSTODIS))? 'checked>' : '>'!!}
                                            <label for="custodies_d">حذف</label>
                                        </div>
                                        <div class="col-md-3">
                                                <input type="checkbox" id="custodies_s" name="custodies_s" {!!(gotPermission($role, Permissions::$PERMISSION_SEARCH, Permissions::$CUSTODIS))? 'checked>' : '>'!!}
                                                <label for="custodies_s">بحث </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="cold-md-12">التقارير</div>
                                <div class="widget">
                                    <div class="widget-content">
                                        <div class="col-md-3">
                                                <input type="checkbox" id="reports_c" name="reports_c" {!!(gotPermission($role, Permissions::$PERMISSION_CREATE, Permissions::$REPORTS))? 'checked>' : '>'!!}
                                                <label for="reports_c">جديد</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="reports_u" name="reports_u" {!!(gotPermission($role, Permissions::$PERMISSION_UPDATE, Permissions::$REPORTS))? 'checked>' : '>'!!}
                                            <label for="reports_u">تعديل</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="reports_d" name="reports_d" {!!(gotPermission($role, Permissions::$PERMISSION_DELETE, Permissions::$REPORTS))? 'checked>' : '>'!!}
                                            <label for="reports_d">حذف</label>
                                        </div>
                                        <div class="col-md-3">
                                                <input type="checkbox" id="reports_s" name="reports_s" {!!(gotPermission($role, Permissions::$PERMISSION_SEARCH, Permissions::$REPORTS))? 'checked>' : '>'!!}
                                                <label for="reports_s">بحث </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="cold-md-12">المخزن</div>
                                <div class="widget">
                                    <div class="widget-content">
                                        <div class="col-md-3">
                                                <input type="checkbox" id="stock_c" name="stock_c" {!!(gotPermission($role, Permissions::$PERMISSION_CREATE, Permissions::$STORE))? 'checked>' : '>'!!}
                                                <label for="stock_c">جديد</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="stock_u" name="stock_u" {!!(gotPermission($role, Permissions::$PERMISSION_UPDATE, Permissions::$STORE))? 'checked>' : '>'!!}
                                            <label for="stock_u">تعديل</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="stock_d" name="stock_d" {!!(gotPermission($role, Permissions::$PERMISSION_DELETE, Permissions::$STORE))? 'checked>' : '>'!!}
                                            <label for="stock_d">حذف</label>
                                        </div>
                                        <div class="col-md-3">
                                                <input type="checkbox" id="stock_s" name="stock_s" {!!(gotPermission($role, Permissions::$PERMISSION_SEARCH, Permissions::$STORE))? 'checked>' : '>'!!}
                                                <label for="stock_s">بحث </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="cold-md-12">الادوار</div>
                                <div class="widget">
                                    <div class="widget-content">
                                        <div class="col-md-3">
                                                <input type="checkbox" id="roles_c" name="roles_c" {!!(gotPermission($role, Permissions::$PERMISSION_CREATE, Permissions::$ROLES))? 'checked>' : '>'!!}
                                                <label for="roles_c">جديد</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="roles_u" name="roles_u" {!!(gotPermission($role, Permissions::$PERMISSION_UPDATE, Permissions::$ROLES))? 'checked>' : '>'!!}
                                            <label for="roles_u">تعديل</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="roles_d" name="roles_d" {!!(gotPermission($role, Permissions::$PERMISSION_DELETE, Permissions::$ROLES))? 'checked>' : '>'!!}
                                            <label for="roles_d">حذف</label>
                                        </div>
                                        <div class="col-md-3">
                                                <input type="checkbox" id="roles_s" name="roles_s" {!!(gotPermission($role, Permissions::$PERMISSION_SEARCH, Permissions::$ROLES))? 'checked>' : '>'!!}
                                                <label for="roles_s">بحث </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="cold-md-12">سجل العمليات</div>
                                <div class="widget">
                                    <div class="widget-content">
                                        <div class="col-md-3">
                                                <input type="checkbox" id="operations_c" name="operations_c" {!!(gotPermission($role, Permissions::$PERMISSION_CREATE, Permissions::$OPERATIONS_LOG))? 'checked>' : '>'!!}
                                                <label for="operations_c">جديد</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="operations_u" name="operations_u" {!!(gotPermission($role, Permissions::$PERMISSION_UPDATE, Permissions::$OPERATIONS_LOG))? 'checked>' : '>'!!}
                                            <label for="operations_u">تعديل</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="checkbox" id="operations_d" name="operations_d" {!!(gotPermission($role, Permissions::$PERMISSION_DELETE, Permissions::$OPERATIONS_LOG))? 'checked>' : '>'!!}
                                            <label for="operations_d">حذف</label>
                                        </div>
                                        <div class="col-md-3">
                                                <input type="checkbox" id="operations_s" name="operations_s" {!!(gotPermission($role, Permissions::$PERMISSION_SEARCH, Permissions::$OPERATIONS_LOG))? 'checked>' : '>'!!}
                                                <label for="operations_s">بحث </label>
                                        </div>
                                    </div>
                                </div>
        
                                
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group widget-content">
                        
                        <button class="btn btn-success" type="button" onclick="submitForm('updateForm','updateItModal')"> حفظ التعديلات </button> 
                        <button class="btn btn-danger" type="button"> الغاء </button> 
                    </div>
                </form>
            </div>
        </div>
    @else 
        <h3> ليس لديك اذن لتعديل هذا المحتوى </h3>
    @endif