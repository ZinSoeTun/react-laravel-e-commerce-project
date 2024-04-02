<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
  ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/img/favicon.ico') }}">
    {{-- font awesome cdn link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts
  ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/font-awesome.min.css') }}">

    <!-- owl.carousel CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/owl.carousel.css') }}">
    <link rel="stylesheet" href=" {{ asset('admin/css/owl.theme.css') }}">
    <link rel="stylesheet" href=" {{ asset('admin/css/owl.transitions.css') }}">
    <!-- animate CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/animate.css') }}">
    <!-- normalize CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/normalize.css') }}">
    <!-- meanmenu icon CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/meanmenu.min.css') }}">
    <!-- main CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/main.css') }}">
    <!-- morrisjs CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/morrisjs/morris.css') }}">
    <!-- mCustomScrollbar CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- metisMenu CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/metisMenu/metisMenu.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('admin/css/metisMenu/metisMenu-vertical.css') }}">
    <!-- calendar CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/calendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('admin/css/calendar/fullcalendar.print.min.css') }}">
    <!-- style CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/style.css') }}">
    <!-- responsive CSS
  ============================================ -->
    <link rel="stylesheet" href=" {{ asset('admin/css/responsive.css') }}">
    {{-- Bootstrap cdn link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- modernizr JS
  ============================================ -->
    <script src=" {{ asset('admin/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <style>
        .Hello:hover {
            background-color: rgba(3, 3, 22, 0.226);
        }
    </style>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="left-sidebar-pro">
        <nav id="sidebar" style="height: 200vh" class="">
            <div class="sidebar-header">
                <a href="index.html"><img class="main-logo" src="{{ asset('admin/img/logo/logosn.png') }}"
                        alt="" />
                </a>
            </div>
            <strong>
                <h2 class="text-light fs-3 text-center">Vitra</h2>
            </strong>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a class="has-arrow" href="index.html">
                                <i class="icon nalika-home icon-wrap"></i>
                                <span class="mini-click-non">Categories</span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="true">
                                <li><a title="Dashboard v.1" href="{{ route('create.category') }}"><span
                                            class="mini-sub-pro">Create Categories
                                        </span></a></li>
                                <li><a title="Dashboard v.2" href="{{ route('category.list') }}"><span
                                            class="mini-sub-pro">Categories List
                                        </span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i
                                    class="icon nalika-mail icon-wrap"></i> <span
                                    class="mini-click-non">Products</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Inbox" href="{{ route('create.product') }}"><span
                                            class="mini-sub-pro">Create Products</span></a>
                                </li>
                                <li><a title="View Mail" href="{{ route('product.list') }}"><span
                                            class="mini-sub-pro">Products
                                            List</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i
                                    class="icon nalika-diamond icon-wrap"></i> <span
                                    class="mini-click-non">Account</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Google Map" href="{{ route('account.admin.adminList') }}"><span
                                            class="mini-sub-pro">Admin List
                                        </span></a></li>
                                <li><a title="Data Maps" href="{{ route('account.admin.userList') }}"><span
                                            class="mini-sub-pro">User List
                                        </span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i
                                    class="icon nalika-pie-chart icon-wrap"></i> <span class="mini-click-non">Contact
                                    Messages</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="File Manager" href="{{ route('create.contact.message') }}"><span
                                            class="mini-sub-pro">Messages
                                            List</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i
                                    class="icon nalika-pie-chart icon-wrap"></i> <span
                                    class="mini-click-non">Orders</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="File Manager" href="{{ route('order.list.orderlist') }}"><span
                                            class="mini-sub-pro">Order
                                            List</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i
                                    class="icon nalika-bar-chart icon-wrap"></i> <span
                                    class="mini-click-non">Rooms</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Bar Charts" href="{{ route('create.room') }}"><span
                                            class="mini-sub-pro">Create
                                            Rooms</span></a></li>
                                <li><a title="Line Charts" href="{{ route('room.list') }}"><span
                                            class="mini-sub-pro">Rooms
                                            List</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><i
                                    class="icon nalika-table icon-wrap"></i> <span class="mini-click-non">Designers
                                </span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Peity Charts" href="{{ route('create.designer') }}"><span
                                            class="mini-sub-pro">Create Designers</span></a></li>
                                <li><a title="Data Table" href="{{ route('designer.list') }}"><span
                                            class="mini-sub-pro">Designers
                                            List</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <div class="header-top-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header-top-wraper">
                        <div class="row">
                            {{-- {{Auth::user()}} --}}
                            <div class="header-right-info">
                                <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                    <li class="nav-item">
                                        <a href="#" data-toggle="dropdown" role="button" class="text-dark"
                                            aria-expanded="false" class="nav-link dropdown-toggle">
                                            @if (Auth::user())
                                                @if (Auth::user()->image == null)
                                                    <img src="{{ asset('admin/img/noimage.png') }}" alt=""
                                                        width="50" height="50">
                                                @else
                                                    <img src="{{ asset('storage/admin/' . Auth::user()->image) }}"
                                                        alt="" width="50" height="50"
                                                        class="rounded-5">
                                                @endif
                                                <span class="admin-name">{{ Auth::user()->name }}</span>
                                            @endif
                                        </a>
                                        <ul role="menu"
                                            class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                            <li><a href=""><span class="icon nalika-home author-log-ic"></span>
                                                </a>
                                            </li>
                                            <li><a href="{{ route('admin.profile') }}"><i
                                                        class="fa-solid fa-user me-3"></i> My
                                                    Profile</a>
                                            </li>
                                            <div href="" class="Hello p-1">
                                                <form action="{{ route('admin.logout') }}" method="post"
                                                    class="ms-3">
                                                    @csrf
                                                    <li> <i class="fa-solid fa-right-from-bracket me-3 text-light"></i>
                                                        <input type="submit" value="logout" class="text-light"
                                                            style="background-color: rgba(10, 10, 92, 0.144);border:none">
                                                    </li>
                                                </form>
                                            </div>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Welcome area -->
    <div class="all-content-wrapper bg-dark">
        <!-- Mobile Menu start -->
        <div class="mobile-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="mobile-menu">
                            <nav id="dropdown">
                                <ul class="mobile-menu-nav">
                                    <img src="{{ asset('admin/img/logo/logosn.png') }}" alt=""
                                        width="70" height="70">
                                    <li><a data-toggle="collapse" data-target="#demo" href="#">Categories
                                            <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                        <ul id="demo" class="collapse dropdown-header-top">
                                            <li><a href="{{ route('create.category') }}">Create Categories</a>
                                            </li>
                                            <li><a href="{{ route('category.list') }}">Categories list</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a data-toggle="collapse" data-target="#others" href="#">Products
                                            <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                        <ul id="others" class="collapse dropdown-header-top">
                                            <li><a href="{{ route('create.product') }}">Create products</a></li>
                                            <li><a href="{{ route('product.list') }}">Products list</a></li>
                                        </ul>
                                    </li>
                                    <li><a data-toggle="collapse" data-target="#Miscellaneousmob"
                                            href="#">Account <span
                                                class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                        <ul id="Miscellaneousmob" class="collapse dropdown-header-top">
                                            <li><a href="{{ route('account.admin.userList') }}">Users List</a>
                                            </li>
                                            <li><a href="{{ route('account.admin.adminList') }}">Admins List</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a data-toggle="collapse" data-target="#Chartsmob" href="#">Contact
                                            Messages
                                            <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                        <ul id="Chartsmob" class="collapse dropdown-header-top">
                                            <li><a href="{{ route('create.contact.message') }}">Messages List</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a data-toggle="collapse" data-target="#Chartsmob" href="#">Orders
                                            <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                        <ul id="Chartsmob" class="collapse dropdown-header-top">
                                            <li><a href="{{ route('order.list.orderlist') }}">Order List</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a data-toggle="collapse" data-target="#Tablesmob" href="#">Rooms
                                            <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                        <ul id="Tablesmob" class="collapse dropdown-header-top">
                                            <li><a href="{{ route('create.room') }}">Create Rooms</a>
                                            </li>
                                            <li><a href="{{ route('room.list') }}">Rooms List</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a data-toggle="collapse" data-target="#Tablesmob1" href="#">Designers
                                            <span class="admin-project-icon nalika-icon nalika-down-arrow"></span></a>
                                        <ul id="Tablesmob1" class="collapse dropdown-header-top">
                                            <li><a href="{{ route('create.designer') }}">Create Designers</a>
                                            </li>
                                            <li><a href="{{ route('designer.list') }}">Designers List</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu end -->
        @yield('content')
        {{-- footer start --}}
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <div>
                                <a href="#"><img src="{{ asset('admin/img/logo/logosn.png') }}" alt=""
                                        width="70" height="70" /></a>
                            </div>
                            <p>Copyright © 2024 <a href="https://colorlib.com/wp/templates/"></a> All
                                rights
                                reserved by</p><br>
                            <span class="fw-bold text-success fs-4 ">VITRA</span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jquery
  ============================================ -->
    <script src=" {{ asset('admin/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- bootstrap JS
  ============================================ -->
    <script src=" {{ asset('admin/js/bootstrap.min.js') }}"></script>
    <!-- wow JS
  ============================================ -->
    <script src=" {{ asset('admin/js/wow.min.js') }}"></script>
    <!-- price-slider JS
  ============================================ -->
    <script src=" {{ asset('admin/js/jquery-price-slider.js') }}"></script>
    <!-- meanmenu JS
  ============================================ -->
    <script src=" {{ asset('admin/js/jquery.meanmenu.js') }}"></script>
    <!-- owl.carousel JS
  ============================================ -->
    <script src=" {{ asset('admin/js/owl.carousel.min.js') }}"></script>
    <!-- sticky JS
  ============================================ -->
    <script src=" {{ asset('admin/js/jquery.sticky.js') }}"></script>
    <!-- scrollUp JS
  ============================================ -->
    <script src=" {{ asset('admin/js/jquery.scrollUp.min.js') }}"></script>
    <!-- mCustomScrollbar JS
  ============================================ -->
    <script src=" {{ asset('admin/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src=" {{ asset('admin/js/scrollbar/mCustomScrollbar-active.js') }}"></script>
    <!-- metisMenu JS
  ============================================ -->
    <script src=" {{ asset('admin/js/metisMenu/metisMenu.min.js') }}"></script>
    <script src=" {{ asset('admin/js/metisMenu/metisMenu-active.js') }}"></script>
    <!-- sparkline JS
  ============================================ -->
    <script src=" {{ asset('admin/js/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src=" {{ asset('admin/js/sparkline/jquery.charts-sparkline.js') }}"></script>
    <!-- calendar JS
  ============================================ -->
    <script src=" {{ asset('admin/js/calendar/moment.min.js') }}"></script>
    <script src=" {{ asset('admin/js/calendar/fullcalendar.min.js') }}"></script>
    <script src=" {{ asset('admin/js/calendar/fullcalendar-active.js') }}"></script>
    <!-- float JS
  ============================================ -->
    <script src=" {{ asset('admin/js/flot/jquery.flot.js') }}"></script>
    <script src=" {{ asset('admin/js/flot/jquery.flot.resize.js') }}"></script>
    <script src=" {{ asset('admin/js/flot/curvedLines.js') }}"></script>
    <script src=" {{ asset('admin/js/flot/flot-active.js') }}"></script>
    <!-- plugins JS
  ============================================ -->
    <script src=" {{ asset('admin/js/plugins.js') }}"></script>
    <!-- main JS
  ============================================ -->
    <script src=" {{ asset('admin/js/main.js') }}"></script>
</body>

</html>
