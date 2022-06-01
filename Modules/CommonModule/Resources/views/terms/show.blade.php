<div style="margin: auto;width: 20%;
text-align: center;
margin-top: 40vh;
border: 1px solid red;
border-radius: 10px;
padding: 10px;
font-size: 30px">
    @if($terms)
    @foreach($terms as $key => $value)
        <p>
            {{ $value }}
        </p>
    @endforeach
    @else
    <h1>{{ trans('lang.there_is_no_terms') }}</h1>
    @endif
</div>
