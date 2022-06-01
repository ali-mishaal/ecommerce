@extends('commonmodule::layouts.master')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/material-design-icon.css')}}">


    <div class="btn-create">
        @can('vehicles.store')
            <button class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#create-vehicle"> <i
                    class="icon-plus pr-1"></i>{{ trans('lang.create_vehicle') }}</button>
        @endcan
    </div>
    <div class="vehicle-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.vehicle') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    <table class="display dataTable no-footer" id="example1" role="grid" aria-describedby="basic-1_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 137.203px;">
                                {{ trans('lang.brands') }}
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 174.406px;">
                                {{ trans('lang.color') }}
                            </th>
                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 229px;">{{ trans('lang.system_number') }}
                            </th>

                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 229px;">{{ trans('lang.vehicle_number') }}</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 100px">{{ trans('lang.settings') }}</th>


                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
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
                    <input type="hidden" id="deleteUser">
                </div>
                <div class="modal-body">
                    {{ trans('lang.confirm_delete_message') }}
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="deleteUser()" class="btn btn-primary">{{ trans('lang.yes_i_am_sure') }}</button>
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
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="mb-3">
                            <label for="password">{{ trans('lang.password') }}</label>
                            <input class="form-control" id="password" name="password" type="password"
                                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.password')]) }}" required="">
                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="role">Role</label>
                            <select class="custom-select" id="role" name="role" required="">
                                <option selected="" value="">{{ trans('lang.choose') }}</option>
                                <option>admin</option>
                                <option>superviser</option>

                            </select>
                            <div class="invalid-feedback">{{ trans('lang.select_valid_state') }}</div>
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


    @can('vehicles.store')
        <!-- Modal create vehicle -->
        <div class="modal fade bd-example-modal-lg create-vehicle" id="create-vehicle" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel2" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ trans('lang.create_vehicle') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="needs-validation" id="saveVehicle" action="{{url('vehicles')}}" method="post" novalidate="" enctype="multipart/form-data">

                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="vehicle_id" id="vehicle_id" value="0">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="brand">Brand</label>
                                    <select class="form-control" id="brand" name="brand" required="">
                                        <option value="" selected>{{ trans('lang.choose') }}</option>
                                        @foreach($brands as $key)
                                            <option value="<?=$key->id;?>">{!! \Modules\CommonModule\Helper\LanguageHelper::districtTranslate($key) !!}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="color">{{ trans('lang.color') }}</label>
                                    <input class="form-control" id="vcolor" name="color" type="text" placeholder="{{ trans('lang.enter_color') }}"
                                           required="">
                                    <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vehicle_number">{{ trans('lang.vehicle_number') }}</label>
                                    <input class="form-control" id="vehicle_number" type="text" name="vehicle_number"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.vehicle_number')]) }}" required="">
                                    <div class="invalid-feedback">{{ trans('lang.vehicle_number_hint') }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="system_number">{{ trans('lang.system_number') }}</label>
                                    <input class="form-control" id="system_number" type="text" name="system_number"
                                           placeholder="{{ trans('lang.enter_system_number') }}" required="">
                                    <div class="invalid-feedback">{{ trans('lang.system_number_hint') }}</div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
{{--                                    <label for="type">{{ trans('lang.is_motorcycle') }}</label>--}}
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input  value="1" type="checkbox" class="custom-control-input" id="is_moto"
                                               name="is_moto">
                                        <label class="custom-control-label" for="is_moto">{{ trans('lang.is_motorcycle') }}</label>
                                    </div>

                                    <div class="invalid-feedback">{{ trans('lang.vehicle_type_hint') }}</div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="type">{{ trans('lang.type') }}</label>
                                    <select class="form-control" id="type"  name="type" required="">
                                        <option value="" selected>{{ trans('lang.choose') . trans('lang.type') }}</option>
                                        @foreach($VehicleTypes as $key)
                                            <option value="<?=$key->id;?>">{!! \Modules\CommonModule\Helper\LanguageHelper::districtTranslate($key) !!}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ trans('lang.vehicle_type_hint') }}</div>
                                </div>

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
    @endcan


@endsection

