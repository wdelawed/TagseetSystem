@php
    use App\Schedule ;
    $schedules = Schedule::where('scheduled_date',date('Y-m-d'))->where('status','جديد')->get() ;
@endphp
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>

    <!-- Meta-Information -->
    <title>Tagseet App </title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Vendor: Bootstrap Stylesheets http://getbootstrap.com -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-rtl-min.css')}}">
    <link href="{{asset('plugins/FileInput/bootstrap-fileinput.css')}}" rel="stylesheet" />
    <link href="{{asset('plugins/DataTables/datatables.min.css')}}" rel="stylesheet" />
    <!-- Our Website CSS Styles -->
    <link rel="stylesheet" href="{{asset('css/icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/rtl.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/Site.css')}}">

</head>
<body>
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
        your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- Our Website Content Goes Here -->
    <header class="simple-normal light">
        <div class="top-bar">
            <div class="logo">
                <a href="#" title=""><i class="fa fa-bullseye"></i> Absher</a>
            </div>
            <div class="menu-options"><span class="menu-action"><i></i></span></div>
            <div class="top-bar-quick-sec">
                <ul class="quick-notify-section custom-dropdowns">
                    <li class="message-list dropdown">
                        <span>
                            <i class="fa fa-bell-o"></i>
                            <strong class="skyblue-bg">{{count($schedules)}}</strong>
                        </span>
                        <!--paysheet here-->
                        @if (count($schedules)>0)
                            <div class="message drop-list">
                                <span>
                                    قائمه السداد لهذا اليوم  {{date('Y-m-d')}}
                                </span>
                                <ul>   
                                    @foreach ($schedules as $schedule)
                                        <li>
                                            <a href="#"  onclick="paySchedule({{$schedule->id}})" title="">
                                                <span>
                                                    <img src="http://placehold.it/40x40" alt="" />
                                                </span>
                                                <i>{{$schedule->getInstallment->getCustomer()->first()['name']}}</i> 
                                                {{$schedule->amount}}  
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="#" onclick="$('.large-modal2').modal('show');" title="">إظهار الكل</a>
                            </div>
                        @endif
                    </li>
                </ul>
                <span id="toolFullScreen" class="full-screen-btn"><i class="fa fa-arrows-alt"></i></span>
                <div class="name-area">
                    <a href="/logout" class="btn btn-success" style="margin-top:13px;margin-right:10px; color:white;">تسجيل الخروج<i class="fa fa-logout"></i></a>
                    <a href="javascript:void(0)" title="">
                        <img src="{{asset(Auth::user()->profileImage)}}" alt="" /> 
                        <strong>{{Auth::user()->name}} | 
                            <span style="font-size:12px;">{{Auth::user()->role()->value('role_name')}} </span>
                        </strong>
                    </a>
                </div>
            </div>
        </div><!-- Top Bar -->
        <div class="side-menu-sec" id="header-scroll">
            <div class="side-menus" style="margin-top: 5px;">
                <span>الروابط الاساسية</span>
                <nav>
                    <ul class="parent-menu">
                        <li><a href="/home"><i class="ti-desktop"></i><span>الرئيسية </span></a></li>
                        @if(Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$INSTALLMENTS))
                            <li class="menu-item-has-children">
                                <a title=""><i class="ti-email"></i><span>الاقساط</span></a>
                                <ul>
                                    <li><a href="installments/create">قسط جديد</a></li>
                                    <li><a href="installments/schedule">جدولة قسط</a></li>
                                    <li><a href="installments/paybefore">تكيش</a></li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$CUSTOMERS))
                            <li class="menu-item-has-children">
                                <a title=""><i class="ti-heart"></i><span>العملاء</span></a>
                                <ul class="mega">
                                    <li><a href="/Customers">ادارة العملاء</a></li>
                                    <li><a href="/Customers/create">إضافة عميل جديد</a></li>
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$SPONSORS))
                            <li><a href="/sponsors"><i class="ti-desktop"></i><span>الكفلاء </span></a></li></a></li>
                        @endif
                        @if(Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$EMPLYEES))
                            <li><a href="/employees"><i class="ti-desktop"></i><span>الموظفين </span></a></li></a></li>
                        @endif
                        @if(Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$CUSTODIS))
                            <li><a href="/custodies"><i class="ti-desktop"></i><span>العهد </span></a></li></a></li>
                        @endif
                        @if(Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$REPORTS))
                            <li class="menu-item-has-children">
                                <a title=""><i class="ti-rocket"></i><span>التقارير</span></a>
                                <ul>
                                    <li><a href="/customers/account">كشف حساب عميل</a></li>
                                    <li><a href="/employees/account">كشف حساب موظف</a></li>
                                    <li><a href="/custodies/all">جرد عهد الموظفين </a></li>
                                </ul>
                            </li>
                        @endif
                        <li class="menu-item-has-children">
                            <a title=""><i class="ti-rocket"></i><span>اعدادات</span></a>
                            <ul>
                                @if(Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$ROLES))
                                    <li><a href="/roles">الادوار</a></li>
                                @endif
                                @if(Auth::user()->has(Permissions::$PERMISSION_READ, Permissions::$OPERATIONS_LOG))
                                    <li><a href="/oplog">سجل العمليات</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div class="main-content">
        @yield('content')
    </div>
    <div class="modal fade large-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">سداد</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>  العميل  </label> <br /><h4>خالد محمد احمد</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-2">التاريخ</label>
                                <input type="date" class="calendar form-control col-md-4" name="date-1566199141618-preview" id="date-1566199141618-preview">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="radio-group ">
                                <input value="option-1" type="radio" class="radio-group " name="radio-group-1566201687945-preview" id="radio-group-1566201687945-preview-0" checked="">
                                <label for="radio-group-1566201687945-preview-0">بنك</label><br>
                                <div class="form-group">
                                    <label class="">رقم الايصال</label>
                                    <input type="text" class="form-control" name="date-1566199141618-preview" id="date-1566199141618-preview">
                                </div>
                                <input value="option-2" type="radio" class="radio-group " name="radio-group-1566201687945-preview" id="radio-group-1566201687945-preview-0" checked="">
                                <label for="radio-group-1566201687945-preview-0">بنك</label><br>
                                <div class="form-group">
                                    <label class="">رقم الايصال</label>
                                    <input type="text" class="form-control" name="date-1566199141618-preview" id="date-1566199141618-preview">
                                </div>
                            </div>
                            <div>
                                تم فتح القسط بواسطة الموظف: <br />
                                محمد احمد ادريس
                            </div>
                            <hr />
                            <div class="form-group">
                                <button type="button" class="btn btn-success">حفظ</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="widget">
                                <div class="widget-title">
                                    جدولة السداد
                                </div>
                                <div class="widget-content">
                                    <table id="example2" class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    رقم
                                                </th>
                                                <th>التاريخ</th>
                                                <th>المبلغ</th>
                                                <th>المسدد</th>
                                                <th>الحالة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>2011/12/12</td>
                                                <td>106,450</td>
                                                <td>106,450</td>
                                                <td>تم السداد</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>2011/12/12</td>
                                                <td>106,450</td>
                                                <td>106,450</td>
                                                <td>تم السداد</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade paysheetlistModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        قائمة السداد
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="widget-content">
                                    <form role="form" class="sec">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">اسم العميل</label>
                                                <input type="text" placeholder="اسم العميل" id="exampleInputEmail1" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">رقم الهوية</label>
                                                <input type="text" placeholder="رقم الهوية" id="exampleInputEmail1" class="form-control">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">من</label>
                                                <input type="date"  id="exampleInputEmail1" class="form-control calendar">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">إلى</label>
                                                <input type="date"  id="exampleInputEmail1" class="form-control calendar">
                                            </div>
                                        </div>
                                        <br />
                                        <div class="form-group">
                                            <button class="btn green-bg pull-right" type="submit">بحث</button>
                                        </div>
                                    </form>
                                    <table id="example2" class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    رقم
                                                </th>
                                                <th>التاريخ</th>
                                                <th>المبلغ</th>
                                                <th>المسدد</th>
                                                <th>الحالة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>2011/12/12</td>
                                                <td>106,450</td>
                                                <td>106,450</td>
                                                <td>تم السداد</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>2011/12/12</td>
                                                <td>106,450</td>
                                                <td>106,450</td>
                                                <td>تم السداد</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--Modals Area Start -->
        <!--Create Modal Start--> 
        <div id="createModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">اضافه </h4>
                    </div>
                    <div class="modal-body">
                        @yield('create_modal')              
                    </div>
                </div> 
            </div>
        </div>
        <!--End Create Modal-->
        <!--Delete Modal Start-->
        <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">حذف</h4>
                    </div>
                    <div class="modal-body"> 
                        @yield('delete_modal')           
                    </div>
                </div>
            </div>
        </div>
        <!--End Delete Modal-->
        <!--Update Modal Start-->
        <div id="updateItModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">تعديل </h4>
                    </div>
                    <div class="modal-body">
                        @yield('update_modal')              
                    </div>
                </div> 
            </div>
        </div>
        <!--End Update Modal-->
        <!--Start Pay-Installment Modal-->
        <div class="modal fade large-modal" tabindex="-1" role="dialog" id="payModal">
            <div class="modal-dialog modal-lg" role="document" id="dataHolder"> 
            </div>
        </div>
        <!--End Pay-Installment Modal-->

    <!--End Modals Area-->

    <!-- Vendor: Javascripts -->
    <script src="{{asset('js/jquery-2.1.3.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/FileInput/bootstrap-fileinput.js')}}"></script>
    <script src="{{asset('plugins/DataTables/datatables.min.js')}}"></script>


    <!-- Our Website Javascripts -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/common.js')}}"></script>
    <script src="{{asset('js/home2.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/installments.js')}}"></script>

</body>
</html>