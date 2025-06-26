<div class="d-flex align-items-center justify-content-between mb-5">
    <h1 class="text-dark fw-bolder my-1">@yield('title')</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('/') }}" class="text-muted text-hover-primary">Home</a>
        </li>
        @yield('breadcrumb')
    </ul>
</div>
