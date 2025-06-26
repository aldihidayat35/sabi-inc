<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
    data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img alt="Profile Photo" src="{{ asset( session('photo_profil', 'default.png')) }}" />
            </div>
            <!--end::Avatar-->
            <!--begin::User Info-->
            <div class="d-flex flex-column">
                <div class="fw-bold d-flex align-items-center fs-5">
                    {{ session('nama', 'Guest') }}
                </div>
                <a href="#" class="fw-semibold text-muted text-hover-primary fs-6">
                    {{ session('email', 'No Email') }}
                </a>
                <span class="fw-semibold text-muted fs-6">
                    NIP: {{ session('nip', 'N/A') }}
                </span>
                <span class="fw-semibold text-muted fs-6">
                    Level: {{ ucfirst(session('level', 'N/A')) }}
                </span>
            </div>
            <!--end::User Info-->
        </div>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->
    <!--begin::Menu item-->
    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
        <a href="#" class="menu-link px-5">
            <span class="menu-title position-relative">
                Mode
                <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                    <i class="ki-solid ki-night-day theme-light-show fs-2"></i>
                    <i class="ki-solid ki-moon theme-dark-show fs-2"></i>
                </span>
            </span>
        </a>
        @include('partials/theme-mode/__menu')
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <form action="{{ route('teacher.logout') }}" method="POST" id="logout-form" style="display: none;">
            @csrf
        </form>
        <a href="#" class="menu-link px-5" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Sign Out
        </a>
    </div>
    <!--end::Menu item-->
</div>
<!--end::User account menu-->
