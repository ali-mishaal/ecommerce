@extends('commonmodule::layouts.master')


@section('content')

    <!-- buttons -->

    <div class="btn-create">
        <button class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#create-vehicle"> <i
                class="icon-plus pr-1"></i> {{ trans('lang.transfer_vehicle') }}
        </button>
    </div>


    @role('driver')
    <div class="btn-create">
        <button class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#request_transfer_vehicle"> <i
                class="icon-plus pr-1"></i> {{ trans('lang.request_vehicle') }}
        </button>
    </div>
    @endrole



    <!-- content -->
    <div class="vehicle-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.transfer_vehicle') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    {{ $dataTable->table(['width' => '100%'], true) }}
                </div>
            </div>
        </div>
    </div>

    </div>


    <!-- Modal Request Transfer vehicle -->
    <div class="modal fade bd-example-modal-lg create-vehicle" id="request_transfer_vehicle" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('lang.transfer_vehicle') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" id="transferVehicleForm" action="{{ route('transfer-vehicle.store') }}" method="post" novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <form class="needs-validation" novalidate="">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="old_driver">{{ trans('lang.old_driver') }}</label>

                                    <select onchange="changeVehicle(this.value,'', 'vehicle_id')" name="old_driver_id" class="form-control custom-select" id="old_driver_id">
                                        <option>{{ trans('lang.choose...') }}</option>
                                        @foreach($oldDriver as $key)
                                            <option value="{{$key->id}}">{{$key->user->name??''}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="car_id">{{ trans('lang.vehicle') }}</label>
                                    <select name="vehicle_id" class="form-control custom-select" id="vehicle_id">
                                        <option>{{ trans('lang.choose...') }}</option>

                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="request_km">{{ trans('lang.km_number') }}</label>
                                    <input class="form-control" id="request_km" type="number" name="request_km"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.km_number')]) }}" required="">
                                    <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.km_number')]) }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">{{ trans('lang.km_image') }}</label>
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="transfer_km_image" name="request_km_image"
                                               data-original-title="" title="">
                                        <label class="custom-file-label" for="transfer_km_image">{{ trans('lang.choose...') }}</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <label for="validationCustom03">{{ trans('lang.vehicle_image') }}</label>
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="transfer_vehicle_image" name="request_vehicle_image"
                                               data-original-title="" title="">
                                        <label class="custom-file-label" for="transfer_vehicle_image">{{ trans('lang.choose') }}</label>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                @role('driver')

                                @else


                                    <div class="col-md-6 mb-3">
                                        <label for="deduction">{{ trans('lang.old_driver_deduction') }}</label>
                                        <input class="form-control" id="deduction" type="number" name="deduction"
                                               placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.old_driver_deduction')]) }}" required="">
                                        <div class="invalid-feedback">Please.</div>
                                    </div>
                                @endrole
                                    <div class="col-md-6 mb-3">
                                        <label for="km_number">{{ trans('lang.new_driver') }}</label>
                                        <input type="hidden" value="{{ auth()->user()->user_id }}" name="driver_id">
                                        <select class="form-control custom-select" id="driver_id" disabled>
                                            <option value="{{ auth()->user()->user_id }}" selected>{{ auth()->user()->name}}</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <label for="floatingTextarea2">{{ trans('lang.note') }}</label>
                                        <textarea class="form-control" placeholder="{{ trans('lang.note') }}" id="note" name="request_note"
                                                  style="height: 80px"></textarea>

                                    </div>
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


    <!-- Modal create vehicle -->
    <div class="modal fade bd-example-modal-lg create-vehicle" id="create-vehicle" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('lang.transfer_vehicle') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" id="transferVehicleForm" action="{{ route('transfer-vehicle.store') }}" method="post" novalidate="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="vehicle_transfer_id" id="vehicle_transfer_id" value="0">

                    <div class="modal-body">
                        <form class="needs-validation" novalidate="">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="old_driver">{{ trans('lang.old_driver') }}</label>
                                    @role('driver')
                                    <input type="hidden" value="{{ auth()->user()->user_id }}" name="old_driver_id">
                                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                                    @else

                                        <select onchange="changeVehicle(this.value,'', 'vehicle_create_id')"  name="old_driver_id" class="form-control custom-select" id="old_driver_id">
                                            <option>{{ trans('lang.choose...') }}</option>
                                            @foreach($oldDriver as $key)
                                                <option value="{{$key->id}}">{{$key->user->name??''}}</option>
                                            @endforeach
                                        </select>
                                        @endrole
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="car_id">{{ trans('lang.vehicle') }}</label>

                                    @role('driver')
                                    <select name="vehicle_id" class="form-control custom-select">
                                        <option>{{ trans('lang.choose...') }}</option>
                                        @foreach($myVehicles as $vehicle)
                                            <option value="{{$vehicle->vehicle->id}}">{{$vehicle->vehicle->vehicle_number}}</option>
                                        @endforeach
                                    </select>

                                    @else
                                        <select name="vehicle_id" class="form-control custom-select" id="vehicle_create_id">
                                            <option>{{ trans('lang.choose...') }}</option>

                                        </select>
                                    @endrole
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="request_km">{{ trans('lang.km_number') }}</label>
                                    <input class="form-control" id="request_km" type="number" name="request_km"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.km_number')]) }}" required="">
                                    <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.km_number')]) }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">{{ trans('lang.km_image') }}</label>
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="request_km_image" name="request_km_image"
                                               data-original-title="" title="">
                                        <label class="custom-file-label" for="request_km_image">{{ trans('lang.choose') }}</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <label for="validationCustom03">{{ trans('lang.vehicle_image') }}</label>
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="request_vehicle_image" name="request_vehicle_image"
                                               data-original-title="" title="">
                                        <label class="custom-file-label" for="request_vehicle_image">{{ trans('lang.choose') }}</label>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                @role('driver')

                                @else


                                    <div class="col-md-6 mb-3">
                                        <label for="deduction">{{ trans('lang.old_driver_deduction') }}</label>
                                        <input class="form-control" id="deduction" type="number" name="deduction"
                                               placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.old_driver_deduction')]) }}" required="">
                                        <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.old_driver_deduction')]) }}</div>
                                    </div>
                                    @endrole
                                    <div class="col-md-6 mb-3">
                                        <label for="km_number">{{ trans('lang.new_driver') }}</label>
                                        <select name="driver_id" class="form-control custom-select" id="driver_id_sup">
                                            <option>{{ trans('lang.choose') }}</option>
                                            @if(auth()->user()->hasRole('driver'))
                                            @foreach($drivers as $key)
                                                <option value="{{$key->id}}">{{$key->user->name??''}}</option>
                                            @endforeach
                                            @endauth
                                        </select>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                        <label for="floatingTextarea2">{{ trans('lang.note') }}</label>
                                        <textarea class="form-control" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.note')]) }}" id="note" name="request_note"
                                                  style="height: 80px"></textarea>

                                    </div>
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





    <!-- Modal approve vehicle -->
    <div class="modal fade popup-delete" id="approveVehicleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveVehicleModalLabel">Approve vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">

                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>Vehicle:</b> <span id="spanVehicle"></span></li>
                        <li class="list-group-item">
                            <b>Picture</b>
                            <img id="picture">
                        </li>
                        <li class="list-group-item">
                            <b>Km image</b>
                            <img id="li_km_image">
                        </li>
                        <li class="list-group-item" id="attach">Attach</li>
                        <li class="list-group-item"><b>Km:</b> <span id="spanKm"></span></li>
                        <li class="list-group-item"><b>Note: </b> <span id="spanNote"></span></li>
                    </ul>

                    <hr>

                    <form class="needs-validation" id="approveVehicle" method="post" novalidate="" enctype="multipart/form-data">
                        @csrf
                        @role('driver')
                        <div id="formData" class="showIfNewDriver">
                            <div class="row" >
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Plate image </label>
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="driver_plate_image" name="driver_plate_image" form="approveVehicle"
                                               data-original-title="" title="">
                                        <label class="custom-file-label" for="driver_plate_image">Choose image</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Km Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="driver_km_image" name="driver_km_image" form="approveVehicle"
                                               data-original-title="" title="">
                                        <label class="custom-file-label" for="driver_km_image">Choose image</label>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('terms.show', 'driver_transfer') }}" target="_blank">Terms And Conditions</a>
                            <br>
                            <div class="form-check form-check-inline m-2" id="terms_div">
                                <input class="form-check-input" type="checkbox" id="terms" value="1" name="terms" form="approveVehicle">
                                <label class="form-check-label" for="terms">Terms and Conditions</label>
                            </div>
                        </div>
                        @endrole

                        <hr>
                        <label>Revert Request</label>
                        <div class="media mb-2">
                            <div class="media-body text-end icon-state switch-outline">
                                <label class="switch">
                                    <input onchange="revertRequest()" type="checkbox" id="revert_toggle">
                                    <span class="switch-state bg-success"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group" id="revert_request_km_div" style="display: none">
                            <label for="revert_request_km">{{ trans('lang.km_number') }}</label>
                            <input class="form-control" id="revert_request_km" type="number" name="revert_request_km"
                                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.km_number')]) }}" required="">
                            <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.km_number')]) }}</div>
                        </div>


                        <div class="showIfNotNewDriver">
                            <div class="form-group" id="revert_km_image_div" style="display:none;">
                                <label for="validationCustom03">{{ trans('lang.km_image') }}</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="supervisor_km_image" name="revert_km_image" form="approveVehicle"
                                           data-original-title="" title="">
                                    <label class="custom-file-label" for="supervisor_km_image">{{ trans('lang.choose') }}</label>
                                </div>
                            </div>
                        </div>

                        @push('scripts')
                            <script>
                                function revertRequest()
                                {
                                    let form = $('#approveVehicle')
                                    let url = form.attr('action')
                                    let dataUrl = form.attr('data-url')
                                    form.attr('action', dataUrl)
                                    form.attr('data-url', url)
                                    $('#terms_div').toggle()
                                    $('#revert_request_km_div').toggle()
                                    $('#revert_km_image_div').toggle()
                                }
                            </script>
                        @endpush

                    </form>
                </div>
                <div class="modal-footer">
                    <button id="acceptVehicleBtn" type="submit" class="btn btn-primary" form="approveVehicle">{{ trans('lang.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.cancel') }}</button>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('scripts')
    {!! $dataTable->scripts() !!}

    <script>
        $('#transferVehicleForm, #approveVehicle').on('submit', function (e) {
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
                            document.getElementById('transferVehicleForm').reset();
                            document.getElementById('approveVehicle').reset();
                            // reset dataTable
                            let aTable = $('#transfervehicle-table').DataTable()
                            aTable.ajax.url(window.location.href).load();


                            $('.modal').modal('hide');
                            notifyMe(response.message, 'success')
                        } else {
                            notifyMe('error while processing request', 'danger')
                        }
                    },
                    422:function (response){
                        $.map(response.responseJSON.errors,(error)=>{
                            notifyMe(error[0], 'danger')
                        });
                    }
                },
            })
        })


        function getTransferVehicleData(id)
        {
            //send ajax to approve vehicle
            $('#approveVehicleModal').modal('toggle')
            $('#TermsConditionsCheckbox').prop('checked', false);
            // $('#acceptVehicleBtn').prop( 'disabled',true)


            $.ajax({
                type:"get",
                url:"{{url('get-transferred-vehicle-data/')}}/"+id,
                success:function (response) {
                    if(response.data.is_new_driver)
                    {
                        $('.showIfNewDriver').show();
                        $('.showIfNotNewDriver').hide();
                    }else{
                        $('.showIfNotNewDriver').show();
                        $('.showIfNewDriver').hide();
                    }



                    if(response.data.is_old_driver)
                    {
                        $('#formData').hide();
                    }else{
                        $('formData').show();
                    }
                    $('#spanVehicle').text(response.data.vehicle.vehicle_number);
                    $('#picture').attr('src', '{{ asset('images/transfer-vehicles/') }}/'+ response.data.request_vehicle_image);
                    $('#li_km_image').attr('src', '{{ asset('images/transfer-vehicles/') }}/'+ response.data.request_km_image);
                    $('#spanKm').text(response.data.request_km);
                    $('#spanNote').text(response.data.request_note);
                    $('#approveVehicle').attr('action', '{{ url('approve-transferred-vehicle') }}/' + response.data.id)
                    $('#approveVehicle').attr('data-url', '{{ url('revert-transferred-vehicle') }}/' + response.data.id)

                    $('#revert_toggle').prop('checked', false)
                    $('#terms_div').show()
                    $('#revert_request_km_div').hide()
                    $('#revert_km_image_div').hide()
                },
                onload:function (){
                    notifyMe('Loading...')
                },
                error: function (error) {
                    notifyMe('something went wrong', 'danger')
                }
            });
        }

        function changeVehicle(id,vehicle, select_id)
        {


            getAllDriversExcept(id);
            $.ajax({
                type:"get",
                url:"{{url('VehiclesType/changeVehicle')}}/"+id+"/"+vehicle,
                success:function (response){
                    $('#' + select_id).html(response)

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


        function getAllDriversExcept(id)
        {
            $.ajax({
                type:"get",
                url: '{{ url('get-drive-except') }}' + '/' + id,
                success: function (response){
                    console.log('success')
                    console.log(typeof(response.data));
                    $('#driver_id_sup option').remove();
                    let drivers = response.data;

                    $('#driver_id_sup').append(`<option value="" disabled selected>Choose...</option>`)
                    for(const item of drivers)
                    {
                        console.log(item.id)
                        $('#driver_id_sup').append(`<option value="${item.id}">${item.name}</option>`)
                    }

                }
            })
        }
    </script>

@endpush
