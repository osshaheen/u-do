<!DOCTYPE html>
<html @if(config('app.locale') == 'ar') lang="ar" dir="rtl" @else lang="en" @endif>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/control_panel/assets/images/favicon.png')}}">
    <title>{{ trans('master.title') }}</title>
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="{{asset('/control_panel/assets/node_modules/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="{{asset('/control_panel/assets/node_modules/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    @if(config('app.locale') == 'ar')
        <!--c3 CSS -->
            <link href="{{asset('/control_panel/dist/css/pages/easy-pie-chart.css')}}" rel="stylesheet">
            <!-- Custom CSS -->
            <link href="{{asset('/control_panel/dist/css/style.min.css')}}" rel="stylesheet">
            <!-- Dashboard 1 Page CSS -->
            <link href="{{asset('/control_panel/dist/css/pages/dashboard2.css')}}" rel="stylesheet">
    @else
        <!--c3 CSS -->
            <link href="{{asset('/control_panel/dist_en/css/pages/easy-pie-chart.css')}}" rel="stylesheet">
            <!-- Custom CSS -->
            <link href="{{asset('/control_panel/dist_en/css/style.min.css')}}" rel="stylesheet">
            <!-- Dashboard 1 Page CSS -->
            <link href="{{asset('/control_panel/dist_en/css/pages/dashboard2.css')}}" rel="stylesheet">
    @endif
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('style')
</head>

<body class="skin-purple-dark fixed-layout">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">U-DO</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">
                    <!-- Logo icon --><b>
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="{{asset('/control_panel/assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="{{asset('/control_panel/assets/images/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="{{asset('/control_panel/assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                        <!-- Light Logo text -->
                         <img src="{{asset('/control_panel/assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" /></span> </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto">
                    <!-- This is  -->
                    <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light" href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                    <!-- ============================================================== -->
                    <!-- Comment -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-email"></i>
                            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                        </a>
                        <div class="dropdown-menu mailbox animated bounceInDown">
                            <span class="with-arrow"><span class="bg-primary"></span></span>
                            <ul>
                                <li>
                                    <div class="drop-title bg-primary text-white">
                                        <h4 class="m-b-0 m-t-5">4 New</h4>
                                        <span class="font-light">Notifications</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        <a href="javascript:void(0)">
                                            <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                            <div class="mail-contnet">
                                                <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)">
                                            <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                            <div class="mail-contnet">
                                                <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)">
                                            <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                            <div class="mail-contnet">
                                                <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)">
                                            <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                            <div class="mail-contnet">
                                                <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link text-center m-b-5" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Comment -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Messages -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-note"></i>
                            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                        </a>
                        <div class="dropdown-menu mailbox animated bounceInDown" aria-labelledby="2">
                            <span class="with-arrow"><span class="bg-danger"></span></span>
                            <ul>
                                <li>
                                    <div class="drop-title text-white bg-danger">
                                        <h4 class="m-b-0 m-t-5">5 New</h4>
                                        <span class="font-light">Messages</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="message-center">
                                        <!-- Message -->
                                        <a href="javascript:void(0)">
                                            <div class="user-img"> <img src="{{asset('/control_panel/assets/images/users/1.jpg')}}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)">
                                            <div class="user-img"> <img src="{{asset('/control_panel/assets/images/users/2.jpg')}}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)">
                                            <div class="user-img"> <img src="{{asset('/control_panel/assets/images/users/3.jpg')}}" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)">
                                            <div class="user-img"> <img src="{{asset('/control_panel/assets/images/users/4.jpg')}}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                            <div class="mail-contnet">
                                                <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link text-center link m-b-5" href="javascript:void(0);"> <b>See all e-Mails</b> <i class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Messages -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                        <form class="app-search">
                            <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                        </form>
                    </li>
                </ul>
                <ul class="navbar-nav my-lg-0">
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('/control_panel/assets/images/users/1.jpg')}}" alt="user" class="img-circle" width="30"></a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                            <span class="with-arrow"><span class="bg-primary"></span></span>
                            <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                <div class=""><img src="{{asset('/control_panel/assets/images/users/1.jpg')}}" alt="user" class="img-circle" width="60"></div>
                                <div class="m-l-10">
                                    <h4 class="m-b-0">Steave Jobs</h4>
                                    <p class=" m-b-0">varun@gmail.com</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                            <div class="dropdown-divider"></div>
                            {{--<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i>--}}
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i>{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            {{--</a>--}}
                            <div class="dropdown-divider"></div>
                            <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <div class="d-flex no-block nav-text-box align-items-center">
            <span><img src="{{asset('/control_panel/assets/images/logo-icon.png')}}" alt="elegant admin template"></span>
            <a class="nav-lock waves-effect waves-dark ml-auto hidden-md-down" href="javascript:void(0)"><i class="mdi mdi-toggle-switch"></i></a>
            <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li id="users"> <a class="waves-effect waves-dark" href="/users" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">{{ trans('master.Users') }}</span></a></li>
                    <li id="providers"> <a class="waves-effect waves-dark" href="{{ route('users.providers') }}" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">{{ trans('master.Providers') }}</span></a></li>
                    <li id="ranks"> <a class="waves-effect waves-dark" href="/ranks" aria-expanded="false"><i class="fa fa-arrow-up"></i><span class="hide-menu">{{ trans('master.Ranks') }}</span></a></li>
                    <li id="point_types"> <a class="waves-effect waves-dark" href="/point_types" aria-expanded="false"><i class="fa fa-tablet"></i><span class="hide-menu">{{ trans('master.Point_Types') }}</span></a></li>
                    <li id="service_types"> <a class="waves-effect waves-dark" href="/service_types" aria-expanded="false"><i class="fa fa-server"></i><span class="hide-menu">{{ trans('master.Service_Types') }}</span></a></li>
                    <li id="tags"> <a class="waves-effect waves-dark" href="/tags" aria-expanded="false"><i class="fa fa-tags"></i><span class="hide-menu">{{ trans('master.Tags') }}</span></a></li>
                    <li id="places"> <a class="waves-effect waves-dark" href="/places" aria-expanded="false"><i class="fa fa-plane"></i><span class="hide-menu">{{ trans('master.Places') }}</span></a></li>
                    <li id="categories"> <a class="waves-effect waves-dark" href="{{ route('categories.index',0) }}" aria-expanded="false"><i class="fa fa-cc"></i><span class="hide-menu">{{ trans('master.Categories') }}</span></a></li>
                    <li id="weekDays"> <a class="waves-effect waves-dark" href="{{ route('weekDays.index') }}" aria-expanded="false"><i class="fa fa-weibo"></i><span class="hide-menu">{{ trans('master.Week_Days') }}</span></a></li>
                    <li id="packages"> <a class="waves-effect waves-dark" href="{{ route('packages.index') }}" aria-expanded="false"><i class="fa fa-paragraph"></i><span class="hide-menu">{{ trans('master.Packages') }}</span></a></li>
                    <li id="roles"> <a class="waves-effect waves-dark" href="{{ route('roles.index') }}" aria-expanded="false"><i class="fa fa-rocket"></i><span class="hide-menu">{{ trans('master.Roles') }}</span></a></li>

                    <li id="locations"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-location-arrow"></i><span class="hide-menu">{{ trans('master.Locations') }}</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li id="countries"> <a class="waves-effect waves-dark" href="/countries" aria-expanded="false"><span class="hide-menu">{{ trans('master.Countries') }}</span></a></li>
                            <li id="states"> <a class="waves-effect waves-dark" href="/states" aria-expanded="false"><span class="hide-menu">{{ trans('master.States') }}</span></a></li>
                            <li id="cities"> <a class="waves-effect waves-dark" href="/cities" aria-expanded="false"><span class="hide-menu">{{ trans('master.Cities') }}</span></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            @yield('content')
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer">
        udo
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>

<script src="{{asset('/control_panel/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('/control_panel/assets/node_modules/popper/popper.min.js')}}"></script>
<script src="{{asset('/control_panel/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
@if(config('app.locale'))
    <script src="{{asset('/control_panel/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('/control_panel/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('/control_panel/dist/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
@else
    <script src="{{asset('/control_panel/dist_en/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('/control_panel/dist_en/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('/control_panel/dist_en/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
@endif
<script src="{{asset('/control_panel/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
<script src="{{asset('/control_panel/assets/node_modules/sparkline/jquery.sparkline.min.js')}}"></script>
<!--Custom JavaScript -->
@if(config('app.locale'))
    <script src="{{asset('/control_panel/dist/js/custom.min.js')}}"></script>
@else
    <script src="{{asset('/control_panel/dist_en/js/custom.min.js')}}"></script>
@endif

@yield('script')

<script>
    function uploadFile() {
        document.getElementById('mediable').click();
    }
    function uploadPicture(mediable_id,namespace){
        // console.log(mediable_id,namespace);
        var file_types = ['image/jpeg','image/jpg','image/png'];
        if ($('#mediable').prop('files')[0]) {
            if (!(file_types.indexOf($('#mediable').prop('files')[0].type) + 1)) {
                alert('نوع الملفات ' + $('#mediable').prop('files')[0].type + ' غير مدعوم');
                document.getElementById('mediable').value = '';
            } else {
                var file_data = $('#mediable').prop('files')[0];
                document.getElementById('mediable').value = '';
            }
        }
        var form_data = new FormData();
        form_data.append('_token', "{{ csrf_token() }}");
        if (file_data) {
            form_data.append('file', file_data);
        }
        form_data.append('mediable_id',mediable_id);
        form_data.append('mediable_type',namespace);
        var storage = '{{asset('storage/')}}';
        $.ajax(
            {
                url: "{{route('addPicture')}}", // point to server-side PHP script
                // dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (data, status) {
                    console.log(data);
                    document.getElementById('mediable_image').src = storage+'/'+data;
                }
            }
        );
    }
</script>
</body>

</html>