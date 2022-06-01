<!DOCTYPE html>
<html lang="{{App::getLocale()}}" dir="{{ App::getLocale()=="ar"?'rtl':'ltr'}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>delivery fast</title>
    <!-- Google font-->
    @include('commonmodule::layouts.css')
</head>
<body onload="startTime()" main-theme-layout="{{ App::getLocale()=="ar"?'rtl':'ltr'}}">
@include('commonmodule::layouts.setting')
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <div class="page-main-header">
        <div class="main-header-right row m-0">
            <form class="form-inline search-full" action="#" method="get">
                <div class="form-group w-100">
                    <div class="Typeahead Typeahead--twitterUsers">
                        <div class="u-posRelative">
                            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                        </div>
                        <div class="Typeahead-menu"></div>
                    </div>
                </div>
            </form>
            <div class="main-header-left">
                <div class="logo-wrapper"><a href="{{url('/admin')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo.png')}}" alt=""></a></div>
                <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
            </div>
            <div class="nav-right col-12 pull-right right-menu">
                <ul class="nav-menus">
                    <li class="language-nav">
                        <div class="translate_wrapper">
                            <div class="current_lang">
                                <div class="lang" onclick="changeLAng('{{ App::getLocale()=="ar"?'ltr':'rtl'}}')"><i class="flag-icon flag-icon-{{App::getLocale()=="ar"?'us':'eg'}}"></i><span class="lang-txt">{{App::getLocale()=="ar"?'EN':'AR'}}                              </span></div>
                            </div>
                            <div class="more_lang">
                                <div class="lang selected" data-value="en"><i class="flag-icon flag-icon-eg"></i><span class="lang-txt">English<span> (US)</span></span></div>
                                <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i><span class="lang-txt">لعربية <span> (ae)</span></span></div>
                            </div>
                        </div>
                    </li>

                    <li class="onhover-dropdown">
                        <div class="notification-box"><i data-feather="bell"></i><span class="badge badge-pill badge-secondary">{{ auth()->user()->unreadNotifications()->count() }}</span></div>
                        <ul class="notification-dropdown onhover-show-div">
                            <li class="bg-primary">
                                <h6 class="f-18 mb-0">Notification</h6>
                            </li>

                            @if(auth()->user()->notifications()->count())

                            @foreach(auth()->user()->notifications()->orderBy('created_at', 'desc')->take(5)->get() as $notification)
                                <li>
                                    <p class="mb-0"><i class="fa fa-circle-o mr-3 font-danger"> </i>{{ $notification->data['text'] }} <span class="pull-right">{{ $notification->data['date'] }}</span></p>
                                </li>
                            @endforeach

{{--                            <li>--}}
{{--                                <p class="mb-0"><i class="fa fa-circle-o mr-3 font-primary"> </i>Delivery processing <span class="pull-right">10 min.</span></p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="mb-0"><i class="fa fa-circle-o mr-3 font-success"></i>Order Complete<span class="pull-right">1 hr</span></p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="mb-0"><i class="fa fa-circle-o mr-3 font-info"></i>Tickets Generated<span class="pull-right">3 hr</span></p>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p class="mb-0"><i class="fa fa-circle-o mr-3 font-danger"></i>Delivery Complete<span class="pull-right">6 hr</span></p>--}}
{{--                            </li>--}}
                            <li><a class="btn btn-primary" href="#">Check all notification</a>
                                <!--a.f-15.f-w-500.txt-dark(href="#") Check all notification-->
                            </li>
                            @else
                            <p>There is no notifications</p>
                            @endif
                        </ul>
                    </li>
                    <li>
                        <div class="mode"><i class="fa fa-moon-o"></i></div>
                    </li>
                    <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                    <li class="profile-nav onhover-dropdown p-0">
                        <div class="media profile-media"><img class="b-r-10" src="{{asset('assets/images/dashboard/profile.jpg')}}" alt="">
                            <div class="media-body"><span>{{ auth()->user()->name }}</span>
                                <p class="mb-0 font-roboto">{{ auth()->user()->getRoleNames()->first() }} <i class="middle fa fa-angle-down"></i></p>
                            </div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div">
                            <li><i data-feather="user"></i><span>Account </span></li>
                            <li><i data-feather="mail"></i><span>Inbox</span></li>
                            <li><i data-feather="file-text"></i><span>Taskboard</span></li>
                            <li><i data-feather="settings"></i><span>Settings</span></li>
                            <li><a href="{{url('logout')}}"><i data-feather="log-out"> </i><span> logout</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <script id="result-template" type="text/x-handlebars-template">
                <div class="ProfileCard u-cf">
                    <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                    <div class="ProfileCard-details">
                        <div class="ProfileCard-realName">ahmed</div>
                    </div>
                </div>
            </script>
            <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
    </div>
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
    @include('commonmodule::layouts.sidebar')
        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid p-t-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0">Copyright 2020 © delivery fast.</p>
                    </div>
                    <div class="col-md-6">
                        <p class="pull-right mb-0">Developed with  <i class="fa fa-heart font-secondary"></i></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- latest jquery-->
@include('commonmodule::layouts.js')
<!-- login js-->
<!-- Plugin used-->
</body>
</html>
