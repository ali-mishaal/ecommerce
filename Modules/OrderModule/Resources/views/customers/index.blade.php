@extends('commonmodule::layouts.master')

@section('content')

    @can('customers.store')
    <div class="btn-create">
        <button  class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#createCustomerModal">
            <i class="icon-plus pr-1"></i> {{ trans('lang.create_customer') }}
        </button>
    </div>
    @endcan

    <!-- content -->
    <div class="customer-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.customers_table') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>

    </div>


    @can('customers.store')
    {{--  create modal  --}}

    <x-modal modal-id="createCustomerModal" :title="trans('lang.create_customer')" form-id="createCustomerForm">
        <form action="{{ route('customers.store') }}" id="createCustomerForm" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-lg-6">
                    <h5 for="name">{{ trans('lang.name') }}</h5>
                    <input type="text" class="form-control" name="name" minlength="2">
                </div>

                <div class="form-group col-lg-6">
                    <h5 for="mobile">{{ trans('lang.customer_mobile') }}</h5>
                    <input type="text" class="form-control" name="mobile" minlength="2">
                </div>
            </div>
            @php($goverments = $governments)
            @include('usermodule::partials.address_inputs')


        </form>
    </x-modal>

    @endcan


    @can('customers.update')
    {{--  edit modal  --}}
    <x-modal modal-id="editCustomerModal" :title="trans('lang.edit_customer')" form-id="editCustomerForm">
        <form action="" id="editCustomerForm" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name">{{ trans('lang.name') }}</label>
                <input id="edit_name" type="text" class="form-control" name="name" minlength="2">
            </div>

            <div class="form-group">
                <label for="mobile">{{ trans('lang.mobile') }}</label>
                <input id="edit_mobile" type="text" class="form-control" name="mobile" >
            </div>


            <div class="form-group">
                <label for="address_name">{{ trans('lang.address_name') }}</label>
                <input id="edit_address_name" type="text" class="form-control" name="address_name" >
            </div>

            <div class="form-group">
                <label for="government">{{ trans('lang.government') }}</label>
                <select id="edit_government_id" name="government_id" class="form-control">
                    <option value="" disabled selected>{{ trans('lang.choose...') }}</option>
                    @foreach($governments as $gov)
                        <option value="{{ $gov->id }}">{{ $gov->name_en }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="region">{{ trans('lang.region') }}</label>
                <select id="edit_region_id" name="region_id" class="form-control">
                    <option value="" disabled selected>{{ trans('lang.choose...') }}</option>
                </select>
            </div>


            <div class="form-group">
                <label for="widget">{{ trans('lang.widget') }}</label>
                <input id="edit_widget" type="text" class="form-control" name="widget">
            </div>

            <div class="form-group">
                <label for="street">{{ trans('lang.street') }}</label>
                <input id="edit_street" type="text" class="form-control" name="street">
            </div>

            <div class="form-group">
                <label for="avenue">{{ trans('lang.avenue') }}</label>
                <input id="edit_avenue" type="text" class="form-control" name="avenue">
            </div>

            <div class="form-group">
                <label for="home_number">{{ trans('lang.home_number') }}</label>
                <input id="edit_home_number" type="text" class="form-control" name="home_number">
            </div>


            <div class="form-group">
                <label for="floor">{{ trans('lang.floor') }}</label>
                <input id="edit_floor" type="number" class="form-control" name="floor">
            </div>

            <div class="form-group">
                <label for="flat">{{ trans('lang.flat') }}</label>
                <input id="edit_flat" type="number" class="form-control" name="flat">
            </div>

        </form>
    </x-modal>
    @endcan


    @can('customers.destroy')
    <x-modal modal-id="deleteCustomerModal" :title="trans('lang.delete_customer')" form-id="deleteCustomerForm" save-text="{{ trans('lang.delete') }}">
        <form action="" id="deleteCustomerForm" method="post">
            @csrf
            @method('delete')
            <p>{{ trans('lang.confirm_delete_message') }}</p>
        </form>
    </x-modal>
    @endcan



@endsection

@section('js')
    {!! $dataTable->scripts() !!}
@endsection


@push('scripts')
    <script>
        function editCustomer(url, get_url)
        {
            $.ajax({
                url: get_url,
                type: 'get',
                success: function (customer) {
                    changeRegionBySelected(customer.government_id,customer.region_id)
                    $('#editCustomerForm').attr('action', url)
                    $('#edit_name').val(customer.name)
                    $('#edit_mobile').val(customer.mobile)
                    $('#edit_address_name').val(customer.address_name)
                    $('#edit_government_id').val(customer.government_id)
                    $('#edit_widget').val(customer.widget)
                    $('#edit_street').val(customer.street)
                    $('#edit_avenue').val(customer.avenue)
                    $('#edit_home_number').val(customer.home_number)
                    $('#edit_floor').val(customer.floor)
                    $('#edit_flat').val(customer.flat)
                    $('#editCustomerModal').modal('show')
                }
            })

        }

        function deleteCustomer(url)
        {
            $('#deleteCustomerForm').attr('action', url)
            $('#deleteCustomerModal').modal('show')
        }

        $('select[name="government_id"]').on('change', function () {
            changeRegionBySelected($(this).val());
        })


        function changeRegionBySelected(govern,region) {
            $.ajax({
                type: "get",
                url: "{{url('getreigons/')}}/" + govern +'/'+region,
                success: function(response) {

                    $('select[name="region_id"]').html(response)
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


        $('.modal').on('hide.bs.modal', function () {
            $('select[name="government_id"] option[disabled]').prop('selected', true);
            $('select[name="region_id"] option').remove();
            $('select[name="region_id"]').append('Choose region ...');
        })


        @if(session()->has('message'))
        notifyMe('{{ session()->get('message') }}', 'success')
        @endif
    </script>
@endpush
