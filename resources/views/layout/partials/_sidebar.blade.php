<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    {{-- <!--begin::Header-->
    <div class="aside-logo flex-column-auto px-9 mb-9 mb-lg-17 mx-auto mt-8" id="kt_app_sidebar_header">
        <!--begin::Logo-->
        <a href="index.html">
            <img alt="Logo" src="{{ asset('sabi.inc.png') }}" class="h-30px logo theme-light-show" />
            <img alt="Logo" src="{{ asset('sabi.inc.png') }}" class="h-30px logo theme-dark-show" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Header--> --}}
    <!--begin::Header-->
    <div class="aside-logo flex-column-auto px-9 mb-9  mx-auto mt-8" id="kt_app_sidebar_header">
        <!--begin::User Info-->
        <div class="d-flex align-items-center flex-column mb-4">
            <!--begin::Symbol-->
            <div class="card mb-4"
                style="background: transparent; border: 1px dotted #adb5bd; box-shadow: none; max-width: 310px;">
                <div class="card-body d-flex align-items-center" style="padding-bottom: 1rem;">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-75px me-4 pb-4">
                        <img src="{{ asset(session('photo_profil', 'default.png')) }}" alt="Profile Photo" />
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Info-->
                    <div>
                        <a href="#"
                            class="text-gray-100 text-hover-primary fs-2 fw-bolder">{{ session('nama', 'Guest') }}</a>
                        <span
                            class="text-gray-100 text-hover-primary fs-8 fw-bolder">{{ session('email', 'Guest') }}</span>
                        <span
                            class="text-gray-600 fw-semibold d-block fs-7 mb-1">{{ ucfirst(session('level', 'N/A')) }}</span>
                    </div>
                    <!--end::Info-->
                </div>

            </div>

        </div>
    </div>
    <!--end::Header-->


    <!--begin::Navigation-->
    <div class="app-sidebar-navs flex-column-fluid  " id="kt_app_sidebar_navs">
        <div id="kt_app_sidebar_navs_wrappers" class="hover-scroll-y my-2" data-kt-scroll="true"
            data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_header, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">


            {{-- <!--begin::User Info-->
            <div class="d-flex align-items-center flex-column mb-4">
                <!--begin::Symbol-->
                <div class="card mb-4"
                    style="background: transparent; border: 1px dotted #adb5bd; box-shadow: none; max-width: 310px;">
                    <div class="card-body d-flex align-items-center" style="padding-bottom: 1rem;">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-75px me-4 pb-4">
                            <img src="{{ asset(session('photo_profil', 'default.png')) }}" alt="Profile Photo" />
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Info-->
                        <div>
                            <a href="#"
                                class="text-gray-100 text-hover-primary fs-2 fw-bolder">{{ session('nama', 'Guest') }}</a>
                            <span
                                class="text-gray-100 text-hover-primary fs-8 fw-bolder">{{ session('email', 'Guest') }}</span>
                            <span
                                class="text-gray-600 fw-semibold d-block fs-7 mb-1">{{ ucfirst(session('level', 'N/A')) }}</span>
                        </div>
                        <!--end::Info-->
                    </div>

                </div>

            </div> --}}

            <!--end::User Info-->
            @include('layout/partials/sidebar/_navs/_menu')
        </div>
    </div>
    <!--end::Navigation-->

    <!--begin::Footer-->
    <div class="app-sidebar-footer d-flex flex-stack px-11 pb-10" id="kt_app_sidebar_footer">
        <!--begin::User Menu-->
        <div>
            <div class="cursor-pointer symbol symbol-circle symbol-40px"
                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true"
                data-kt-menu-placement="top-start">
                <img src="{{ asset(session('photo_profil', 'default.png')) }}" alt="Profile Photo" />
            </div>
            @include('partials/menus/_user-account-menu')
        </div>
        <!--end::User Menu-->

        <!--begin::Logout-->
        <form action="{{ route('teacher.logout') }}" method="POST" id="logout-form-teacher" style="display: none;">
            @csrf
        </form>
        <a href="#" class="menu-link"
            onclick="event.preventDefault(); document.getElementById('logout-form-teacher').submit();">
            <span class="menu-icon"><i class="bi bi-box-arrow-right fs-2"></i></span>
            <span class="menu-title">Logout</span>
        </a>
        <!--end::Logout-->
    </div>
    <!--end::Footer-->

</div>
<!--end::Sidebar-->
