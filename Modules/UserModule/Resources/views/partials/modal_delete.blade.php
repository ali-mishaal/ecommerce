<div class="modal fade popup-delete" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.confirm_delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <input type="hidden" id="deleteUser">
            </div>
            <div class="modal-body">
                {{ trans('lang.confirm_delete_message') }}
            </div>
            <div class="modal-footer">
                <button type="button" onclick="deleteUser()" class="btn btn-primary">{{ trans('lang.yes_i_am_sure') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.cancel') }}</button>

            </div>
        </div>
    </div>
</div>
