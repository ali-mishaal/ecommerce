@extends('commonmodule::layouts.master')


@section('content')

    <!-- buttons -->

    <div class="btn-create">
        <button class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#create-vehicle"> <i
                class="icon-plus pr-1"></i> {{ auth()->user()->hasRole('driver') ? 'Request vehicle' : 'Attach Vehicle' }}
        </button>
    </div>



    <!-- content -->
    <div class="vehicle-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.attach_vehicle') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    {{ $dataTable->table(['width' => '100%'], true) }}
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
                    <h5 class="modal-title">{{ trans('lang.attach_vehicle') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="attachVehicleForm" action="{{ route('attach-vehicle.store') }}" method="post" novalidate="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_id">{{ trans('lang.vehicle') }}</label>
                                <select name="vehicle_id" class="form-control custom-select" id="vehicle_id">
                                    <option>{{ trans('lang.choose...') }}</option>
                                    @foreach($vehicles as $key)
                                        <option value="{{$key->id}}">{{$key->vehicle_number}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">{{ trans('lang.vehicle_image') }} </label>
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="request_vehicle_image" name="request_vehicle_image"
                                           data-original-title="" title="">
                                    <label class="custom-file-label" for="request_vehicle_image">{{ trans('lang.choose') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="request_km">{{ trans('lang.km_number') }}</label>
                                <input class="form-control" id="request_km" type="number" name="request_km"
                                       placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.km_number')]) }}" required="">
                                <div class="invalid-feedback">{{ trans('lang.placeholder', ['attribute' => trans('lang.km_number')]) }}</div>
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
                                <label for="driver_id">{{ trans('lang.driver') }}</label>
                                <select name="driver_id" class="form-control custom-select" id="driver_id"
                                {{ auth()->user()->hasRole('driver') ? 'disabled' : ''}}
                                >
                                    <option>{{ trans('lang.choose...') }}</option>
                                    @role('driver')
                                        <option value="{{ auth()->user()->user_id }}" selected>{{ auth()->user()->name }}</option>
                                    @else
                                        @foreach($drivers as $key)
                                            <option value="{{$key->id}}">{{$key->user->name??''}}</option>
                                        @endforeach

                                    @endrole
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <label for="floatingTextarea2">{{ trans('lang.note') }}</label>
                                    <textarea name="request_note" class="form-control" placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.note')]) }}" id="note"
                                              style="height: 80px"></textarea>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="attachVehicleForm">{{ trans('lang.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.close') }}</button>
                </div>

            </div>
        </div>
    </div>




    <!-- Modal approve vehicle -->
    <div class="modal fade popup-delete" id="approveVehicleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveVehicleModalLabel">{{ trans('lang.accept_vehicle') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">

                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>{{ trans('lang.vehicle') }}:</b> <span id="spanVehicle"></span></li>
                        <li class="list-group-item">
                            <b>{{ trans('lang.picture') }}</b>
                            <img id="picture">
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('lang.km_number') }}</b>
                            <img id="li_km_image">
                        </li>
                        <li class="list-group-item" id="attach">{{ trans('lang.attach') }}</li>
                        <li class="list-group-item"><b>{{ trans('lang.km') }}:</b> <span id="spanKm"></span></li>
                        <li class="list-group-item"><b>{{ trans('lang.note') }}: </b> <span id="spanNote"></span></li>
                    </ul>

                    <hr>

                    <form class="needs-validation" id="approveVehicle" method="post" novalidate="" enctype="multipart/form-data">
                        @csrf
                    @role('driver')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">{{ trans('lang.plate_image') }}</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="driver_plate_image" name="driver_plate_image" form="approveVehicle"
                                           data-original-title="" title="">
                                    <label class="custom-file-label" for="driver_plate_image">{{ trans('lang.choose') }}</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">{{ trans('lang.km_image') }}</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="driver_km_image" name="driver_km_image" form="approveVehicle"
                                           data-original-title="" title="">
                                    <label class="custom-file-label" for="driver_km_image">{{ trans('lang.choose') }}</label>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('terms.show', 'driver_attach') }}" target="_blank">{{ trans('lang.terms') }}</a>
                        <br>
                        <div     class="form-check form-check-inline m-2" id="terms_div">
                            <input class="form-check-input" type="checkbox" id="terms" value="1" name="terms" form="approveVehicle">
                            <label class="form-check-label" for="terms">{{ trans('lang.terms') }}</label>
                        </div>


                    @endrole

                        <hr>
                        <label>{{ trans('lang.revert_request') }}</label>
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

                        @if(!auth()->user()->hasRole('driver'))
                            <div class="form-group" id="revert_km_image_div" style="display:none;">
                                <label for="validationCustom03">{{ trans('lang.km_image') }}</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="supervisor_km_image" name="supervisor_km_image" form="approveVehicle"
                                           data-original-title="" title="">
                                    <label class="custom-file-label" for="supervisor_km_image">{{ trans('lang.choose') }}</label>
                                </div>
                            </div>
                        @endif

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
                    <button id="acceptVehicleBtn" type="submit" class="btn btn-primary" form="approveVehicle">{{ trans('lang.accept_vehicle') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.cancel') }}</button>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('scripts')
    {!! $dataTable->scripts() !!}

    <script>
        $('#attachVehicleForm, #approveVehicle').on('submit', function (e) {
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
                            document.getElementById('attachVehicleForm').reset();
                            document.getElementById('approveVehicle').reset();
                            // reset dataTable
                            let aTable = $('#attachvehicle-table').DataTable()
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


        function getAttachVehicleData(id)
        {
            //send ajax to approve vehicle
            $('#approveVehicleModal').modal('toggle')
            $('#TermsConditionsCheckbox').prop('checked', false);
            $('#terms_div').show()
            $('#revert_request_km_div').hide()
            $('#revert_toggle').prop('checked', false);


            // $('#acceptVehicleBtn').prop( 'disabled',true)


            $.ajax({
                type:"get",
                url:"{{url('get-attached-vehicle-data/')}}/"+id,
                success:function (response) {
                    $('#spanVehicle').text(response.data.vehicle.vehicle_number);
                    $('#picture').attr('src', '{{ asset('images/attach-vehicles/') }}/'+ response.data.request_vehicle_image);
                    $('#li_km_image').attr('src', '{{ asset('images/attach-vehicles/') }}/'+ response.data.request_km_image);
                    $('#spanKm').text(response.data.request_km);
                    $('#spanNote').text(response.data.request_note);
                    $('#approveVehicle').attr('action', '{{ url('approve-attached-vehicle') }}/' + response.data.id)
                    $('#approveVehicle').attr('data-url', '{{ url('revert-attached-vehicle') }}/' + response.data.id)

                    $('#revert_toggle').prop('checked', false)
                    $('#terms_div').show()
                    $('#revert_request_km_div').hide()
                    $('#revert_km_image_div').hide()
                },
                onload:function (){
                    notifyMe('Loading...')
                },
                error: function (error) {
                    notifyMe('{{ trans('lang.something_went_wrong') }}', 'danger')
                }
            });
        }
    </script>

@endpush
