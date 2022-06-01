@canany(['orders.index', 'orders.create', 'orders.createQ'])
    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
        @can('orders.index')
            <li class="nav-item ct-tab-btn">
                <a class="nav-link {{ $index ?? null }}" href="{{ route('orders.index') }}" role="tab">
                    <i class="icofont icofont-ui-home"></i>{{ trans('lang.all') }}
                </a>
            </li>
        @endcan

        @can('orders.create')
            <li class="nav-item">
                <a class="nav-link {{ $create ?? null }}" href="{{ route('orders.create') }}" role="tab">
                    <i class="icofont icofont-man-in-glasses"></i>{{ trans('lang.create') }}
                </a>
            </li>
        @endcan


        @can('orders.createQ')
            <li class="nav-item">
                <a class="nav-link {{ $createQ ?? null }}" href="{{ route('orders.createQ') }}" role="tab">
                    <i class="icofont icofont-user-male"></i>{{ trans('lang.createQ') }}
                </a>
            </li>
        @endcan

    </ul>
@endcanany
