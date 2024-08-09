<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}"
    data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <div class="app-header-logo d-flex align-items-center me-lg-9">
            <div class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px ms-n2 me-2 d-flex d-lg-none"
                id="kt_app_header_menu_toggle">
                <i class="ki-outline ki-abstract-14 fs-1"></i>
            </div>

            <a href="index.html">
                <img alt="Logo" src="{{ asset('logo/logo_black.png') }}" class="h-35px theme-light-show" />
                <img alt="Logo" src="{{ asset('logo/logo_white.png') }}" class="h-35px theme-dark-show" />
            </a>
        </div>

        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">

            <div class="d-flex align-items-stretch" id="kt_app_header_menu_wrapper">
                {{-- For Flex --}}
            </div>

            <div class="app-navbar flex-shrink-0">
                <div class="app-navbar-item ms-1 ms-lg-4" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-35px symbol-md-40px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <img class="symbol symbol-35px symbol-md-40px"
                            src="{{ asset('metronic') }}/media/avatars/300-5.jpg" alt="user" />
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ asset('metronic') }}/media/avatars/300-5.jpg" />
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        {{ Auth::user()->name }}
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                                            Admin
                                        </span>
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                                        {{ Auth::user()->email }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-2"></div>
                        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                            data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title position-relative">Mode
                                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                        <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                                        <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                                    </span></span>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                data-kt-menu="true" data-kt-element="theme-mode-menu">
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                        data-kt-value="light">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-outline ki-night-day fs-2"></i>
                                        </span>
                                        <span class="menu-title">Light</span>
                                    </a>
                                </div>

                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                        data-kt-value="dark">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-outline ki-moon fs-2"></i>
                                        </span>
                                        <span class="menu-title">Dark</span>
                                    </a>
                                </div>

                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                        data-kt-value="system">
                                        <span class="menu-icon" data-kt-element="icon">
                                            <i class="ki-outline ki-screen fs-2"></i>
                                        </span>
                                        <span class="menu-title">System</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="menu-item px-5">
                            <a href="{{ route('logout') }}" class="menu-link px-5">Sign Out</a>
                        </div>

                        <div class="menu-item px-5">
                            <a href="/" class="menu-link px-5">
                                Go to Homepage
                            </a>
                        </div>
                    </div>
                </div>
                <div class="app-navbar-item d-flex align-items-center d-lg-none ms-1 me-n2">
                    <a href="#" class="btn btn-icon btn-color-gray-500 btn-active-color-primary w-35px h-35px"
                        id="kt_app_sidebar_mobile_toggle">
                        <i class="ki-outline ki-burger-menu-2 fs-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
