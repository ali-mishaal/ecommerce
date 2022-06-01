@extends('commonmodule::layouts.master')

@section('content')

    <div class="card-header">
        <h5>{{ trans('lang.orders') }}</h5>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- content -->
    <div class="vehicle-page all-pages">

        <div class="card-body">
            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                <li class="nav-item ct-tab-btn">
                    <a class="nav-link" href="{{ route('orders.index') }}" role="tab">
                        <i class="icofont icofont-ui-home"></i>{{ trans('lang.all') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.create') }}" role="tab">
                        <i class="icofont icofont-man-in-glasses"></i>{{ trans('lang.create') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.createQ') }}" role="tab">
                        <i class="icofont icofont-user-male"></i>{{ trans('lang.createQ') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="#" role="tab">
                        <i class="icofont icofont-user-male"></i>{{ trans('lang.edit_order') }}
                    </a>
                </li>
            </ul>
            <div class="table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    <form method="post" action="{{ route('orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="client_id">{{ trans('lang.client') }}</label>
                                    <select name="client_id" id="client_id"
                                            class="form-control select2 @error('client_id') is-invalid @enderror">
                                        <option disabled selected>{{ trans('lang.search_by_name_or_mobile') }}</option>
                                        @foreach($clients as $client)

                                            <option value="{{ $client->id }}"
                                                    data-user_id="{{ $client->user->id }}"
                                                    title="{{ $client->user->mobile }}"
                                                    @if(old('client_id')==$client->id)
                                                        selected
                                                    @elseif($client->id == $order->client_id)
                                                        selected
                                                    @endif
                                            >{{ $client->user->name??'' }}</option>
                                        @endforeach
                                    </select>

                                    @error('client_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">

                                    <label for="validationCustom02">{{ trans('lang.address_name') }}</label>
                                    <select id="address_name" name="address_name" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">

                                    <label for="add1">{{ trans('lang.government') }}</label>
                                    <select onchange="changeRegion(this)" class="custom-select" id="government" name="government" required="">
                                        <option>{{ trans('lang.choose...') }}</option>
                                        @foreach($governments as $key)
                                            <option value="{{$key->id}}"
                                            @if(old('government') == $key->id)
                                                selected
                                            @elseif($order->government == $key->id)
                                                selected
                                            @endif
                                            >{{$key->name_en}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="add2">{{ trans('lang.region') }}</label>
                                    <select class="custom-select" id="region" name="region" required="">
                                        <option>{{ trans('lang.choose...') }}</option>

                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}" {{ $order->region == $region->id ? 'selected' : '' }}>
                                                {{ $region->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ trans('lang.widget') }}</label>
                                    <input class="form-control" id="widget" name="widget" type="text"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.widget')]) }}" value="{{ old('widget')  ?? $order->widget }}">
                                </div>

                                @error('widget')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ trans('lang.street') }}</label>
                                    <input class="form-control" id="street" name="street" type="text"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.street')]) }}" value="{{ old('street') ?? $order->street }}">
                                </div>

                                @error('street')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ trans('lang.avenue') }}</label>
                                    <input class="form-control" id="avenue" name="avenue" type="text"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.avenue')]) }}" value="{{ old('avenue') ?? $order->avenue }}">
                                </div>

                                @error('avenue')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">home_number</label>
                                    <input class="form-control" id="home_number" name="home_number" type="number"
                                           placeholder="Enter address" value="{{ old('home_number') ?? $order->home_number }}">
                                </div>

                                @error('home_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ trans('lang.floor') }}</label>
                                    <input class="form-control" id="floor" name="floor" type="number"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.floor')]) }}" value="{{ $order->floor ?? $order->floor }}">
                                </div>

                                @error('floor')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ trans('lang.flat') }}</label>
                                    <input class="form-control" id="flat" name="flat" type="number"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.flat')]) }}" value="{{ old('flat') ?? $order->flat }}">
                                </div>

                                @error('flat')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="mobile">{{ trans('lang.mobile') }}</label>
                                    <input type="text" id="mobile"
                                           class="form-control @error('mobile') is-invalid @enderror"
                                           value="{{ old('mobile') ?? $order->mobile }}"
                                           name="mobile">

                                    <div class="invalid-feedback" id="mobile-error">
                                        @error('mobile') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="phone">{{ trans('lang.phone') }}</label>
                                    <input type="text" id="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') ?? $order->phone }}"
                                           name="phone">



                                    <div class="invalid-feedback" id="mobile-error">
                                        @error('phone') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="supervisor_id">{{ trans('lang.supervisor') }}</label>
                                    <input type="hidden" value="{{ auth()->user()->user_id }}" name="supervisor_id">
                                    <input class="form-control" type="text" value="{{ auth()->user()->name }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('lang.amountu') }}</label>
                                    <input type="number" step="0.01"
                                           class="form-control @error('amount') is-invalid @enderror" name="amount"
                                           value="{{ old('amount') ?? $order->amount }}">
                                    @error('amount')
                                    <span class="invalid-feedback">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('lang.amount_taken_by') }}</label>
                                    <select name="amount_taken_by" class="form-control">
                                        <option value="" disabled selected>{{ trans('lang.choose') }}</option>
                                        <option value="client"
                                        @if(old('amount_taken_by') == 'client')
                                            selected
                                        @elseif($order->amount_taken_by)
                                            selected
                                        @endif
                                        >{{ trans('lang.client') }}</option>


                                        <option value="supervisor"
                                        @if(old('amount_taken_by') == 'supervisor')
                                        selected
                                        @elseif($order->amount_taken_by == 'supervisor')
                                        selected
                                        @endif
                                            >{{ trans('lang.supervisor') }}</option>


                                        <option value="driver"
                                        @if(old('amount_taken_by') == 'driver')
                                        selected
                                        @elseif($order->amount_taken_by == 'driver')
                                        selected
                                        @endif
                                        >{{ trans('lang.driver') }}</option>

                                    </select>
                                    @error('amount_taken_by')
                                    <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('lang.fees') }}</label>
                                    <input type="number" step="0.01"
                                           class="form-control @error('order_fees') is-invalid @enderror"
                                           name="order_fees"
                                           value="{{ old('order_fees') ?? $order->order_fees }}">
                                    @error('order_fees')
                                    <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('lang.fees_taken_by') }}</label>
                                    <select name="order_fees_taken_by" class="form-control">
                                        <option value="" disabled selected>{{ trans('lang.choose') }}</option>
                                        <option value="client"
                                        @if(old('order_fees_taken_by') == 'client')
                                        selected
                                        @elseif($order->order_fees_taken_by == 'client')
                                        selected
                                        @endif
                                        >{{ trans('lang.client') }}</option>


                                        <option value="supervisor"
                                        @if(old('order_fees_taken_by') == 'supervisor')
                                        selected
                                        @elseif($order->order_fees_taken_by == 'supervisor')
                                        selected
                                        @endif
                                        >{{ trans('lang.supervisor') }}</option>



                                        <option value="driver"
                                        @if(old('order_fees_taken_by') == 'driver')
                                            selected
                                        @elseif($order->order_fees_taken_by == 'driver')
                                            selected
                                        @endif
                                        >{{ trans('lang.driver') }}</option>

                                    </select>
                                    @error('order_fees_taken_by')
                                    <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div>
                                    <label class="d-block" for="chk-ani">
                                        <input class="checkbox_animated" id="chk-ani" type="checkbox" checked>
                                        {{ trans('lang.is_urgent') }}
                                    </label>
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('lang.delivery_time') }}</label>
                                    <input type="datetime-local"
                                           class="form-control @error('delivery_time') is-invalid @enderror"
                                           name="delivery_time" value="{{ \Carbon\Carbon::parse(old('delivery_time') ?? $order->delivery_time)->toDateTimeLocalString() }}">
                                    @error('delivery_time')
                                    <span class="invalid-feedback">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('lang.customer_mobile') }}</label>
                                    <input type="text"
                                           class="form-control @error('customer_mobile') is-invalid @enderror"
                                           name="customer_mobile" id="c_mobile" value="{{ old('customer_mobile') ?? $order->customer_mobile }}">
                                    <div class="invalid-feedback" id="c_mobile-error">
                                        @error('customer_mobile') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('lang.customer_name') }}</label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                           name="customer_name" value="{{ old('customer_name') ?? $order->customer_name }}">
                                    @error('customer_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="add1">{{ trans('lang.customer_government') }}</label>
                                    <select onchange="changeCustomerRegion(this)" class="custom-select" id="cgovernment" name="cgovernment" required="">
                                        <option>{{ trans('lang.choose') }}</option>
                                        @foreach($governments as $key)
                                            <option value="{{$key->id}}"

                                            @if(old('cgovernment') == $key->id)
                                            selected
                                            @elseif($order->cgovernment == $key->id)
                                            selected
                                            @endif
                                            >{{$key->name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('cgovernment')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="add2">{{ trans('lang.region') }}</label>
                                    <select class="custom-select" id="cregion" name="cregion">
                                        <option>{{ trans('lang.choose') }}</option>
                                        @foreach($cregions as $region)
                                            <option value="{{ $region->id }}" {{ $order->cregion == $region->id ? 'selected' : '' }}>
                                                {{ $region->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('cregion')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ trans('lang.customer_widget') }}</label>
                                    <input class="form-control" id="cwidget" name="cwidget" type="text"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.customer_widget')]) }}" value="{{ old('cwidget')  ?? $order->cwidget }}">
                                </div>

                                @error('cwidget')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ trans('lang.customer_street') }}</label>
                                    <input class="form-control" id="cstreet" name="cstreet" type="text"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.customer_street')]) }}" value="{{ old('cstreet') ?? $order->cstreet }}">
                                </div>

                                @error('cstreet')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ trans('lang.customer_avenue') }}</label>
                                    <input class="form-control" id="cavenue" name="cavenue" type="text"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.customer_avenue')]) }}" value="{{ old('cavenue') ?? $order->cavenue }}">
                                </div>

                                @error('cavenue')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ trans('lang.customer_home_number') }}</label>
                                    <input class="form-control" id="chome_number" name="chome_number" type="number"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.customer_home_number')]) }}" value="{{ old('chome_number') ?? $order->chome_number }}">
                                </div>

                                @error('chome_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ trans('lang.customer_floor') }}</label>
                                    <input class="form-control" id="cfloor" name="cfloor" type="number"
                                           placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.customer_floor')]) }}" value="{{ old('cfloor') ?? $order->cfloor }}">
                                </div>

                                @error('cfloor')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>{{ trans('lang.from_client_to_customer') }}</label>
                                    <input type="hidden" value="1" name="is_from_client" id="is_from_client">
                                    <div class="media mb-2">
                                        <div class="media-body text-end icon-state switch-outline">
                                            <label class="switch">
                                                <input onchange="toggleDescription()" type="checkbox" checked>
                                                <span class="switch-state bg-success"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group d-none" id="description">
                                    <label>{{ trans('lang.description') }}</label>
                                    <textarea class="form-control" name="description" rows="6"></textarea>

                                    @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group float-right">
                                    <button type="submit" id="submit" class="btn btn-primary btn-sm">{{ trans('lang.save') }}</button>
                                    <a type="button" href="{{ route('orders.index') }}"
                                       class="btn btn-secondary btn-sm">{{ trans('lang.cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')

    <script>
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

        function changeCustomerRegion(val) {
            $.ajax({
                type: "get",
                url: "{{url('reigons/')}}/" + val.value,
                success: function(response) {
                    $('#cregion').html(response)
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

        function changeRegionBySelected(govern,region) {
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

        @if(session()->has('message'))
        notifyMe('{{ session()->get('message') }}', 'success')
        @endif

        function toggleDescription() {
            $('#description').toggleClass('d-none');
            $('#is_from_client').val($('#is_from_client').val() == 1 ? 0 : 1);
        }


        $('#client_id').on('change', function () {
            let id = $(this).children('option:selected').data('user_id')
            $.ajax({
                type: 'get',
                url: '{{ url('orders/get-client-data') }}' + '/' + id,
                success: function (response) {

                    $('#address_name option').remove();
                    $('#address_name').append(`<option disabled selected value="">Choose Address ...</option>`)

                    Object.keys(response).forEach(function (key){
                        $('#address_name').append(`<option value="${ response[key].id }">${ response[key].name }</option>`)
                    })
                },
                error: function (errors) {
                    notifyMe('something went wrong', 'danger')
                },
            })
        })

        $('#address_name').on('change', function (){
            let id = $(this).val()
            $.ajax({
                type: 'get',
                url: '{{ url('orders/get-client-address') }}' + '/' + id,
                success:function (response){
                    changeRegionBySelected(response.government,response.region)
                    $('#government').val(response.government)
                    $('#widget').val(response.widget)
                    $('#street').val(response.street)
                    $('#avenue').val(response.avenue)
                    $('#home_number').val(response.home_number)
                    $('#floor').val(response.floor)
                    $('#flat').val(response.flat)
                    $('#phone').val(response.phone)
                    $('#mobile').val(response.mobile)

                }
            })
        })

        $('.select2').select2({
            placeholder: "search by phone or name id",
            allowClear: true,
            matcher:function(params, data){
                if($.trim(params.term) === ''){
                    return data;
                }

                if (data.element.getAttribute('title'))
                {
                    if(data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1 || data.element.getAttribute('title').indexOf(params.term) > -1)
                    {
                        return data;
                    }
                }

                return null;
            }
        })

    </script>

@endpush
