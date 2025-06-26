<!--begin::Footer-->
<div class="app-sidebar-footer d-flex flex-stack px-11 pb-10" id="kt_app_sidebar_footer">
    <!--begin::User menu-->
    <div class="">
       <!--begin::Menu wrapper-->
        <div
            class="cursor-pointer symbol symbol-circle symbol-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-overflow="true"
            data-kt-menu-placement="top-start"
        >
            <img src="assets/media/avatars/300-2.jpg" alt="image"/>
        </div>
@include('partials/menus/_user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
    <!--begin::Logout-->
    <a href="<?= site_url('DosenAuth/logout') ?>" class="btn btn-sm btn-outline btn-flex btn-custom px-3">
        <i class="ki-solid ki-entrance-left fs-2 me-2"></i>
        Logout
    </a>
    <!--end::Logout-->
</div>
<!--end::Footer-->
