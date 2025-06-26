<!--begin::Header-->
<div id="kt_app_header" class="app-header "
     data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}"
     >
                        <!--begin::Header container-->
            <div class="app-container  container-fluid d-flex flex-stack " id="kt_app_header_container">
                <!--begin::Sidebar toggle-->
<div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
	<div class="btn btn-icon btn-active-color-primary w-35px h-35px me-2" id="kt_app_sidebar_mobile_toggle">
		<i class="ki-solid ki-abstract-14 fs-2"></i>	</div>
	<!--begin::Logo image-->
    <a href="?page=index">
		<img alt="Logo" src="assets/media/logos/default-small.svg" class="h-30px theme-light-show"/>
		<img alt="Logo" src="assets/media/logos/default-small-dark.svg" class="h-30px theme-dark-show"/>
    </a>
    <!--end::Logo image-->
</div>
<!--end::Sidebar toggle-->
<!--begin::Header wrapper-->
<div class="d-flex flex-stack flex-lg-row-fluid" id="kt_app_header_wrapper">
@include('layout/partials/_page-title')
	<!--begin::Action-->
	<a href="#" class="btn btn-primary d-flex flex-center h-35px h-lg-40px"  data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">
		Create <span class="d-none d-sm-inline ps-2">New</span>
	</a>
	<!--end::Action-->
</div>
<!--end::Header wrapper-->            </div>
            <!--end::Header container-->
            </div>
<!--end::Header-->
