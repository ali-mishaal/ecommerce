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
                                    <h5 class="h3">{{ trans('lang.create_client') }}</h5>
                                    <p class="text-muted mb-0">{{ trans('lang.create_account_to_con') }}</p>
                                </div>

                                <!--login form-->

                                <form id="register" action="{{route('client.register')}}" class="needs-validation login-signup-form" novalidate="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">{{ trans('lang.name') }}</label>
                                            <input class="form-control" id="name" name="name" type="text" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.name')]) }}" required="" data-original-title="" title="">
                                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="civil_id">{{ trans('lang.civil_id') }}</label>
                                            <input class="form-control" id="civil_id" name="civil_id" type="text" maxlength="12" minlength="12" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.civil_id')]) }}" required="" data-original-title="" title="">
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
                                            <label for="address">{{ trans('lang.address') }}</label>
                                            <input class="form-control" id="address" name="address" type="text" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.address')]) }}" required="" data-original-title="" title="">
                                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="number">{{ trans('lang.mobile') }}</label>
                                            <input class="form-control" id="mobile" type="number" name="mobile" maxlength="8" minlength="8" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.mobile')]) }}" required="" data-original-title="" title="">
                                            <div class="invalid-feedback" id="mobile-error"></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="activity">{{ trans('lang.activity') }}</label>
                                            <input class="form-control" id="activity" type="text" name="activity" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.activity')]) }}" required="" data-original-title="" title="">
                                            <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.activity')]) }}</div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="project_data">{{ trans('lang.project_data') }}</label>
                                            <input class="form-control" id="project_data" type="text" name="project_data" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.project_data')]) }}" required="" data-original-title="" title="">
                                            <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.project_data')]) }}</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">{{ trans('lang.car_image') }}</label>
                                            <div class="custom-file">
                                                <input type="file" class="form-control" id="image" name="image" data-original-title="" title="">
                                                <label class="custom-file-label" for="image">{{ trans('lang.choose') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="fees">{{ trans('lang.fees') }}</label>
                                            <input class="form-control" id="fees" type="text" name="fees" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.fees')]) }}" required="" data-original-title="" title="">
                                            <div class="invalid-feedback" id="fees-error"></div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="payment_type">{{ trans('lang.payment_type') }}</label>
                                            <select onchange="changedislimit(this)" class="custom-select" id="payment_type" name="payment_type_id" required="">
                                                <option selected="" value="">{{ trans('lang.choose...') }}</option>
                                                @foreach($paymentType as $type)
                                                    <option value="{{$type->id}}">{{$type->name_en}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.payment_type')]) }}</div>
                                            <div class="mt-3">
                                                <input class="form-control" id="limit" disabled="" type="number" name="limit" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.limit')]) }}" required="" data-original-title="" title="">
                                                <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.limit')]) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="payment_method">{{ trans('lang.payment_method') }}</label>
                                            <select onchange="changedis(this)" class="custom-select" id="payment_method" name="payment_method_id" required="">
                                                <option selected="" value="">{{ trans('lang.choose...') }}</option>
                                                @foreach($paymentMethod as $method)
                                                    <option value="{{$method->id}}">{{$method->name_en}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.payment_method')]) }}</div>
                                            <div class="mt-3">
                                                <input class="form-control" id="bank_account" disabled="" type="number" name="bank_account" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.bank_account')]) }}" required="" data-original-title="" title="">
                                                <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.bank_account')]) }}</div>
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
            if($('#'+va.id).val() !=='')
            {
                $(va).siblings('div').children('input').removeAttr('disabled')
            }else
            {
                $(va).siblings('div').children('input').attr('disabled','disabled')
            }
        }

        function changedislimit(va)
        {
            if($('#'+va.id).val() ==2)
            {
                $(va).siblings('div').children('input').removeAttr('disabled')
            }else
            {
                $(va).siblings('div').children('input').attr('disabled','disabled')
            }
        }
    </script>
@endsection
