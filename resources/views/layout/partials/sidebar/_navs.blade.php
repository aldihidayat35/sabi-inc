<!--begin::Navs-->
<div class="app-sidebar-navs flex-column-fluid mx-2 py-6" id="kt_app_sidebar_navs">
	<div
		id="kt_app_sidebar_navs_wrappers"
		class="hover-scroll-y my-2"
        data-kt-scroll="true"
        data-kt-scroll-activate="true"
        data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_header, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_navs"
        data-kt-scroll-offset="5px">
@include('layout/partials/sidebar/_navs/_quick-links')
@include('layout/partials/sidebar/_navs/_menu')
@include('layout/partials/sidebar/_navs/_projects')
	</div>
</div>
<!--end::Navs-->
