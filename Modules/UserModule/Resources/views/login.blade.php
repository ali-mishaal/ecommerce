@extends('uimodule::layouts.master')

@section('content')
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper">
    <div class="container-fluid p-0">
        <!-- login page start-->
        <div class="authentication-main mt-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="auth-innerright auth-bg">
                        <div class="authentication-box">
                            <div class="mt-4">
                                <div class="card-body p-0">
                                    <div class="cont text-center">
                                        <form class="theme-form" id="loginForm" method="post" action="{{url('login')}}">
                                                @csrf
                                                <h4>{{ trans('lang.login') }}</h4>
                                                <h6>{{ trans('lang.enter_your_username_password') }}</h6>
                                                <div class="form-group">
                                                    <label class="col-form-label pt-0">{{ trans('lang.your_name') }}</label>
                                                    <input class="form-control" type="text" name="username" id="username" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label">{{ trans('lang.password') }}</label>
                                                    <input class="form-control" type="password" id="password" name="password" required="">
                                                </div>
{{--                                                <div class="checkbox p-0">--}}
{{--                                                    <input id="checkbox1" type="checkbox">--}}
{{--                                                    <label for="checkbox1">Remember me</label>--}}
{{--                                                </div>--}}
                                                <div class="form-group row mt-3 mb-0">
                                                    <button class="btn btn-primary btn-block" type="submit">{{ trans('lang.login') }}</button>
                                                   </div>

                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- login page end-->
    </div>
</div>
<!-- latest jquery-->

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
                            location.href = "{{url('admin')}}"
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
