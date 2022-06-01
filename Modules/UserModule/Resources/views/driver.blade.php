@extends('commonmodule::layouts.master')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/material-design-icon.css')}}">


<div class="btn-create">
    @can('driver.store')
    <button id="buttoncreate" class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#create-driver"> <i
            class="icon-plus pr-1"></i>{{ trans('lang.create_driver') }}</button>
    @endcan
</div>
<div class="driver-page all-pages">
    <div class="card-header">

        <h5>{{ trans('lang.drivers') }}</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">

            <table class="display dataTable no-footer" id="example1" role="grid" aria-describedby="basic-1_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 229px;">{{ trans('lang.name') }}</th>
                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 137.203px;">
                                {{ trans('lang.civil_id') }}
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 174.406px;">
                                {{ trans('lang.phone') }}
                            </th>
                         <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 229px;">{{trans('lang.mobile')}}</th>
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
</div>


<!-- Modal delete item -->
@include('usermodule::partials.modal_delete')

<!-- Modal user icon -->
@include('usermodule::partials.modal_user')



<!-- Modal create driver -->
<div class="modal fade bd-example-modal-lg create-driver" id="create-driver" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('lang.create_driver') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="create-driver">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="saveDriver" action="{{url('driver')}}" method="post" novalidate="" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="driver_id" id="driver_id" value="0">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{ trans('lang.name') }}</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.name')]) }}"
                                required>
                            <div class="valid-feedback">{{ trans('lang.good') }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">{{ trans('lang.civil_id') }}</label>
                            <input class="form-control" id="civil_id" name="civil_id" type="text"
                                placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.civil_id')]) }}" required maxlength="12" minlength="12">
                            <div class="invalid-feedback" id="civil-id-error"></div>
                        </div>

                        <div class="col-md-6  mb-3">
                            <label for="validationCustom03">{{ trans('lang.mobile') }}</label>
                            <input class="form-control" id="mobile" type="number" name="mobile"
                                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.mobile')]) }}" maxlength="8" minlength="8">
                            <div class="invalid-feedback" id="mobile-error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">{{ trans('lang.phone') }}</label>
                            <input class="form-control" id="phone" type="number" name="phone"
                                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.phone')]) }}" maxlength="8" minlength="8">
                            <div class="invalid-feedback" id="phone-error"></div>
                        </div>

                        @include('usermodule::partials.address_inputs')
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="custom-control custom-checkbox mb-2">
                                <input onclick="changedis(this)" value="1" type="checkbox" class="custom-control-input" id="has_sallary" name="has_sallary">
                                <label class="custom-control-label" for="has_sallary">{{ trans('lang.has_salary') }}</label>
                            </div>
                            <input class="form-control" id="sallary" disabled type="number" step="0.001" name="sallary"
                                placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.salary')]) }}" required="" onblur="addCommas(this)">
                            <div class="invalid-feedback" id="salary-error">{{ trans('lang.please', ['attribute' => trans('lang.salary')]) }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="custom-control custom-checkbox mb-2">
                                <input onclick="changedis(this)" value="1" type="checkbox" class="custom-control-input" id="has_commission"
                                    name="has_commission">
                                <label class="custom-control-label" for="has_commission">{{ trans('lang.has_commission') }}</label>
                            </div>
                            <input class="form-control" id="commission" disabled type="number" name="commission" step="0.001"
                                placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.commission')]) }}" required="">
                            <div class="invalid-feedback" id="commission-error"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="custom-control custom-checkbox mb-2">
                                <input onclick="changedis(this)"  value="1" type="checkbox" class="custom-control-input" id="has_company_vehicle"
                                    name="example1">
                                <label class="custom-control-label" for="has_company_vehicle">{{ trans('lang.has_company_vehicle') }}</label>
                            </div>

                                <select disabled  class="custom-select" id="company_vehicle_id" name="company_vehicle_id" required="">
                                <option selected="" value="">{{ trans('lang.choose...') }}</option>
                                @foreach($vehicles as $vehicle)
                                <option value="{{$vehicle->id}}">{{$vehicle->vehicle_number}}</option>
                               @endforeach
                            </select>
                            <div class="invalid-feedback">Please.</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="custom-control custom-checkbox mb-2">
                                <input onclick="changedis(this)"  value="1" type="checkbox" class="custom-control-input" id="has_company_moto"
                                       name="has_moto">
                                <label class="custom-control-label" for="has_company_moto">{{ trans('lang.has_company_moto') }}</label>
                            </div>

                            <select disabled  class="custom-select" id="company_moto_id" name="company_moto_id" required="">
                                <option selected="" value="">{{ trans('lang.choose...') }}</option>
                                @foreach($motos as $item)
                                    <option value="{{$item->id}}">{{$item->vehicle_number}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please.</div>
                        </div>
                    </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="validationCustom03">{{ trans('lang.image') }}</label>
                        <div class="custom-file">
                            <input type="file" class="file-content" id="image" name="image" accept="image/*" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <img class="w-75" id="blah" src="#"/>
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
        $('#buttoncreate').on('click',function (){
            $('#addressShow').css('display','block')
        })
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

                        "url": "{{ url('datatables/driver') }}",
                        "type": "GET",
                        "data": function (d) {
                            var filter_data = $('#filter_form').serialize();
                            d.filter = filter_data                    },

                    },
                    "order": [[0, "desc"]],
                    "columns": [
                        {data: 'name', name: 'user.name'},
                        {data: 'civil_id', name: 'user.civil_id'},
                        {data: 'phone', name: 'phone'},
                        {data: 'mobile', name: 'mobile'},
                        {data: 'status', name: 'status'},
                        {data: 'operations', name: 'operations'},
                    ]
                });


                return  dtvar;
            }

            $('#saveDriver').on('submit',function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('image', $('#image')[0].files[0]);
                $.ajax({
                    type:'post',
                    url:$(this).attr('action'),
                    data:formData,
                    processData: false,
                    contentType: false,
                    statusCode: {
                        200:function (response) {
                            if (response.code == 200) {
                                document.getElementById("saveDriver").reset();
                                dataTable.ajax.reload();
                                $('#create-driver').modal('toggle');
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


        function getDriverData(id)
        {
            $.ajax({
                type:"get",
                url:"{{url('driver/')}}/"+id,
                success:function (response){
                    $('#addressShow').css('display','none')
                    // $('#saveAdmin').attr('action',response.data.edit_url);
                    $('#driver_id').val(response.data.user.id);
                    $('#name').val(response.data.user.name);
                    $('#mobile').val(response.data.user.mobile);
                    $('#phone').val(response.data.user.phone);
                    $('#address').val(response.data.user.address);
                    $('#civil_id').val(response.data.user.civil_id);
                    document.getElementById('blah').src = response.data.user.image_path

                    if(response.data.has_sallary==1)
                    {
                        $('#has_sallary').attr('checked','checked');
                        $('#sallary').removeAttr('disabled');
                        $('#sallary').val(response.data.sallary)
                    }

                    if(response.data.has_commission==1)
                    {
                        $('#has_commission').attr('checked','checked');
                        $('#commission').removeAttr('disabled');
                        $('#commission').val(response.data.commission)
                    }

                    if(response.data.has_company_vehicle==1)
                    {
                        $('#has_company_vehicle').attr('checked','checked');
                        $('#company_vehicle_id').removeAttr('disabled');
                        $('#company_vehicle_id').val(response.data.vehicle_id)
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

        function setSupervisorId(id)
        {
            $('#deleteUser').val(id);
        }
        function deleteUser()
        {
            var id = $('#deleteUser').val();
            $.ajax({
                type:"DELETE",
                url:"{{url('driver/')}}/"+id,
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
                url:"{{url('driver/')}}/"+id,
                success:function (response){
                    $('#user_id').val(response.data.user.id);
                    $('#username').val(response.data.user.username);
                    $('#role_id').val(response.data.user.role_id);
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

           function chageStatus(id)
           {
               $.ajax({
                   type:"get",
                   url:"{{url('changeStatus/')}}/"+id,
                   success:function (response){

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

           function addCommas(that)
           {
               var nStr = $(that).val();
               nStr = nStr.replaceAll(',','');
               // nStr += '';
               // x = nStr.split('.');
               // x1 = x[0];
               // x2 = x.length > 1 ? '.' + x[1] : '';
               // var rgx = /(\d+)(\d{3})/;
               // while (rgx.test(x1)) {
               //     x1 = x1.replace(rgx, '$1' + ',' + '$2');
               // }
               console.log(nStr)
               var new_val = new Intl.NumberFormat().format(nStr);
               $(that).val( new_val );
           }

           function changeRegion(val) {
               $.ajax({
                   type: "get",
                   url: "{{url('reigons/')}}/" + val.value,
                   success: function(response) {
                       $('#region').html(response)
                   },
                   onload: function() {
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
            document.getElementById("saveDriver").reset();
            $('#driver_id').val(0);

            $('#has_sallary').removeAttr('checked');
            $('#sallary').attr('disabled', 'disabled');
            $('#sallary').val()

            $('#has_commission').removeAttr('checked');
            $('#commission').attr('disabled', 'disabled');
            $('#commission').val()

            $('#has_company_vehicle').removeAttr('checked');
            $('#company_vehicle_id').attr('disabled', 'disabled');
            $('#company_vehicle_id').val()

            document.getElementById('blah').src = ''
        })
    </script>
@endsection
