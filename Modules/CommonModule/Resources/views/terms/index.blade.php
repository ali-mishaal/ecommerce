@extends('commonmodule::layouts.master')


@section('content')



    <!-- content -->
    <div class="vehicle-page all-pages">
        <div class="card-header">

            <h5>{{ trans('lang.terms') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('terms.store') }}" method="post" id="termsForm">
                @csrf
                <div class="form-group">
                    <label for="terms_to_driver">{{ trans('lang.terms_to_driver_at_attach') }}</label>
                    <textarea type="text" class="form-control"
                              name="driver_attach" id="terms_to_driver"
                              rows="8"
                              placeholder="{{ trans('lang.insert_terms_here') }}"
                    >{{ $terms->driver_attach ?? null }}</textarea>
                </div>


                <div class="form-group">
                    <label for="terms_to_driver_transfer">{{ trans('lang.terms_to_driver_at_transfer') }}</label>
                    <textarea type="text" class="form-control"
                              name="driver_transfer" id="terms_to_driver_transfer"
                              rows="8"
                              placeholder="{{ trans('lang.insert_terms_here') }}"
                    >{{ $terms->driver_transfer ?? null }}</textarea>
                </div>
            </form>
        </div>


        <div class="card-footer">
            <button class="btn btn-primary" type="submit" form="termsForm">{{ trans('lang.save') }}</button>
        </div>
    </div>

@endsection
