<!-- Modal user icon -->
<div class="modal fade popup-delete user-icon" id="user-icon" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('lang.user_role') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" id="accountForm" action="{{url('set_user_account')}}" novalidate="">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="0">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username">{{ trans('lang.username') }}</label>
                        <input class="form-control" id="username" name="username" type="text"
                               placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.username')]) }}" required="" autocomplete="new username">
                        <div class="valid-feedback">{{ trans('lang.good') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="password">{{ trans('lang.password') }}</label>
                        <input class="form-control" id="password" name="password" type="password"
                               placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.password')]) }}" required autocomplete="new password">
                        <div class="valid-feedback">{{ trans('lang.good') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="role_id">{{ trans('lang.role') }}</label>
                        <select class="custom-select" id="role_id" name="role_id">
                            <option selected disabled value="0">{{ trans('lang.choose...') }}</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{ trans('lang.' . $role->name) }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.role')]) }}</div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('lang.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
