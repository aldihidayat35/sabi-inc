<!--begin::Sidebar menu-->
<div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
    class="menu menu-column menu-rounded menu-sub-indention menu-active-bg">
    <div class="separator "></div>

    <!--begin::General Section-->
    <div class="menu-section">
        <h4 class="menu-text text-muted fw-bold px-3">General</h4>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <a href="{{ url('/dashboard') }}" class="menu-link">
                <span class="menu-icon"><i class="ki-solid ki-home-2 fs-2"></i></span>
                <span class="menu-title">Home</span>
            </a>
        </div>
    </div>
    <!--end::General Section-->

    <!--begin::Management Section-->
    @if (auth('teacher')->check() && auth('teacher')->user()->level === 'admin')
        <div class="menu-section mt-5">
            <h4 class="menu-text text-muted fw-bold px-3">Management</h4>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route('applications.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear fs-2"></i></span>
                    <span class="menu-title">Manajemen Aplikasi</span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route('teachers.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-person fs-2"></i></span>
                    <span class="menu-title">Teachers</span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route('students.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-people fs-2"></i></span>
                    <span class="menu-title">Students</span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route('categories.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-tags fs-2"></i></span>
                    <span class="menu-title">Categories</span>
                </a>
            </div>
        </div>
    @endif
    <!--end::Management Section-->
    @if (auth('teacher')->check())

        <!--begin::Content Section-->
        <div class="menu-section mt-5">
            <h4 class="menu-text text-muted fw-bold px-3">Content</h4>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route('works.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-journal-text fs-2"></i></span>
                    <span class="menu-title">Works</span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <a href="{{ route('works.score.page') }}" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-star-half fs-2"></i></span>
                    <span class="menu-title">Penilaian Work</span>
                </a>
            </div>

            @if (auth('teacher')->check() && auth('teacher')->user()->level === 'admin')
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <a href="{{ route('challenges.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="bi bi-trophy fs-2"></i></span>
                        <span class="menu-title">Challenges</span>
                    </a>
                </div>
            @endif
    @endif

</div>
<!--end::Content Section-->
@if (auth('teacher')->check())
    <!--begin::LMS Section-->
    <div class="menu-section mt-5">
        <h4 class="menu-text text-muted fw-bold px-3">LMS</h4>
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <span class="menu-link">
                <span class="menu-icon"><i class="bi bi-book fs-2"></i></span>
                <span class="menu-title">LMS</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a href="{{ route('topics.index') }}" class="menu-link">
                        <span class="menu-bullet"><i class="bi bi-circle fs-6"></i></span>
                        <span class="menu-title">Topics</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('materials.index') }}" class="menu-link">
                        <span class="menu-bullet"><i class="bi bi-circle fs-6"></i></span>
                        <span class="menu-title">Materials</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--end::LMS Section-->
@endif
<!--begin::Frontend Section-->
<div class="menu-section mt-5">
    <h4 class="menu-text text-muted fw-bold px-3">Frontend</h4>
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
        <span class="menu-link">
            <span class="menu-icon"><i class="bi bi-globe fs-2"></i></span>
            <span class="menu-title">Frontend</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a href="{{ route('frontend.home') }}" class="menu-link">
                    <span class="menu-bullet"><i class="bi bi-circle fs-6"></i></span>
                    <span class="menu-title">Home</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!--end::Frontend Section-->

</div>
<!--end::Sidebar menu-->
<!--begin::Separator-->
<div class="separator mx-10"></div>
<!--end::Separator-->
