@extends('commonmodule::layouts.master')


@section('content')

    @can('permissions.store')
    <div class="btn-create">
        <button  class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#createPermissionModal">
            <i class="icon-plus pr-1"></i> {{ trans('lang.create_permission') }}
        </button>
    </div>
    @endcan

    <!-- content -->
    <div class="vehicle-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.permissions') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>


    <x-modal modal-id="createPermissionModal" title="Create Permission" form-id="createPermissionForm">
        <form action="{{ route('permissions.store') }}" id="createPermissionForm" method="post" >
            @csrf
            <input type="hidden" name="only_one">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
        </form>
    </x-modal>


    @can('permissions.store')
    <x-modal modal-id="editPermissionModal" title="edit Permission" form-id="editPermissionForm">
        <form action="" id="editPermissionForm" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name_ar">Name</label>
                <input id="edit_name" type="text" class="form-control" name="name" required minlength="2">
            </div>
        </form>
    </x-modal>
    @endcan


    @can('permissions.destroy')
    <x-modal modal-id="deletePermissionModal" title="Delete Permission" form-id="deletePermissionForm" save-text="Delete">
        <form action="" id="deletePermissionForm" method="post">
            @csrf
            @method('delete')

            <p>Are you Sure you want to delete this Permission</p>
        </form>
    </x-modal>
    @endcan

@endsection


@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>

        $("#createPermissionForm, #editPermissionForm, #deletePermissionForm").on('submit', function (e) {
            e.preventDefault();
            let data = new FormData(this)
            $(this).trigger('reset')
            $('.modal').modal('hide')
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data,
                processData: false,
                contentType: false,
                success: function (response) {
                    notifyMe(response.message, 'success')
                    customUpdateDataTable('#permissions-table', window.location.href)
                },
                error: function (error){
                    notifyMe(error.responseJSON.message, 'danger')
                }
            })
        })

        function assignPermissionToRole(url)
        {
            $.ajax({
                url,
                type: 'get',
                error:function (error) {
                    customUpdateDataTable('#permissions-table', window.location.href)
                    notifyMe(error.responseJSON.message, 'danger')
                }
            })

        }


        function editPermission(url, name)
        {
            $('#editPermissionForm').attr('action', url)
            $('#edit_name').val(name)
            $('#editPermissionModal').modal('show')
        }

        function deletePermission(url)
        {
            $('#deletePermissionForm').attr('action', url)
            $('#deletePermissionModal').modal('show')
        }

    </script>
@endpush

