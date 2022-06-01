@extends('commonmodule::layouts.master')


@section('content')

    <!-- content -->
    <div class="vehicle-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.driver_vehicles') }}</h5>
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

@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