@section('js')
    <script>

        var dataTable = null;

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


        $(document).ready(function () {


            dataTable = dt();

            $('#filter_btn').on('click', function (e) {
                e.preventDefault();

                dataTable.ajax.reload();
            });

            $("#clear_filter_btn").click(function () {
                $('#filter_form').find("input[type=text],checkbox, textarea,select").val("");
                $('#filter_btn').attr('style', '');
                dataTable.ajax.reload();
            });


            function dt(){


                let dtvar= $('#example1').DataTable({
                    dom: 'lBfrtip',
                    buttons: [
                        {extend: 'print', text: 'طباعه', messageBottom: ' <strong>جميع الحقوق محفوظة  Makdak .</strong>'},
                        {extend: 'excel', text: ' اكسيل'},
                    ],
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "language": {
                        "search": "  بحث :  ",
                        "paginate": {
                            "previous": "السابق",
                            "next": "التالى"
                        },
                        "info": "عرض _START_ الي _END_ من _TOTAL_ من الصفوف",
                        "lengthMenu": "عرض _MENU_ من الصفوف",
                        "loadingRecords": "جاري التحميل...",
                        "processing": "جاري التحميل...",
                        "zeroRecords": "لا يوجد نتائج",
                        "infoEmpty": "عرض 0 to 0 of 0 من الصفوف",
                        "infoFiltered": "(عرض من _MAX_ صف)",
                    },
                    "processing": true,
                    "scrollX": true,
                    'autoWidth'   : false,
                    "serverSide": true,
                    "ajax": {

                        "url": "{{ url('datatables/vehicles') }}",
                        "type": "GET",
                        "data": function (d) {
                            var filter_data = $('#filter_form').serialize();
                            d.filter = filter_data                    },

                    },
                    "order": [[0, "desc"]],
                    "columns": [
                        {data: 'brand.name_en', name: 'brand'},
                        {data: 'color', name: 'color'},
                        {data: 'system_number', name: 'system_number'},
                        {data: 'vehicle_number', name: 'vehicle_number'},
                        {data: 'operations', name: 'operations'},
                    ]
                });


                return  dtvar;
            }

            $('#saveVehicle').on('submit',function (e) {
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
                                document.getElementById("saveVehicle").reset();
                                dataTable.ajax.reload();
                                $('#create-vehicle').modal('toggle');
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
            $('#accountForm').on('submit',function (e) {
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
                                document.getElementById("accountForm").reset();
                                dataTable.ajax.reload();
                                $('#user-icon').modal('toggle');
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


        function getVehicleData(id)
        {
            $.ajax({
                type:"get",
                url:"{{url('vehicles/')}}/"+id,
                success:function (response){
                    // $('#saveAdmin').attr('action',response.data.edit_url);
                    $('#vehicle_id').val(response.data.id);
                    $('#brand').val(response.data.brand);
                    $('#vcolor').val(response.data.color);
                    $('#vehicle_number').val(response.data.vehicle_number);
                    $('#system_number').val(response.data.system_number);
                    $('#type').val(response.data.type);
                },
                onload:function (){
                    $.notify({
                        // options
                        message: 'looding.....',
                    },{
                        // settings
                        type: 'default',
                        position:'absolute',
                        z_index: 999999,
                        showProgressbar:true,
                        delay:2000

                    });
                }
            });
        }

        function setSupervisorId(id)
        {
            $('#deleteUser').val(id);
        }
        function deleteUser()
        {
            var id = $('#deleteUser').val();
            $.ajax({
                type:"DELETE",
                url:"{{url('vehicles/')}}/"+id,
                data:{'_token':"{{csrf_token()}}"},
                success:function (response){
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
                    dataTable.ajax.reload();
                    $('#exampleModal').modal('toggle');
                },
                onload:function (){
                    $.notify({
                        // options
                        message: 'looding.....',
                    },{
                        // settings
                        type: 'default',
                        position:'absolute',
                        z_index: 999999,
                        showProgressbar:true,
                        delay:2000

                    });
                }
            });
        }

        function getAccountData(id)
        {
            $.ajax({
                type:"get",
                url:"{{url('vehicles/')}}/"+id,
                success:function (response){
                    $('#user_id').val(response.data.id);
                    $('#username').val(response.data.username);
                    if (response.data.user.password){
                        $('#password').removeAttr('required');
                    }else{
                        $('#password').attr('required',true);
                    }

                },
                onload:function (){
                    $.notify({
                        // options
                        message: 'looding.....',
                    },{
                        // settings
                        type: 'default',
                        position:'absolute',
                        z_index: 999999,
                        showProgressbar:true,
                        delay:2000

                    });
                }
            });
        }
    </script>
@endsection
