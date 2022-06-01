@extends('commonmodule::layouts.master')

@section('content')

       <div class="btn-create">
           <button  class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#createGovernmentModal">
               <i class="icon-plus pr-1"></i> {{ trans('lang.create_government') }}
           </button>
       </div>

    <!-- content -->
    <div class="government-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.government_table') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>


    <x-modal modal-id="createGovernmentModal" title="{{ trans('lang.create_government') }}" form-id="createGovernmentForm">
        <form action="{{ route('governments.store') }}" id="createGovernmentForm" method="post">
            @csrf

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

       <x-modal modal-id="editGovernmentModal" title="{{ trans('lang.edit_government') }}" form-id="editGovernmentForm">
           <form action="" id="editGovernmentForm" method="post">
               @csrf
               @method('put')

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

       <x-modal modal-id="deleteGovernmentModal" title="{{ trans('lang.delete_government') }}" form-id="deleteGovernmentForm" save-text="Delete">
           <form action="" id="deleteGovernmentForm" method="post">
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
        function editGovernment(url, name_ar, name_en)
        {
            $('#editGovernmentForm').attr('action', url)
            $('#edit_name_ar').val(name_ar)
            $('#edit_name_en').val(name_en)
            $('#editGovernmentModal').modal('show')
        }

        function deleteGovernment(url)
        {
            $('#deleteGovernmentForm').attr('action', url)
            $('#deleteGovernmentModal').modal('show')
        }


        @if(session()->has('message'))
        notifyMe('{{ session()->get('message') }}', 'success')
        @endif
    </script>
@endpush
