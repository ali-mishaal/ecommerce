@extends('commonmodule::layouts.master')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/material-design-icon.css')}}">


<div class="btn-create">
    @can('roles.create')
    <a class="btn btn-primary mb-2 mr-1" href="{{url('roles/create')}}"> <i
            class="icon-plus pr-1"></i> {{ trans('lang.create_roles') }}</a>
    @endcan
    @if(false)
    <button class="btn btn-outline-primary mb-2" data-toggle="modal" data-target="#create-permission"> <i
            class="icon-plus pr-1"></i>{{ trans('lang.create_permissions') }}</button>
    @endif
</div>
<div class="roles-page all-pages">
    <div class="card-header">

        <h5>{{ trans('lang.roles') }}</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">

                <table class="display table table-striped no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 229px;">Name</th>
                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 137.203px;">
                                Settings
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ app()->getLocale() == 'en' ? $role->name : $role->name_ar }}</td>
                            <td>
                                <div class="dropdown-basic">
                                    <div class="dropdown">
                                        <button class="btn dropbtn btn-primary btn-round dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @can('roles.edit')
                                            <a class="dropdown-item" href="{{url('roles/'.$role->id.'/edit')}}" >
                                                <i class="mdi mdi-square-edit-outline mr-1"></i> Edit</a>
                                            @endcan
                                            @can('roles.delete')
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" data-toggle="modal"
                                                data-target=".popup-delete">
                                                <i class="mdi mdi-delete-outline mr-1"></i>Delete</a>
                                                @endcan
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- <div class="dataTables_info" id="basic-1_info" role="status" aria-live="polite">Showing 1 to 10 of 57
                    entries</div>
                <div class="dataTables_paginate paging_simple_numbers" id="basic-1_paginate"><a
                        class="paginate_button previous disabled" aria-controls="basic-1" data-dt-idx="0" tabindex="0"
                        id="basic-1_previous">Previous</a><span><a class="paginate_button current"
                            aria-controls="basic-1" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button "
                            aria-controls="basic-1" data-dt-idx="2" tabindex="0">2</a><a class="paginate_button "
                            aria-controls="basic-1" data-dt-idx="3" tabindex="0">3</a><a class="paginate_button "
                            aria-controls="basic-1" data-dt-idx="4" tabindex="0">4</a><a class="paginate_button "
                            aria-controls="basic-1" data-dt-idx="5" tabindex="0">5</a><a class="paginate_button "
                            aria-controls="basic-1" data-dt-idx="6" tabindex="0">6</a></span><a
                        class="paginate_button next" aria-controls="basic-1" data-dt-idx="7" tabindex="0"
                        id="basic-1_next">Next</a></div> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal create role -->
<div class="modal fade bd-example-modal-lg create-role" id="create-role" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('lang.create_roles') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="">
                    <div class="">
                        <div class="mb-3">
                            <label for="validationCustom01">{{ trans('lang.role_name') }}</label>
                            <input class="form-control" id="validationCustom01" type="text"
                                placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.role_name')]) }}" required="">
                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ trans('lang.permissions') }}</th>
                                        <th scope="col">{{ trans('lang.create') }}</th>
                                        <th scope="col">{{ trans('lang.edit') }}</th>
                                        <th scope="col">{{ trans('lang.update')  }}</th>
                                        <th scope="col">{{ trans('lang.delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ trans('lang.permission1') }}</td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck2"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck3"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck4"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck4"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>{{ trans('permission2') }}</td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck5"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck5"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck6"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck6"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck7"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck7"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck8"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck8"></label>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">{{ trans('lang.save') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.close') }}</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal delete item -->
<div class="modal fade popup-delete" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.confirm_delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ trans('lang.confirm_delete_message') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">{{ trans('lang.yes_i_am_sure') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.cancel') }}</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal user icon -->
<div class="modal fade popup-delete user-icon" id="user-icon" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.user_role') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="">
                    <div class="mb-3">
                        <label for="username">{{ trans('lang.username') }}</label>
                        <input class="form-control" id="username" name="username" type="text"
                            placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.username')]) }}" required="">
                        <div class="valid-feedback">{{ trans('lang.good') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="password">{{ trans('lang.password') }}</label>
                        <input class="form-control" id="password" name="password" type="password"
                            placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.password')]) }}" required="">
                        <div class="valid-feedback">{{ trans('lang.good') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="role">{{ trans('lang.role') }}</label>
                        <select class="custom-select" id="role" name="role" required="">
                            <option selected="" value="">{{ trans('lang.choose...') }}</option>
                            <option>{{ trans('lang.admin') }}</option>
                            <option>{{ trans('lang.supervisor') }}</option>

                        </select>
                        <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.role')]) }}</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">{{ trans('lang.save') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.cancel') }}</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal create permission -->
<div class="modal fade bd-example-modal-lg create-permission" id="create-permission" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('lang.create_permission') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="savePermissions" novalidate="" method="post" action="{{route('permissions.store')}}">
            <div class="modal-body">
                    @csrf
                    <div class="">
                        <div class="mb-3">
                            <label for="validationCustom01">{{ trans('lang.arabic_name') }}</label>
                            <input class="form-control" id="validationCustom01" type="text"
                                placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.arabic_name')]) }}" name="title_ar" required="">
                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="validationCustom01">{{ trans('lang.english_name') }}</label>
                            <input class="form-control" id="validationCustom01" type="text"
                                placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.english_name')]) }}" name="title_en" required="">
                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                        </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ trans('lang.save') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.close') }}</button>
            </div>
                </form>
        </div>
    </div>
</div>
</div>

<!-- Modal edit role -->
<div class="modal fade bd-example-modal-lg edit-role" id="edit-role" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('lang.edit_role') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="">
                    <div class="">
                        <div class="mb-3">
                            <label for="validationCustom01">{{ trans('lang.role_name') }}</label>
                            <input class="form-control" id="validationCustom01" type="text"
                                placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.role_name')]) }}" required="">
                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ trans('lang.permissions') }}</th>
                                        <th scope="col">{{ trans('lang.create') }}</th>
                                        <th scope="col">{{ trans('lang.edit') }}</th>
                                        <th scope="col">{{ trans('lang.update') }}</th>
                                        <th scope="col">{{ trans('lang.delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ trans('lang.permission1') }}</td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck2"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck3"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck4"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck4"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>{{ trans('lang.permission2') }}</td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck5"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck5"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck6"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck6"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck7"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck7"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck8"
                                                    name="example1">
                                                <label class="custom-control-label" for="customCheck8"></label>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">{{ trans('lang.save') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.close') }}</button>
            </div>
        </div>
    </div>
</div>

</div>

@endsection

@section('js')
    <script>
        $(document).ready(function (){
            $('#savePermissions').on('submit',function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    type:'post',
                    url:$(this).attr('action'),
                    data:formData,
                    processData: false,
                    contentType: false,
                    statusCode: {
                        200:function (response) {
                            if (response.code == 200) {
                                document.getElementById("savePermissions").reset();
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
