@extends('commonmodule::layouts.master')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/material-design-icon.css')}}">


    <div class="roles-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.create_roles') }}</h5>
        </div>
        <div class="card-body">
            <form class="needs-validation" id="edit_role" novalidate="" method="post" action="{{url('roles/'.$role->id)}}">
                @csrf
                <div class="">
                    <div class="mb-3 col-md-6">
                        <label for="validationCustom01">{{ trans('lang.english_name') }}</label>
                        <input class="form-control" id="validationCustom01" type="text"
                               placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.english_name')]) }}" name="name" value="{{$role->name}}" required="">
                        <div class="valid-feedback">{{ trans('lang.good') }}</div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="validationCustom01">{{ trans('lang.arabic_name') }}</label>
                        <input class="form-control" id="validationCustom01" type="text"
                               placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.arabic_name')]) }}" name="name_ar" value="{{$role->name_ar}}" required="">
                        <div class="valid-feedback">{{ trans('lang.good') }}</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ trans('lang.permission') }}</th>
                                <th scope="col">{{ trans('lang.show') }}</th>
                                <th scope="col">{{ trans('lang.create') }}</th>
                                <th scope="col">{{ trans('lang.update') }}</th>
                                <th scope="col">{{ trans('lang.delete') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissionGroups as $key=>$permissions)
                                <tr>
                                <td>{{$key}}</td>
                                    @foreach($permissions as $key=>$permission)
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="{{$permission->name}}"
                                               name="permissions[]" value="{{$permission->name}}" {{($role->hasPermissionTo($permission))?'checked':''}}>
                                        <label class="custom-control-label" for="{{$permission->name}}"></label>
                                    </div>
                                </td>
                                    @endforeach

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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
            $('#edit_role').on('submit',function (e) {
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
                                document.getElementById("edit_role").reset();
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

