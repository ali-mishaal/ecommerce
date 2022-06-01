@extends('commonmodule::layouts.master')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/material-design-icon.css')}}">


    <div class="roles-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.create_roles') }}</h5>
        </div>
        <div class="card-body">
            <form class="needs-validation" id="create_role" novalidate="" method="post" action="{{url('roles')}}">
                @csrf
                <div class="">
                    <div class="mb-3 col-md-6">
                        <label for="validationCustom01">{{ trans('lang.arabic_name') }}</label>
                        <input class="form-control" id="validationCustom01" type="text"
                               placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.arabic_name')]) }}" name="name" required="">
                        <div class="valid-feedback">{{ trans('lang.good') }}</div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="validationCustom01">{{ trans('lang.english_name') }}</label>
                        <input class="form-control" id="validationCustom01" type="text"
                               placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.english_name')]) }}" name="name_ar" required="">
                        <div class="valid-feedback">{{ trans('lang.good') }}</div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">{{ trans('lang.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function (){
            $('#create_role').on('submit',function (e) {
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
                                document.getElementById("create_role").reset();
                                $('#create-permission').modal('toggle');
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
                                    location.href = '{{url('roles')}}'
                                },1000)

                            } else {
                                $.notify({
                                    // options
                                    message: 'error while processing request',
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
        });
    </script>
@endsection

