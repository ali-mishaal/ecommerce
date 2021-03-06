@extends('commonmodule::layouts.master')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/material-design-icon.css')}}">


    <div class="btn-create">
        <button class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#create-vehicle"> <i
                class="icon-plus pr-1"></i>{{ trans('lang.create_brand') }}</button>
    </div>
    <div class="vehicle-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.brands') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    <table class="display dataTable no-footer" id="example1" role="grid" aria-describedby="basic-1_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 229px;">{{ trans('lang.arabic_name') }}</th>
                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 137.203px;">
                                {{ trans('lang.english_name') }}
                            </th>


                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 100px">{{ trans('lang.settings') }}</th>


                        </tr>
                        </thead>
                        <tbody>


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


    <!-- Modal create vehicle -->
    <div class="modal fade bd-example-modal-lg create-vehicle" id="create-vehicle" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('lang.create_brand') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="saveVehicle" action="{{url('brands')}}" method="post" novalidate="" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="brand_id" id="brand_id" value="0">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="km_number">{{ trans('lang.arabic_name') }}</label>
                                <input class="form-control" id="name_ar" type="text" name="name_ar"
                                       placeholder="{{ trans('lang.arabic_name') }}" required="">
                                <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.arabic_name')]) }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="km_number">{{ trans('lang.english_name') }}</label>
                                <input class="form-control" id="name_en" type="text" name="name_en"
                                       placeholder="{{ trans('lang.english_name') }}" required="">
                                <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.english_name')]) }}</div>
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



@endsection
@section('js')
    <script>

        var dataTable = null;



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
                        {extend: 'print', text: '??????????', messageBottom: ' <strong>???????? ???????????? ????????????  Makdak .</strong>'},
                        {extend: 'excel', text: ' ??????????'},
                    ],
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "language": {
                        "search": "  ?????? :  ",
                        "paginate": {
                            "previous": "????????????",
                            "next": "????????????"
                        },
                        "info": "?????? _START_ ?????? _END_ ???? _TOTAL_ ???? ????????????",
                        "lengthMenu": "?????? _MENU_ ???? ????????????",
                        "loadingRecords": "???????? ??????????????...",
                        "processing": "???????? ??????????????...",
                        "zeroRecords": "???? ???????? ??????????",
                        "infoEmpty": "?????? 0 to 0 of 0 ???? ????????????",
                        "infoFiltered": "(?????? ???? _MAX_ ????)",
                    },
                    "processing": true,
                    "scrollX": true,
                    'autoWidth'   : false,
                    "serverSide": true,
                    "ajax": {

                        "url": "{{ url('datatables/brands') }}",
                        "type": "GET",
                        "data": function (d) {
                            var filter_data = $('#filter_form').serialize();
                            d.filter = filter_data                    },

                    },
                    "order": [[0, "desc"]],
                    "columns": [
                        {data: 'name_ar', name: 'name_ar'},
                        {data: 'name_en', name: 'name_en'},
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
                url:"{{url('brands/')}}/"+id,
                success:function (response){
                    // $('#saveAdmin').attr('action',response.data.edit_url);
                    $('#brand_id').val(response.data.id);
                    $('#name_ar').val(response.data.name_ar);
                    $('#name_en').val(response.data.name_en);
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
                url:"{{url('brands/')}}/"+id,
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
