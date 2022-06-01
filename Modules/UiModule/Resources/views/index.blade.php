@extends('uimodule::layouts.master')

@section('content')
    <!--body content wrap start-->
    <div class="main">

        <!--hero section start-->
        <section class="hero-section ptb-100 background-img full-screen"
                 style="background: url('{{asset('uiassets/img/app-hero-bg.jpg')}}')no-repeat center center / cover">
            <div class="container">
                <div class="row align-items-center justify-content-between pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                    <div class="col-md-7 col-lg-6">
                        <div class="hero-content-left text-white mt-3">
                            <p class="small mb-0 white-color">SAVE MONEY</p>
                            <h1 class="text-white">DELIVERY FAST</h1>
                            <p class="lead">
                                Lorem Media is a full-service social media agency.
                                We offer businesses innovative solutions that deliver.
                            </p>
                            <a href="#" class="btn solid-btn btn-login btn-register btn-more">Learn more ..</a>
                        </div>
                    </div>
                </div>
                <div class="bottom-header">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="media">
                                <img class="mr-3" src="{{asset('uiassets/img/fast.svg')}}" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0 h-color">Fastest Delivery</h5>
                                    <p class="small mb-0 p-color">Cras sit amet nibh libero, in gravida nulla. Nulla vel
                                        metus</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="media">
                                <img class="mr-3" src="{{asset('uiassets/img/best.svg')}}" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0 h-color">Best Quality</h5>
                                    <p class="small mb-0 p-color">Cras sit amet nibh libero, in gravida nulla. Nulla vel
                                        metus</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="media">
                                <img class="mr-3" src="{{asset('uiassets/img/money.svg')}}" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0 h-color">Keep Your Money</h5>
                                    <p class="small mb-0 p-color">Cras sit amet nibh libero, in gravida nulla. Nulla vel
                                        metus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--hero section end-->

        <!-- about section start-->
        <section class="ptb-100 about-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="w-100">
                            <img class="img-responsive mx-auto d-block w-100 h-100" src="{{asset('uiassets/img/about-img.jpg')}}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="content-about ml-5">
                            <p class="mb-0 small">Who We Are</p>
                            <h3 class="h-color">About Us</h3>
                            <p class="p-color">Lorem Media is a full-service social media agency.
                                We offer businesses innovative solutions that deliver the right type of audience
                            </p>
                            <p class="p-color">Lorem Media is a full-service social media agency. We offer businesses
                                innovative solutions
                                that deliver the right type of audience to you in the most effective strategies
                                possible. We
                                strive to develop a community around your business, polishing your branding, and
                                improving
                                your public relations.
                                Lorem Media is a full-service social media agency. We offer businesses innovative
                                solutions
                                that deliver the right type of audience to you in the most effective strategies
                                possible. We
                                strive to develop a community around your business, polishing your branding, and
                                improving
                                your public relations.

                            </p>
                            <p class="p-color">Lorem Media is a full-service social media agency. We offer businesses
                                innovative solutions
                            </p>
                            <p class="p-color">Lorem Media is a full-service social media agency. We offer businesses
                                innovative solutions
                            </p>
                            <a href="#" class="btn solid-btn btn-login p-btn">More info ..</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about section end-->

        <!-- services section start-->
        <section class="services-sec promo-section ptb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-8">
                        <div class="section-heading text-center mb-5">
                            <h3 class="h-color">Our Services</h3>
                        </div>
                    </div>
                </div>
                <div class="row equal">
                    <div class="col-md-4 col-lg-4 mb-5">
                        <div
                            class="single-promo single-promo-hover single-promo-1 rounded text-center white-bg p-5 h-100">
                            <div class="circle-icon mb-4">
                                <span><img src="{{asset('uiassets/img/order.svg')}}" alt=""></span>
                            </div>
                            <h5 class="h-color">Goods delivery service with a source guarantee </h5>
                            <p class="p-color">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 mb-5">
                        <div
                            class="single-promo single-promo-hover single-promo-1 rounded text-center white-bg p-5 h-100">
                            <div class="circle-icon mb-4">
                                <span><img src="{{asset('uiassets/img/man.png')}}" alt=""></span>
                            </div>
                            <h5 class="h-color">Management Work Service</h5>
                            <p class="p-color">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 mb-5">
                        <div
                            class="single-promo single-promo-hover single-promo-1 rounded text-center white-bg p-5 h-100">
                            <div class="circle-icon mb-4">
                                <span><img src="{{asset('uiassets/img/money (1).svg')}}" alt=""></span>
                            </div>
                            <h5 class="h-color">Save your money</h5>
                            <p class="p-color">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- services section end-->

        <!-- blog section start-->

        <section id="blog" class="our-blog-section ptb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="section-heading mb-5 text-center text-white">
                            <h2 class="h-color">Our latest news</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-blog-card card border-0 shadow-sm white-bg">
                            <!-- <span class="category position-absolute badge badge-pill badge-primary">Lifestyle</span> -->
                            <img src="{{asset('uiassets/img/blog/1.png')}}" class="card-img-top position-relative" alt="blog">
                            <div class="card-body">
                                <div class="post-meta mb-2">
                                    <ul class="list-inline meta-list">
                                        <li class="list-inline-item">Jan 21, 2019</li>
                                        <li class="list-inline-item"><span>45</span> Comments</li>
                                        <li class="list-inline-item"><span>10</span> Share</li>
                                    </ul>
                                </div>
                                <h3 class="h5 card-title h-color"><a href="#">Appropriately productize fully</a></h3>
                                <p class="card-text p-color">Some quick example text to build on the card title and make
                                    up the bulk.</p>
                                <div class="media">
                                    <img class="mr-3" src="{{asset('uiassets/img/moaaz.jpg')}}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h6 class="mt-0 h-color">Moaaz Mohsen</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-blog-card card border-0 shadow-sm white-bg">
                            <!-- <span class="category position-absolute badge badge-pill badge-danger">Technology</span> -->
                            <img src="{{asset('uiassets/img/blog/2.png')}}" class="card-img-top position-relative" alt="blog">
                            <div class="card-body">
                                <div class="post-meta mb-2">
                                    <ul class="list-inline meta-list">
                                        <li class="list-inline-item">May 26, 2019</li>
                                        <li class="list-inline-item"><span>30</span> Comments</li>
                                        <li class="list-inline-item"><span>5</span> Share</li>
                                    </ul>
                                </div>
                                <h3 class="h5 card-title h-color"><a href="#">Quickly formulate backend</a></h3>
                                <p class="card-text p-color">Synergistically engage effective ROI after customer
                                    directed partnerships.</p>
                                <div class="media">
                                    <img class="mr-3" src="{{asset('uiassets/img/moaaz.jpg')}}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h6 class="mt-0 h-color">Moaaz Mohsen</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-blog-card card border-0 shadow-sm white-bg">
                            <!-- <span class="category position-absolute badge badge-pill badge-info">Science</span> -->
                            <img src="{{asset('uiassets/img/blog/1.png')}}" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <div class="post-meta mb-2">
                                    <ul class="list-inline meta-list">
                                        <li class="list-inline-item">Apr 25, 2019</li>
                                        <li class="list-inline-item"><span>41</span> Comments</li>
                                        <li class="list-inline-item"><span>30</span> Share</li>
                                    </ul>
                                </div>
                                <h3 class="h5 card-title h-color"><a href="#">Objectively extend extensive</a></h3>
                                <p class="card-text p-color">Holisticly mesh open-source leadership rather than
                                    proactive users. </p>
                                <div class="media">
                                    <img class="mr-3" src="{{asset('uiassets/img/moaaz.jpg')}}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h6 class="mt-0 h-color">Moaaz Mohsen</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- blog section end-->

        <!-- offer section start-->
        <section class="offer-sec promo-section ptb-100">
            <div class="container">
                <div class="row justify-content-between">
                    <h4 class="mb-0 white-color">Want to get 20% off? Save the time and money?</h4>
                    <a href="#" class="btn solid-btn btn-login btn-register btn-more">More offers ..</a>
                </div>
            </div>
        </section>
        <!-- offer section end-->

        <!-- testimonails section start-->

        <section class="testimonails pd-section ptb-100">
            <div class="container">
                <h2 class="mgb-20 s-color text-center h-color">Testimonials</h2>
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <img src="{{asset('uiassets/img/moaaz.jpg')}}" class="mb-2" alt="">
                        <h5 class="mb-4">Moaaz Mohsen</h5>
                        <p>من السهل جدًا التواصل معنا. فقط استخدم نموذج الاتصال أو ادفع لنا زيارة لتناول
                            القهوة في المكتب. ديناميكية ابتكار تكنولوجيا تنافسية بعد مجموعة موسعة من
                            القيادة.</p>
                    </div>
                    <div class="item">
                        <img src="{{asset('uiassets/img/avat-per.jpg')}}" class="mb-2" alt="">
                        <h5 class="mb-4">Yousef Mohsen</h5>
                        <p>من السهل جدًا التواصل معنا. فقط استخدم نموذج الاتصال أو ادفع لنا زيارة لتناول
                            القهوة في المكتب. ديناميكية ابتكار تكنولوجيا تنافسية بعد مجموعة موسعة من
                            القيادة.</p>
                    </div>

                </div>

            </div>
        </section>

        <!-- testimonails section end-->

        <!-- contact-sec start-->
        <section class="hero-section ptb-100 background-img full-screen bg-contact"
                 style="background: url('{{asset('uiassets/img/app-hero-bg.jpg')}}')no-repeat center center / cover">
            <div class="container">
                <div class="row align-items-center justify-content-between pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                    <div class="col-md-7 col-lg-6">
                        <div class="hero-content-left text-white">
                            <h1 class="text-white">Contact Us</h1>
                            <p class="lead">
                                Always keep your face in sunlight - the shadows will fall behind you.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5">
                        <div class="card login-signup-card shadow-lg mb-0 mt-5">
                            <div class="card-body px-md-5 py-5">
                                <div class="mb-4">
                                    <h5 class="h3">Fill in the form</h5>

                                </div>

                                <!--login form-->
                                <form class="login-signup-form">
                                    <div class="form-group">
                                        <!-- <label class="pb-1">Name</label> -->
                                        <div class="input-group">
                                            <input type="email" class="form-control" placeholder="Enter name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label class="pb-1">Email</label> -->
                                        <div class="input-group">
                                            <input type="email" class="form-control" placeholder="name@domain.com">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label class="pb-1">Phone</label> -->
                                        <div class="input-group">
                                            <input type="number" class="form-control" placeholder="Enter phone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="txt">Message</label> -->
                                        <textarea class="form-control" id="txt" rows="7"
                                                  placeholder="Enter message"></textarea>
                                    </div>

                                    <!-- Submit -->
                                    <button class="btn btn-lg btn-block solid-btn border-radius mt-4 mb-3">
                                        Send
                                    </button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- contact-sec end-->

        <section class="footer  ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="">
                            <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('uiassets/img/logo2.png')}}" width="120" alt="logo"
                                                                           class="img-fluid"></a>
                            <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                            <p class="mt-5">© Copyright 2021 Delivery Fast,  All Right Reserved</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="">
                            <h5 class="h-color">Quick View</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link p-color" href="{{url('/')}}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-color" href="#">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-color" href="#">Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-color" href="#">Blog</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="">
                            <h5 class="h-color">Contact us</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <span class="nav-link">
                                        <span class="ti-email mr-2 color-primary"></span> info@deliveryfast.com
                                    </span>

                                </li>
                                <li class="nav-item">
                                    <span class="nav-link">
                                        <span class="ti-mobile mr-2 color-primary"></span> +1 342 422 9029
                                    </span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!--body content wrap end-->
@endsection
