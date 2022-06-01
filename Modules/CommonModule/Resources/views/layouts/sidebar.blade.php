
    <!-- Page Sidebar Start-->
    <header class="main-nav">
        <div class="logo-wrapper"><a href="{{url('/')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{url('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
        <nav>
            <div class="main-navbar">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="mainnav">
                    <ul class="nav-menu custom-scrollbar">
                        <li class="back-btn"><a href="{{url('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
                            <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                        </li>
                        @canany(['roles.index', 'permissions.index', 'admin.index', 'supervisor.index', 'driver.index', 'client.index'])
                        <li class="sidebar-title">
                            <div>
                                <h6 class="lan-1">{{ trans('lang.user_management') }}</h6>
                            </div>
                        </li>
                        @endcanany

                        @can('roles.index')
                        <li class="dropdown"><a class="nav-link menu-title link-nav" href="{{ route('roles.index') }}"><i data-feather="feather feather-users"> </i><span>{{ trans('lang.roles') }}</span></a></li>
                        @endcan


                        @can('permissions.index')
                        <li class="dropdown"><a class="nav-link menu-title link-nav" href="{{ route('permissions.index') }}"><i data-feather="feather feather-users"> </i><span>{{ trans('lang.permissions') }}</span></a></li>
                        @endcan



                        @canany(['admin.index', 'supervisor.index', 'driver.index', 'client.index'])
                        <li class="dropdown"><a class="nav-link menu-title" href="#"><span class="lan-6">{{ trans('lang.user') }}</span></a>
                            <ul class="nav-submenu menu-content">

                                @can('admin.index')
                                <li><a href="{{ route('admin.index') }}">{{ trans('lang.administrator') }}</a></li>
                                @endcan

                                @can('supervisor.index')
                                <li><a href="{{ route('supervisor.index') }}">{{ trans('lang.supervisor') }}</a></li>
                                @endcan

                                @can('driver.index')
                                <li><a href="{{ route('driver.index') }}">{{ trans('lang.driver') }}</a></li>
                                @endcan

                                @can('client.index')
                                <li><a href="{{ route('client.index') }}">{{ trans('lang.client') }}</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany

                        @canany(['brands.index', 'vehicle-types.index', 'vehicles.index', 'driver_vehicles.index', 'attach-vehicle.index', 'transfer-vehicle.index'])
                        <li class="sidebar-title">
                            <div>
                                <h6 class="lan-1">{{ trans('lang.vehicle_management') }}</h6>
                            </div>
                        </li>
                        @endcanany



                        @can('brands.index')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{ route('brands.index') }}">
                                <span>{{ trans('lang.brands') }}</span>
                            </a>
                        </li>
                        @endcan

                        @can('vehicle-types.index')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{ route('vehicle-types.index') }}">
                                <span>{{ trans('lang.vehicle_type') }}</span>
                            </a>
                        </li>
                        @endcan


                        @can('vehicles.index')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{ route('vehicles.index') }}">
                                <span>{{ trans('lang.company_vehicle') }}</span>
                            </a>
                        </li>
                        @endcan

                        @canany(['driver_vehicles.index', 'attach-vehicle.index', 'transfer-vehicle.index'])
                        <li class="dropdown"><a class="nav-link menu-title" href="#"><span class="lan-6">{{ trans('lang.vehicle_management') }}</span></a>
                            <ul class="nav-submenu menu-content">

                                @can('driver_vehicles.index')
                                <li>
                                    <a href="{{ route('driver_vehicles.index') }}">{{ trans('lang.driver_vehicles') }}</a>
                                </li>
                                @endcan

                                @can('attach-vehicle.index')
                                <li>
                                    <a href="{{ route('attach-vehicle.index') }}">{{ trans('lang.attach_vehicle') }}</a>
                                </li>
                                @endcan

                                @can('transfer-vehicle.index')
                                <li>
                                    <a href="{{ route('transfer-vehicle.index') }}">{{ trans('lang.transfer_vehicle') }}</a>
                                </li>
                                @endcan

                            </ul>
                        </li>
                        @endcanany

                        @can('orders.index')
                        <li class="sidebar-title">
                            <div>
                                <h6 class="lan-1">{{ trans('lang.order_management') }}</h6>
                            </div>
                        </li>
                        @endcan

                        @can('orders.index')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{ route('orders.index') }}">
                                <span>{{ trans('lang.orders') }}</span>
                            </a>
                        </li>
                        @endcan



                        @can('customers.index')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{ route('customers.index') }}">
                                <span>{{ trans('lang.customers') }}</span>
                            </a>
                        </li>
                        @endcan



                        @can('governments.index')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{ route('governments.index') }}">
                                <span>{{ trans('lang.government') }}</span>
                            </a>
                        </li>
                        @endcan


                        @can('regions.index')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{ route('regions.index') }}">
                                <span>{{ trans('lang.region') }}</span>
                            </a>
                        </li>
                        @endcan

                        @can('terms.index')
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{ route('terms.index') }}">
                                <span>{{ trans('lang.terms') }}</span>
                            </a>
                        </li>
                        @endcan

                        @can('orders.index')
                            <li class="sidebar-title">
                                <div>
                                    <h6 class="lan-1">{{ trans('lang.reportsAndAccounts') }}</h6>
                                </div>
                            </li>
                        @endcan


                        @can('terms.index')
                            <li class="dropdown">
                                <a class="nav-link menu-title link-nav" href="{{ url('orderDone') }}">
                                    <span>{{ trans('lang.orderDone') }}</span>
                                </a>
                            </li>
                        @endcan

                        @can('terms.index')
                            <li class="dropdown">
                                <a class="nav-link menu-title link-nav" href="{{ url('orderUnderDelivery') }}">
                                    <span>{{ trans('lang.orderUnder') }}</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
        </nav>
    </header>
    <!-- Page Sidebar Ends-->

