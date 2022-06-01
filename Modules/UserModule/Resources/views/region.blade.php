@extends('commonmodule::layouts.master')

@section('content')

    <div class="btn-create">
        <button  class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#createRegionModal">
            <i class="icon-plus pr-1"></i> {{ trans('lang.create_region') }}
        </button>
    </div>

    <!-- content -->
    <div class="region-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.region_table') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>



    <x-modal modal-id="createRegionModal" title="{{ trans('lang.create_region') }}" form-id="createRegionForm">
        <form action="{{ route('regions.store') }}" id="createRegionForm" method="post">
            @csrf


            <div class="form-group">
                <label for="government">{{ trans('lang.government') }}</label>
                <select name="goverment_id" class="form-control">
                    <option value="" disabled selected>{{ trans('lang.choose') }}</option>
                    @foreach($governments as $gov)
                        <option value="{{ $gov->id }}">{{ $gov->name_en }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name_ar">{{ trans('lang.arabic_name') }}</label>
                <input type="text" class="form-control" name="name_ar" required minlength="2">
            </div>


            <div class="form-group">
                <label for="name_en">{{ trans('lang.english_name') }}</label>
                <input type="text" class="form-control" name="name_en" required minlength="2">
            </div>
        </form>
    </x-modal>

    <x-modal modal-id="editRegionModal" title="{{ trans('lang.edit_region') }}" form-id="editRegionForm">
        <form action="" id="editRegionForm" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="government">{{ trans('lang.government') }}</label>
                <select id="edit_government_id" name="goverment_id" class="form-control">
                    <option value="" disabled selected>{{ trans('lang.choose') }}</option>
                    @foreach($governments as $gov)
                        <option value="{{ $gov->id }}">{{ $gov->name_en }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name_ar">{{ trans('lang.arabic_name') }}</label>
                <input id="edit_name_ar" type="text" class="form-control" name="name_ar" required minlength="2">
            </div>


            <div class="form-group">
                <label for="name_en">{{ trans('lang.english_name') }}</label>
                <input id="edit_name_en" type="text" class="form-control" name="name_en" required minlength="2">
            </div>
        </form>
    </x-modal>

    <x-modal modal-id="deleteRegionModal" title="{{ trans('lang.delete_region') }}" form-id="deleteRegionForm" save-text="Delete">
        <form action="" id="deleteRegionForm" method="post">
            @csrf
            @method('delete')

            <p>{{ trans('lang.confirm_delete_message') }}</p>
        </form>
    </x-modal>



@endsection

@section('js')
    {!! $dataTable->scripts() !!}
@endsection


@push('scripts')
    <script>
        function editRegion(url, name_ar, name_en, gov_id)
        {
            $('#editRegionForm').attr('action', url)
            $('#edit_name_ar').val(name_ar)
            $('#edit_name_en').val(name_en)
            $('#edit_government_id').val(gov_id)
            $('#editRegionModal').modal('show')
        }

        function deleteRegion(url)
        {
            $('#deleteRegionForm').attr('action', url)
            $('#deleteRegionModal').modal('show')
        }


        @if(session()->has('message'))
        notifyMe('{{ session()->get('message') }}', 'success')
        @endif
    </script>
@endpush
