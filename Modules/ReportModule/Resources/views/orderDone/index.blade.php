@extends('commonmodule::layouts.master')

@section('css')
    <style>
     .select2-container {
         width: 100% !important;
     }
    </style>
@endsection

@section('content')

    <div class="card-header">
        <h5>{{ trans('lang.orderDone') }}</h5>
    </div>

    <!-- content -->
    <div class="vehicle-page all-pages">

        <div class="card-body">

            @php($index = 'active')

                <form id="date-filter-form" >
                    <div class="row input-derange">
                        <div class="col-md-4">
                            <label>{{ trans('lang.from') }}</label>
                            <input type="date" name="from_date" id="from_date"
                                   class="form-control"
                                   placeholder="{{ trans('lang.from') }}" value="{{ \Carbon\Carbon::today() }}" />
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.to') }}</label>
                            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="{{ trans('lang.to') }}" />
                        </div>


                        <div class="col-md-4">
                            <label>{{ trans('lang.status') }}</label>
                            <select name="status" class="form-control">
                                <option value=""
                               @if(Request::query('status') == '')
                                   selected
                               @endif
                                >All</option>
                                @foreach($order_statuses as $status)
                                    <option value="{{ $status->id }}"
                                        @if(Request::query('status') == $status->id)
                                            selected
                                        @endif
                                    >{{ $status->name_en }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-100">
                            <br>
                        </div>

                        <div class="col-4">
                            <label for="filter_supervisor_id">{{ trans('lang.supervisor') }}</label>
                            <select name="filter_supervisor_id" class="form-control select2 " id="filter_supervisor_id">
                                <option disabled selected>{{ trans('lang.search_by_name_or_mobile') }}</option>
                            </select>
                        </div>


                        <div class="col-4">
                            <label for="filter_client_id">{{ trans('lang.client') }}</label>
                            <select name="filter_client_id" id="filter_client_id" class="form-control select2">
                                <option disabled selected>{{ trans('lang.search_by_name_or_mobile') }}</option>

                            </select>
                        </div>

                        <div class="col-4">
                            <label for="filter_customer_id">{{ trans('lang.driver') }}</label>
                            <select name="filter_driver_id" id="filter_driver_id" class="form-control select2">
                                <option disabled selected>{{ trans('lang.search_by_name_or_mobile') }}</option>

                            </select>
                        </div>


                        <div class="w-100">
                            <br>
                        </div>
                        <div class="col-md-4 offset-md-8 text-right">
                            <button type="submit" name="filter" id="filter" class="btn btn-primary">{{ trans('lang.filter') }}</button>
                            <button type="button" name="refresh" id="refresh" class="btn btn-danger">{{ trans('lang.refresh') }}</button>
                        </div>
                    </div>
                </form>

                <div class="w-100">
                    <br>
                </div>



                <div class="table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Transfer Order to another Driver -->

    <x-modal modal-id="changeDriverModal" :title="trans('lang.transfer_order')" form-id="changeDriverForm">
        <form class="needs-validation" method="post" id="changeDriverForm">
            @csrf
            <div class="form-group">
                <label>{{ trans('lang.select', ['attribute' => trans('lang.driver')]) }}</label>
                <select class="form-control" name="new_driver_id">
                    <option selected disabled>{{ trans('lang.choose...') }}</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->user->name??'' . ' | ' . $driver->assignedOrders->count() }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </x-modal>

    <!-- Choose Many Drivers Modal -->
    <x-modal modal-id="assignToMultipleDrives"  :title="trans('lang.assign_to_multiple_drivers')" form-id="assignToMultipleDrivesForm">
        <form id="assignToMultipleDrivesForm">
            @csrf
            <div class="form-group">
                <label for="Drivers">{{ trans('lang.select', ['attribute' => trans('drivers')]) }}</label>
                <Select id="drivers" class="select2" style="width: 100%" multiple name="drivers[]">
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->user->name??'' . ' | ' . $driver->assignedOrders->count() }}</option>
                    @endforeach
                </Select>
            </div>
        </form>
    </x-modal>


    <!-- Edit Fees Calculations Modal -->
    <x-modal modal-id="EditFeesCalculationModal"  :title="trans('lang.edit_fees_calculations')" form-id="EditFeesCalculationForm">
        <form id="EditFeesCalculationForm">
            @csrf
            <div class="form-group">
                <label for="Drivers">{{ trans('lang.total_fees') }}</label>
                <input type="number" step="0.01" class="form-control" readonly id="edit_fees_order_fees">
            </div>

            <div class="form-group">
                <label for="Drivers">Company Fees</label>
                <input type="number" step="0.01" class="form-control" readonly  id="edit_fees_company_fees">
            </div>

            <div class="form-group">
                <label for="Drivers">Driver Fees</label>
                <input type="number" step="0.01" class="form-control" name="driver_fees" id="edit_fees_driver_fees">
            </div>
        </form>
    </x-modal>


    <x-modal modal-id="SendToAnotherSupervisorModal" title="{{ trans('lang.change_supervisor') }}" form-id="SendToAnotherSupervisorForm">
        <form class="needs-validation" method="post" id="SendToAnotherSupervisorForm">
            @csrf
            <div class="form-group">
                <label>{{ trans('lang.select', ['attribute' => trans('lang.supervisor')]) }}</label>
                <select class="form-control" name="new_supervisor_id">
                    <option selected disabled>{{ trans('lang.choose...') }}</option>
                    @foreach($supervisors as $supervisor)
                        <option value="{{ $supervisor->id }}">{{ $supervisor->user->name??'' }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </x-modal>

    <x-modal modal-id="changeOrderStatusModal" title="{{ trans('lang.change_order_status') }}" form-id="changeOrderStatusForm">
        <form class="needs-validation" method="post" id="changeOrderStatusForm">
            @csrf

            <div class="form-group">
                <label>{{ trans('lang.current_status') }}</label>
                <input type="text" readonly id="current_status" class="form-control">
            </div>
            <div class="form-group ">
                <label>{{ trans('lang.change_status') }}</label>
                <input type="hidden" name="status_id" id="status_id">
                <div class="row">
                    @foreach($statuses as $status)
                        <div class="col-6 my-2">
                            <button onclick="OnSubmitOrderStatusForm('{{ $status->id }}')" class="btn btn-primary">{{ $status->name_en }}</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>
    </x-modal>



@endsection


@push('scripts')
    {!! $dataTable->scripts() !!}


    <script>
        $('#filter_supervisor_id').select2(select2Ajax('{{ route('get.supervisors.select2') }}'))
        $('#filter_client_id').select2(select2Ajax('{{ route('get.clients.select2') }}'))
        $('#filter_customer_id').select2(select2Ajax('{{ route('get.customers.select2') }}'))
        $('#filter_driver_id').select2(select2Ajax('{{ route('get.drivers.select2') }}'))

        // refrsh btn
        $('#refresh').on('click', function () {
            $('#from_date').val('');
            $('#to_date').val('');
            let url = new URL(window.location.href)
            let newUrl = url.origin.toString() + url.pathname.toString()
            updateDataTable(newUrl)

        })

        function OnSubmitOrderStatusForm(status_id)
        {
            $('#status_id').val(status_id);
        }

        $('#drivers').select2({
            width:'element',
            minimumResultsForSearch: Infinity,
            dropdownParent: $('#assignToMultipleDrives')
        })

        $('#order-table').addClass('responsive')

        //change tabs

        $('.ct-tab-btn').click(function (e) {
            e.preventDefault();
            $(this).siblings().find('a.nav-link').removeClass('active');
            let alink = $(this).find('a.nav-link');
            alink.addClass('active');
            let url = alink.attr('href');

            updateDataTable(url)
        })


        // update date table function
        function updateDataTable(url)
        {
            let oTable = $(`#order-table`).DataTable();
            oTable.ajax.url(url).load();
            window.history.pushState('', '', url);
        }


        function changeFormAction(form_id, url)
        {
            $(form_id).attr('action', url)
        }

        function ChangeStatus(form_id, url, current_status)
        {
            $(form_id).attr('action', url)
            $('#current_status').val(current_status)
        }

        function EditDriverFees(url, order_fees, company_fees)
        {
            console.log(order_fees, company_fees)
            $('#EditFeesCalculationForm').attr('action', url);
            $('#edit_fees_order_fees').val(+order_fees);
            $('#edit_fees_company_fees').val(+company_fees);
            $('#edit_fees_driver_fees').val(order_fees - company_fees);
        }

        $('#edit_fees_driver_fees').on('keyup', function () {
            let val = $('#edit_fees_order_fees').val() - $(this).val()
            $('#edit_fees_company_fees').val(val)
        })

        function sendGetRequest(url) {
            $.ajax({
                type: 'get',
                url: url,
                success: function (response) {
                    updateDataTable(window.location.href)
                    notifyMe(response.message, 'success')
                },
                error: function(errors){
                    notifyMe('something went wrong', 'danger')
                },
            })
        }


        function driverApproveOrder(order_id) {
            $.ajax({
                type: 'get',
                url: '{{ url('orders/driver-approve/') }}' + '/' + order_id,
                success: function (response) {
                        updateDataTable(window.location.href)
                        notifyMe(response.message, 'success')
                    },
                error: function(errors){
                    notifyMe('something went wrong', 'danger')
                },
            })
        }




        function driverRefuseOrder(order_id) {
            $.ajax({
                type: 'get',
                url: '{{ url('orders/new-driver-refuse/') }}' + '/' + order_id,
                success: function (response) {
                    updateDataTable(window.location.href)
                    notifyMe(response.message, 'success')
                },
                error: function(errors){
                    notifyMe('something went wrong', 'danger')
                },
            })
        }

        function changeDriver(order_id){
            console.log('this is comsile')
            $('#changeDriverForm').attr('action', '{{ url('orders/change-driver/') }}' + '/' + order_id)
            $('#changeDriverModal').modal('show');
        }

        $('#changeDriverForm, #assignToMultipleDrivesForm, #EditFeesCalculationForm, #SendToAnotherSupervisorForm').on('submit', function (e) {
            let form = $(this)
            e.preventDefault()
            let formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data:formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    updateDataTable(window.location.href)
                    $('.modal').modal('hide');
                    notifyMe(response.message, 'success')
                    form.trigger('reset')
                },
                error: function(errors){
                    $('.modal').modal('hide');
                    notifyMe('something went wrong', 'danger')
                    form.trigger('reset')
                },
            })

        })

    </script>

@endpush
