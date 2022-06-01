<div id="addressShow" class="col-md-12 mb-3">
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-3">
            <label for="validationCustom02">{{ trans('lang.address_name') }}</label>
            <input class="form-control" id="addressName" name="addressName" type="text"
                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.address_name')]) }}" data-original-title="" title="">
            <div class="valid-feedback">{{ trans('lang.good') }}</div>
        </div>

        <div class="col-md-6 col-lg-4 mb-3">
            <label for="add1">{{ trans('lang.government') }}</label>
            <select onchange="changeRegion(this)" class="custom-select" id="government" name="government">
                <option>{{ trans('lang.choose') }}</option>
                @foreach($goverments as $key)
                    <option value="{{$key->id}}">{{$key->name_en}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.government')]) }}</div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <label for="add2">{{ trans('lang.region') }}</label>
            <select class="custom-select" id="region" name="region">
                <option>{{ trans('lang.region') }}</option>
            </select>
            <div class="invalid-feedback">{{ trans('lang.please', ['attribute' => trans('lang.region')]) }}</div>
        </div>

        <div class="col-md-6 col-lg-4 mb-3">
            <label for="validationCustom02">{{ trans('lang.widget') }}</label>
            <input class="form-control" id="widget" name="widget" type="text"
                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.widget')]) }}" data-original-title="" title="">
            <div class="valid-feedback">{{ trans('lang.good') }}</div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <label for="validationCustom02">{{ trans('lang.street') }}</label>
            <input class="form-control" id="street" name="street" type="text"
                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.street')]) }}" data-original-title="" title="">
            <div class="valid-feedback">{{ trans('lang.good') }}</div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <label for="validationCustom02">{{ trans('lang.avenue') }}</label>
            <input class="form-control" id="avenue" name="avenue" type="text"
                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.avenue')]) }}" data-original-title="" title="">
            <div class="valid-feedback">{{ trans('lang.good') }}</div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <label for="validationCustom02">{{ trans('lang.home_number') }}</label>
            <input class="form-control" id="home_number" name="home_number" type="number"
                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.home_number')]) }}" data-original-title="" title="">
            <div class="valid-feedback">{{ trans('lang.good') }}</div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <label for="validationCustom02">{{ trans('lang.floor') }}</label>
            <input class="form-control" id="floor" name="floor" type="number"
                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.floor')]) }}" data-original-title="" title="">
            <div class="valid-feedback">{{ trans('lang.good') }}</div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <label for="validationCustom02">{{ trans('lang.flat') }}</label>
            <input class="form-control" id="flat" name="flat" type="number"
                   placeholder="{{ trans('lang.placeholder', ['attribute' => trans('lang.flat')]) }}" data-original-title="" title="">
            <div class="valid-feedback">{{ trans('lang.good') }}</div>
        </div>
    </div>

</div>
