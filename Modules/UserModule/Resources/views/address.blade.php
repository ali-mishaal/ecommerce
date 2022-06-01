@extends('commonmodule::layouts.master')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/material-design-icon.css')}}">


<div class="btn-create">
        <button id="buttoncreate" class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#edit-addresses"> <i
                class="icon-plus pr-1"></i> Create address
        </button>

</div>
<div class="administrator-page all-pages">
    <div class="card-body">
        <h4 class="mb-4">Addresses</h4>
        <div class="row">
            @foreach($address as $key)
            <div class="col-md-4 col-sm-6 col-xs-12 ">
                <div class="card" style="border: 1px solid #ccc !important; border-radius: 10px !important">
                    <div class="card-body">
                        <p class="font-weight-bold">{{ trans('lang.address_name') }}: <span class="font-weight-normal">{{$key->name}}</span></p>
                        <p class="font-weight-bold">{{ trans('lang.government') }}: <span class="font-weight-normal">{{$key->governmentt->name_en}}</span></p>
                        <p class="font-weight-bold">{{ trans('lang.region') }}: <span class="font-weight-normal">{{$key->regionn->name_en}}</span></p>
                        <p class="font-weight-bold">{{ trans('lang.widget') }}: <span class="font-weight-normal">{{$key->widget}}</span></p>
                        <p class="font-weight-bold">{{ trans('lang.street') }}: <span class="font-weight-normal">{{$key->street}}</span></p>
                        <p class="font-weight-bold">{{ trans('lang.avenue') }}: <span class="font-weight-normal">{{$key->avenue}}</span></p>
                        <p class="font-weight-bold">{{ trans('lang.home_number') }}: <span class="font-weight-normal">{{$key->home_number}}</span></p>
                        <p class="font-weight-bold">{{ trans('lang.floor') }}: <span class="font-weight-normal">{{$key->floor}}</span></p>
                        <p class="font-weight-bold">{{ trans('lang.flat') }}: <span class="font-weight-normal">{{$key->flat}}</span></p>

                        <a href="#"
                           data-id="{{$key->id}}"
                           data-name="{{$key->name}}"
                           data-government="{{$key->government}}"
                           data-region="{{$key->region}}"
                           data-widget="{{$key->widget}}"
                           data-street="{{$key->street}}"
                           data-avenue="{{$key->avenue}}"
                           data-home_number="{{$key->home_number}}"
                           data-floor="{{$key->floor}}"
                           data-flat="{{$key->flat}}"
                           class="btn btn-primary edit-address"  data-toggle="modal" data-target="#edit-addresses">{{ trans('lang.edit') }}</a>

                        <a class="btn btn-danger delete-address" data-id="{{$key->id}}" href="#" data-toggle="modal"
                           data-target=".popup-delete">
                            <i class="mdi mdi-delete-outline mr-1"></i>{{ trans('lang.delete') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="modal fade popup-delete" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.confirm_delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <input type="hidden" id="deleteItem">
            </div>
            <div class="modal-body">
                {{ trans('lang.confirm_delete_message') }}
            </div>
            <div class="modal-footer">
                <button type="button" onclick="deleteAddress()" class="btn btn-primary">{{ trans('lang.yes_i_am_sure') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.cancel') }}</button>

            </div>
        </div>
    </div>
</div>


<!-- Modal create Addresses -->
<div class="modal fade bd-example-modal-lg edit-addresses" id="edit-addresses" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('lang.edit_address') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="saveAdmin" action="{{url('saveAddress')}}" method="post" novalidate=""
                enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="{{$id}}">
                    <input type="hidden" name="id" id="id" value="{{$id}}">
                    <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">{{ trans('lang.address_name') }}</label>
                                    <input class="form-control" id="addressName" name="addressName" type="text"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.address_name')]) }}" required="" data-original-title="" title="">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="add1">{{ trans('lang.government') }}</label>
                                    <select onchange="changeRegion(this.value)" class="custom-select" id="government" name="government" required="">
                                        <option>{{ trans('lang.choose...') }}</option>
                                        @foreach($goverments as $key)
                                            <option value="{{$key->id}}">{{$key->name_en}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.government')]) }}.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="add2">{{ trans('lang.region') }}</label>
                                    <select class="custom-select" id="region" name="region" required="">
                                        <option>{{ trans('lang.choose') }}</option>

                                    </select>
                                    <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.region')]) }}.</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">{{ trans('lang.widget') }}</label>
                                    <input class="form-control" id="widget" name="widget" type="text"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.widget')]) }}" required="" data-original-title="" title="">
                                    <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">{{ trans('lang.street') }}</label>
                                    <input class="form-control" id="street" name="street" type="text"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.street')]) }}" required="" data-original-title="" title="">
                                    <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">{{ trans('lang.avenue') }}</label>
                                    <input class="form-control" id="avenue" name="avenue" type="text"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.avenue')]) }}" required="" data-original-title="" title="">
                                    <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">{{ trans('lang.home_number') }}</label>
                                    <input class="form-control" id="home_number" name="home_number" type="number"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.home_number')]) }}" required="" data-original-title="" title="">
                                    <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">{{ trans('lang.floor') }}</label>
                                    <input class="form-control" id="floor" name="floor" type="number"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.floor')]) }}" required="" data-original-title="" title="">
                                    <div class="valid-feedback">{{ trans('lang.good') }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">{{ trans('lang.flat') }}</label>
                                    <input class="form-control" id="flat" name="flat" type="number"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.flat')]) }}" required="" data-original-title="" title="">
                                    <div class="valid-feedback">{{ trans('lang.good') }}</div>
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

<!-- Modal Edit Addresses -->


@endsection
@section('js')
<script>
    $('#buttoncreate').on('click',function (){
        document.getElementById('saveAdmin').reset()
        $('#id').val(0)
    })

    $('.delete-address').on('click',function (){
        $('#deleteItem').val($(this).data('id'))
    })

    function deleteAddress() {
        var id = $('#deleteItem').val();
        $.ajax({
            type: "get",
            url: "{{url('deleteAddress/')}}/" + id,
            success: function(response) {
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
                setTimeout(function(){ location.reload() }, 3000);
                $('#exampleModal').modal('toggle');
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

    $('.edit-address').on('click',function (){
        $('#id').val($(this).data('id'))
        $('#addressName').val($(this).data('name'))
        $('#government').val($(this).data('government'))
        changeRegionbyselected($(this).data('government'),$(this).data('region'))

        $('#widget').val($(this).data('widget'))
        $('#street').val($(this).data('street'))
        $('#avenue').val($(this).data('avenue'))
        $('#home_number').val($(this).data('home_number'))
        $('#floor').val($(this).data('floor'))
        $('#flat').val($(this).data('flat'))
    })

    function changeRegion(val) {
        $.ajax({
            type: "get",
            url: "{{url('reigons/')}}/" + val,
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

    function changeRegionbyselected(govern,region) {
        $.ajax({
            type: "get",
            url: "{{url('getreigons/')}}/" + govern +'/'+region,
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

    $('#saveAdmin').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            statusCode: {
                200: function(response) {
                    if (response.code == 200) {
                        document.getElementById("saveAdmin").reset();
                        $('#edit-addresses').modal('toggle');
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

                        setTimeout(function(){ location.reload() }, 3000);


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
                422: function(response) {
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
</script>
@endsection
