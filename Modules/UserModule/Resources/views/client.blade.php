@extends('commonmodule::layouts.master')

@section('content')
    <div class="btn-create">
        @can('client.store')
            <button id="buttoncreate" class="btn btn-primary mb-2 mr-1" data-toggle="modal"
                    data-target="#create-client"><i
                    class="icon-plus pr-1"></i>{{ trans('lang.create_client') }}</button>
        @endcan
    </div>
    <div class="client-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.client') }}</h5>
        </div>
        <div class="card-body">
            <h4 class="mb-4">{{ trans('lang.client') }}</h4>
            <div class="table-responsive">

                <table class="display dataTable no-footer" id="example1" role="grid" aria-describedby="basic-1_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                            aria-sort="ascending" aria-label="Name: activate to sort column descending"
                            style="width: 229px;">{{ trans('lang.name') }}</th>
                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                            aria-label="Position: activate to sort column ascending" style="width: 137.203px;">
                            {{trans('lang.civil_id')}}
                        </th>

                        <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                            aria-label="Position: activate to sort column ascending" style="width: 174.406px;">
                            {{ trans('lang.mobile') }}
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                            aria-sort="ascending" aria-label="Name: activate to sort column descending"
                            style="width: 229px;">{{ trans('lang.activity') }}</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                            aria-label="Position: activate to sort column ascending" style="width: 137.203px;">
                            {{ trans('lang.status') }}
                        </th>
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


    <!-- Modal delete item -->
    @include('usermodule::partials.modal_delete')

    <!-- Modal user icon -->
    @include('usermodule::partials.modal_user')


    <!-- Modal create client -->
    <div class="modal fade bd-example-modal-lg create-client" id="create-client" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('lang.create_client') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="saveClient" action="{{url('client')}}" method="post"
                          novalidate="" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="client_id" id="client_id" value="0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">{{ trans('lang.name') }}</label>
                                <input class="form-control" id="name" name="name" type="text" placeholder="Enter name"
                                       required="">
                                <div class="valid-feedback">{{ trans('lang.good') }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="civil_id">{{ trans('lang.civil_id') }}</label>
                                <input class="form-control" id="civil_id" name="civil_id" type="text"
                                       placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.civil_id')]) }}"
                                       required="" maxlength="12" minlength="12">
                                <div class="invalid-feedback" id="civil-id-error"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">{{ trans('lang.mobile') }}</label>
                                <input class="form-control" id="mobile" type="number" name="mobile"
                                       placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.mobile')]) }}"
                                       required="" maxlength="8" minlength="8">
                                <div class="invalid-feedback" id="mobile-error"></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="number">{{ trans('lang.phone') }}</label>
                                <input class="form-control" id="phone" type="number" name="phone"
                                       placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.phone')]) }}"
                                       required="" maxlength="8" minlength="8">
                                <div class="invalid-feedback" id="mobile-error"></div>
                            </div>

                            @include('usermodule::partials.address_inputs')
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="project_data">{{ trans('lang.project_data') }}</label>
                                <input class="form-control" id="project_data" type="text" name="project_data"
                                       placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.project_data')]) }}"
                                       required="">
                                <div
                                    class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.project_data')]) }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="activity">{{ trans('lang.activity') }}</label>
                                <input class="form-control" id="activity" type="text" name="activity"
                                       placeholder="Enter activity" required="">
                                <div
                                    class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.activity')]) }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fees">{{ trans('lang.fees') }}</label>
                                <input class="form-control" id="fees" type="number" step="0.001" min="0" name="fees"
                                       placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.fees')]) }}"
                                       required="">
                                <div class="invalid-feedback" id="fees-error"></div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="payment_type">{{ trans('lang.payment_type') }}</label>
                                <select onchange="changedislimit(this)" class="custom-select" id="payment_type_id"
                                        name="payment_type_id" required="">
                                    <option selected="" value="">{{ trans('lang.choose...') }}</option>
                                    @foreach($paymentType as $type)
                                        <option value="{{$type->id}}">{{ app()->getLocale() == 'ar' ? $type->name_ar :$type->name_en}}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="invalid-feedback">{{ trans('lang.placeholder', ['attribute' => trans('lang.payment_type')]) }}</div>
                                <div class="mt-3">
                                    <input class="form-control" id="limit" disabled type="number" name="limit"
                                           placeholder="{{ trans('lang.limit') }}" required="">
                                    <div
                                        class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.limit')]) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="payment_method">{{ trans('lang.payment_method') }}</label>
                                <select onchange="changedis(this)" class="custom-select" id="payment_method_id"
                                        name="payment_method_id" required="">
                                    <option selected="" value="">{{ trans('lang.choose...') }}</option>
                                    @foreach($paymentMethod as $method)
                                        <option value="{{$method->id}}">{{ app()->getLocale() == 'ar' ? $method->name_ar :$method->name_en}}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="invalid-feedback">{{ trans('lang.placeholder', ['attribute' => trans('lang.payment_method')]) }}</div>
                                <div class="mt-3">
                                    <input class="form-control" id="bank_account" disabled type="number"
                                           name="bank_account"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.bank_account')]) }}"
                                           required="">
                                    <div
                                        class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.bank_account')]) }}</div>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">{{ trans('lang.image') }}</label>
                                <div class="custom-file">
                                    <input type="file" class="file-content" id="image" name="image" accept="image/*" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                    {{--                                <label class="custom-file-label" for="image">{{ trans('lang.choose') }}</label>--}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <img class="w-75" id="blah" src="#"/>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="saveClient">{{ trans('lang.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.cancel') }}</button>
                </div>

            </div>
        </div>
    </div>



@endsection
@section('js')
    <script>

        var dataTable = null;

        $('#buttoncreate').on('click', function () {
            $('#addressShow').css('display', 'block')
        })

        function changedis(va) {
            if ($('#' + va.id).val() !== '') {
                $(va).siblings('div').children('input').removeAttr('disabled')
            } else {
                $(va).siblings('div').children('input').attr('disabled', 'disabled')
            }
        }

        function changedislimit(va) {
            if ($('#' + va.id).val() == 2) {
                $(va).siblings('div').children('input').removeAttr('disabled')
            } else {
                $(va).siblings('div').children('input').attr('disabled', 'disabled')
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


            function dt() {


                let dtvar = $('#example1').DataTable({
                    dom: 'lBfrtip',
                    buttons: [
                        {
                            extend: 'print',
                            text: 'طباعه',
                            messageBottom: ' <strong>جميع الحقوق محفوظة  Makdak .</strong>'
                        },
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
                    'autoWidth': false,
                    "serverSide": true,
                    "ajax": {

                        "url": "{{ url('datatables/client') }}",
                        "type": "GET",
                        "data": function (d) {
                            var filter_data = $('#filter_form').serialize();
                            d.filter = filter_data
                        },

                    },
                    "order": [[0, "desc"]],
                    "columns": [
                        {data: 'name', name: 'user.name'},
                        {data: 'civil_id', name: 'user.civil_id'},
                        {data: 'mobile', name: 'mobile'},
                        {data: 'activity', name: 'activity'},
                        {data: 'status', name: 'status'},
                        {data: 'operations', name: 'operations'},

                    ]
                });


                return dtvar;
            }

            $('#saveClient').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('image', $('#image')[0].files[0]);
                $.ajax({
                    type: 'post',
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    statusCode: {
                        200: function (response) {
                            if (response.code == 200) {
                                document.getElementById("saveClient").reset();
                                dataTable.ajax.reload();
                                $('#create-client').modal('toggle');
                                $.notify({
                                    // options
                                    message: response.message,
                                }, {
                                    // settings
                                    type: 'success',
                                    position: 'absolute',
                                    z_index: 999999,
                                    showProgressbar: true,
                                    delay: 5000

                                });

                            } else {
                                $.notify({
                                    // options
                                    message: 'error while processing request',
                                }, {
                                    // settings
                                    type: 'danger',
                                    position: 'absolute',
                                    z_index: 999999,
                                    showProgressbar: true,
                                    delay: 5000

                                });
                            }
                        },
                        422: function (response) {
                            console.log(response);
                            $.map(response.responseJSON.errors, (error) => {
                                $.notify({
                                    // options
                                    message: error[0],
                                }, {
                                    // settings
                                    type: 'danger',
                                    position: 'absolute',
                                    z_index: 999999,
                                    showProgressbar: true,
                                    delay: 5000

                                });
                            });
                        }
                    },
                })
            })
            $('#accountForm').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'post',
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    statusCode: {
                        200: function (response) {
                            if (response.code == 200) {
                                document.getElementById("accountForm").reset();
                                dataTable.ajax.reload();
                                $('#user-icon').modal('toggle');
                                $.notify({
                                    // options
                                    message: response.message,
                                }, {
                                    // settings
                                    type: 'success',
                                    position: 'absolute',
                                    z_index: 999999,
                                    showProgressbar: true,
                                    delay: 5000

                                });

                            } else {
                                $.notify({
                                    // options
                                    message: 'error while processing request',
                                }, {
                                    // settings
                                    type: 'danger',
                                    position: 'absolute',
                                    z_index: 999999,
                                    showProgressbar: true,
                                    delay: 5000

                                });
                            }
                        },
                        422: function (response) {
                            console.log(response);
                            $.map(response.responseJSON.errors, (error) => {
                                $.notify({
                                    // options
                                    message: error[0],
                                }, {
                                    // settings
                                    type: 'danger',
                                    position: 'absolute',
                                    z_index: 999999,
                                    showProgressbar: true,
                                    delay: 5000

                                });
                            });
                        }
                    },
                })
            })
        });


        function getClientData(id) {
            $.ajax({
                type: "get",
                url: "{{url('client/')}}/" + id,
                success: function (response) {
                    $('#addressShow').css('display', 'none')
                    // $('#saveAdmin').attr('action',response.data.edit_url);
                    $('#client_id').val(response.data.user.id);
                    $('#name').val(response.data.user.name);
                    $('#mobile').val(response.data.user.mobile);
                    $('#phone').val(response.data.user.phone);
                    document.getElementById('blah').src = response.data.user.image_path

                    $('#address').val(response.data.user.address);
                    $('#civil_id').val(response.data.user.civil_id);
                    $('#activity').val(response.client.activity);
                    $('#project_data').val(response.client.project_data);
                    $('#fees').val(response.client.fees);
                    $('#payment_type_id').val(response.client.payment_type_id);
                    if (response.client.payment_type_id !== '') {
                        $('#limit').removeAttr('disabled');
                        $('#limit').val(response.client.limit)
                    }

                    $('#payment_method_id').val(response.client.payment_method_id);
                    if (response.client.payment_method_id !== '') {
                        $('#bank_account').removeAttr('disabled');
                        $('#bank_account').val(response.client.bank_account)
                    }

                },
                onload: function () {
                    $.notify({
                        // options
                        message: 'looding.....',
                    }, {
                        // settings
                        type: 'default',
                        position: 'absolute',
                        z_index: 999999,
                        showProgressbar: true,
                        delay: 5000

                    });
                }
            });
        }

        function setSupervisorId(id) {
            $('#deleteUser').val(id);
        }

        function deleteUser() {
            var id = $('#deleteUser').val();
            $.ajax({
                type: "DELETE",
                url: "{{url('client/')}}/" + id,
                data: {'_token': "{{csrf_token()}}"},
                success: function (response) {
                    $.notify({
                        // options
                        message: response.message,
                    }, {
                        // settings
                        type: 'success',
                        position: 'absolute',
                        z_index: 999999,
                        showProgressbar: true,
                        delay: 5000

                    });
                    dataTable.ajax.reload();
                    $('#exampleModal').modal('toggle');
                },
                onload: function () {
                    $.notify({
                        // options
                        message: 'looding.....',
                    }, {
                        // settings
                        type: 'default',
                        position: 'absolute',
                        z_index: 999999,
                        showProgressbar: true,
                        delay: 5000

                    });
                }
            });
        }

        function getAccountData(id) {
            $.ajax({
                type: "get",
                url: "{{url('client/')}}/" + id,
                success: function (response) {
                    $('#user_id').val(response.data.user.id);
                    $('#username').val(response.data.user.username);
                    $('#role_id').val(response.data.user.role_id);
                    if (response.data.user.password) {
                        $('#password').removeAttr('required');
                    } else {
                        $('#password').attr('required', true);
                    }

                },
                onload: function () {
                    $.notify({
                        // options
                        message: 'looding.....',
                    }, {
                        // settings
                        type: 'default',
                        position: 'absolute',
                        z_index: 999999,
                        showProgressbar: true,
                        delay: 5000

                    });
                }
            });
        }

        function chageStatus(id) {
            $.ajax({
                type: "get",
                url: "{{url('changeStatus/')}}/" + id,
                success: function (response) {

                },
                onload: function () {
                    $.notify({
                        // options
                        message: 'looding.....',
                    }, {
                        // settings
                        type: 'default',
                        position: 'absolute',
                        z_index: 999999,
                        showProgressbar: true,
                        delay: 5000

                    });
                }
            });
        }

        function changeRegion(val) {
            $.ajax({
                type: "get",
                url: "{{url('reigons/')}}/" + val.value,
                success: function (response) {
                    $('#region').html(response)
                },
                onload: function () {
                    $.notify({
                        // options
                        message: 'looding.....',
                    }, {
                        // settings
                        type: 'default',
                        position: 'absolute',
                        z_index: 999999,
                        showProgressbar: true,
                        delay: 5000

                    });
                }
            });
        }


        $('.modal').on('hidden.bs.modal', function (e) {
            document.getElementById("saveClient").reset();
            $('#client_id').val(0);
            document.getElementById('blah').src = ''
        })
    </script>
@endsection
