@php($status = $model->status ?$model->status->name_en : 'deleted')


<x-dropdown icon="mdi mdi-dots-vertical">

    @can('order.change.driver')
    <a class="dropdown-item" onclick="changeFormAction('#changeDriverForm', '{{ route("order.change.driver", $model->id) }}' )" href="#" data-toggle="modal" data-target="#changeDriverModal">
    <i class="mdi mdi-account-circle-outline mr-1"></i>
    {{ trans('lang.assign_to_driver') }}
    </a>
    @endcan


    @can('order.change.status')
    <a class="dropdown-item" onclick="ChangeStatus('#changeOrderStatusForm', '{{ route("order.change.status", $model->id) }}',  '{{ $status }}')" href="#" data-toggle="modal" data-target="#changeOrderStatusModal">
    <i class="mdi mdi-account-circle-outline mr-1"></i>
    {{ trans('lang.change_order_status') }}
    </a>
    @endcan


    @can('order.assign.multiple.driver')
    <a class="dropdown-item" href="#" data-toggle="modal" onclick="changeFormAction('#assignToMultipleDrivesForm', '{{ route("order.assign.multiple.driver", $model->id) }}')" data-target="#assignToMultipleDrives">
    <i class="mdi mdi-account-circle-outline mr-1"></i>
    {{ trans('lang.assign_to_multiple_drivers') }}
    </a>
    @endcan


    @can('order.edit_fees_calculation')
    <a class="dropdown-item" href="#" data-toggle="modal" onclick="EditDriverFees('{{ route("order.edit_fees_calculation", $model->id) }} ', '{{ $model->order_fees }}', '{{ $model->company_fees }}')" data-target="#EditFeesCalculationModal">
    <i class="mdi mdi-account-circle-outline mr-1"></i>
    {{ trans('lang.edit_fees_calculations') }}
    </a>
    @endcan

    @can('order.send_to_another_supervisor')
    <a class="dropdown-item" href="#" data-toggle="modal" onclick="changeFormAction('#SendToAnotherSupervisorForm', '{{ route("order.send_to_another_supervisor", $model->id)}}')" data-target="#SendToAnotherSupervisorModal">
    <i class="mdi mdi-account-circle-outline mr-1"></i>
    {{ trans('lang.send_to_anther_supervisor') }}
    </a>
    @endcan

    @can('orders.edit')
    <a class="dropdown-item" href="'{{ route('orders.edit', $model->id ) }}'">
        <i class="mdi mdi-account-circle-outline mr-1"></i>
        {{ trans('lang.edit_order') }}
    </a>
    @endcan

</x-dropdown>
