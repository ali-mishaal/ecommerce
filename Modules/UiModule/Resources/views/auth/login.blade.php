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
                        <div class="hero-content-left text-white">
                            <h1 class="text-white">Welcome back !</h1>
                            <p class="lead">
                                Always keep your face in sunlight - the shadows will fall behind you.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5">
                        <div class="card login-signup-card shadow-lg mb-0">
                            <div class="card-body px-md-5 py-5">
                                <div class="mb-5">
                                    <h5 class="h3">Sign in</h5>
                                    <p class="text-muted mb-0">Log in to your account to continue.</p>
                                </div>

                                <!--login form-->
                                <form class="login-signup-form" id="loginForm" method="post" action="{{url('login')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="pb-1">username</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-email color-primary"></span>
                                            </div>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="username">
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label class="pb-1">Password</label>
                                            </div>
{{--                                            <div class="col-auto">--}}
{{--                                                <a href="password-reset.html" class="form-text small text-muted">--}}
{{--                                                    forget password?--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-lock color-primary"></span>
                                            </div>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="btn btn-lg btn-block solid-btn border-radius mt-4 mb-3">
                                        Sign in
                                    </button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--hero section end-->


    </div>
    <!--body content wrap end-->

@endsection

@section('js')
    <script>
        $('#loginForm').on('submit',function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'post',
                url:$(this).attr('action'),
                data:formData,
                processData: false,
                contentType: false,
                statusCode: {
                    200:function (response) {
                        if (response.code == 200) {
                            $.notify({
                                // options
                                message: response.message,
                            },{
                                // settings
                                type: 'success',
                                position:'absolute',
                                z_index: 999999,
                                showProgressbar:true,
                                delay:1000
                            });
                            setTimeout(function (){
                                location.href = "{{ url('dashboard') }}"
                            },1000)

                        } else {
                            $.notify({
                                // options
                                message: response.message,
                            },{
                                // settings
                                type: 'danger',
                                position:'absolute',
                                z_index: 999999,
                                showProgressbar:true,
                                delay:1000

                            });
                        }
                    },
                    422:function (response){
                        console.log(response);
                        $.map(response.responseJSON.errors,(error)=>{
                            $.notify({
                                // options
                                message: error[0],
                            },{
                                // settings
                                type: 'danger',
                                position:'absolute',
                                z_index: 999999,
                                showProgressbar:true,
                                delay:2000

                            });
                        });
                    }
                },
            })
        })
    </script>
@endsection
