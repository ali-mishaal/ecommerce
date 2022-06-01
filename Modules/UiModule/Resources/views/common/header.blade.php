<!--header section start-->
<header class="header fixed-top">
    <nav class="nav-top">
        <div class="container">
            <div class="row justify-content-between">
                <div class="">
                    <h6>Welcome To our Delivery Fast</h6>
                </div>
                <div class="">
                        <span class="mr-3">
                            <span class="ti-email mr-2 color-primary"></span> info@deliveryfast.com
                        </span>
                    <span>
                            <span class="ti-mobile mr-2 color-primary"></span> +1 342 422 9029
                        </span>
                </div>
            </div>
        </div>
    </nav>
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg  custom-nav white-bg">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('uiassets/img/logo2.png')}}" width="120" alt="logo"
                                                           class="img-fluid"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>

            <div class="collapse navbar-collapse main-menu" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{url('/')}}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#">Our Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('login')}}" class="btn solid-btn nav-link btn-login">Login</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="dropdown-toggle btn solid-btn nav-link btn-login btn-register" href="#"
                               role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Register as
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{route('ui.register','supervisor')}}">Supervisor</a></li>
                                <li><a class="dropdown-item" href="{{route('ui.register','driver')}}">Driver</a></li>
                                <li><a class="dropdown-item" href="{{route('ui.register','client')}}">Client</a></li>
                            </ul>
                        </div>
                        <!-- <a href=""
                            class="btn solid-btn nav-link btn-login btn-register">Register</a> -->
                    </li>
                    <li class="nav-item">
                        <a href="#" class="btn solid-btn nav-link btn-lang btn-login">ع</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--end navbar-->
</header>
<!--header section end-->
