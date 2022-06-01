@extends('uimodule::layouts.master')


@section('content')
    <!--body content wrap start-->
    <div class="main">

        <!--hero section start-->
        <section class="hero-section ptb-100 background-img full-screen"
                 style="background: url('{{asset('uiassets/img/app-hero-bg.jpg')}}')no-repeat center center / cover">
            <div class="container">
                <div class="row align-items-center justify-content-between pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                    <div class="col-md-4 col-lg-4">
                        <div class="hero-content-left text-white">
                            <h2 class="text-white">{{ trans('lang.create_account') }}</h2>
                            <p class="lead">
                                {{ trans('lang.create_account_slogan') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <div class="card login-signup-card shadow-lg mb-0">
                            <div class="card-body px-md-5 py-5">
                                <div class="mb-5">
                                    <h5 class="h3">{{ trans('lang.create_driver') }}</h5>
                                    <p class="text-muted mb-0">{{ trans('lang.create_account_to_con') }}</p>
                                </div>

                                <!--create driver form-->

                                <form id="register" action="{{route('driver.register')}}" class="needs-validation login-signup-form" novalidate="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom01">{{ trans('lang.name') }}</label>
                                            <input class="form-control" id="name" name="name" type="text"
                                                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.name')]) }}" required="" data-original-title="" title="">
                                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom02">{{ trans('lang.civil_id') }}</label>
                                            <input class="form-control" id="civil_id" name="civil_id" type="text"
                                                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.civil_id')]) }}" required="" maxlength="12" minlength="12" data-original-title=""
                                                   title="">
                                            <div class="invalid-feedback" id="civil-id-error"></div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom01">{{ trans('lang.username') }}</label>
                                            <input class="form-control" id="username" name="username" type="text"
                                                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.username')]) }}" required="" data-original-title="" title="">
                                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom01">{{ trans('lang.password') }}</label>
                                            <input class="form-control" id="password" name="password" type="password"
                                                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.password')]) }}" required="" data-original-title="" title="">
                                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom02">{{ trans('lang.address') }}</label>
                                            <input class="form-control" id="address" name="address" type="text"
                                                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.address')]) }}" required="" data-original-title="" title="">
                                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">{{ trans('lang.mobile') }}</label>
                                            <input class="form-control" id="mobile" type="number" name="mobile" maxlength="8" minlength="8"
                                                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.mobile')]) }}" required="" data-original-title="" title="">
                                            <div class="invalid-feedback" id="mobile-error"></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">{{ trans('lang.car_image') }}</label>
                                            <div class="custom-file">
                                                <input type="file" class="form-control" id="image" name="image"
                                                       data-original-title="" title="">
                                                <label class="custom-file-label" for="image">{{ trans('lang.choose') }}</label>
                                            </div>
                                        </div>

                                    </div>


                                    <!-- Submit -->
                                    <button class="btn btn-lg btn-block solid-btn border-radius mt-4 mb-3">
                                        {{ trans('lang.sign_up') }}
                                    </button>

                                </form>

                            </div>
                            <div class="card-footer bg-transparent border-top px-md-5"><small>
                                    {{ trans('lang.have_an_account') }}</small>
                                <a href="{{url('login')}}" class="small">{{ trans('lang.sign_in') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!--hero section end-->


    </div>
    <!--body content wrap end-->

@endSection

@section('js')
    <script>
        function changedis(va)
        {
            if($('#'+va.id).is(":checked"))
            {
                $(va).parent().siblings('input').removeAttr('disabled')
                $(va).parent().siblings('select').removeAttr('disabled')
            }else
            {
                $(va).parent().siblings('input').attr('disabled','disabled')
                $(va).parent().siblings('select').attr('disabled','disabled')
            }
        }
    </script>

@endsection
