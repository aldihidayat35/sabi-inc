<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: MetronicProduct Version: 8.2.9
Purchase: https://1.envato.market/Vm7VRE
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <title>{{ config('app.name', 'sabi.inc') }} - @yield('title')</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="
            The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo,
            Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions.
            Grab your copy now and get life-time updates for free.
        " />
    <meta name="keywords"
        content="
            tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js,
            Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates,
            free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button,
            bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon
        " />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - The World's #1 Selling Tailwind CSS & Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="http://preview.keenthemes.com?page=index" />
    <link rel="shortcut icon" href="{{ asset('uploads/Logo-2.png') }}" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets2/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets2/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script src="{{ asset('assets2/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets2/js/scripts.bundle.js') }}"></script>
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>

</head>

<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="false"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    class="app-default">

    <!--begin::Top Navigation (Desktop only)-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white d-none d-lg-block shadow-sm border-bottom"
        style="z-index:1050;">
        <div class="container-xxl">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('frontend.home') }}">
                <img src="{{ asset('sabi.inc.png') }}" alt="Logo" height="38" class="rounded shadow-sm"
                    style="background:#fff;">
                <span class="fw-bold fs-5 text-dark"></span>
            </a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 flex-row gap-2 align-items-center">
                <li class="nav-item">
                    <a href="{{ route('frontend.home') }}"
                        class="nav-link px-3 py-2 rounded {{ request()->routeIs('frontend.home') ? 'active fw-semibold text-primary bg-light' : 'text-dark' }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('frontend.works.index') }}"
                        class="nav-link px-3 py-2 rounded {{ request()->routeIs('frontend.works.index') ? 'active fw-semibold text-primary bg-light' : 'text-dark' }}">
                        <i class="bi bi-briefcase me-1"></i> Works
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('frontend.lms.topics') }}"
                        class="nav-link px-3 py-2 rounded {{ request()->routeIs('frontend.lms.topics') ? 'active fw-semibold text-primary bg-light' : 'text-dark' }}">
                        <i class="bi bi-journal-bookmark me-1"></i> Lms
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('frontend.challenges.list') }}"
                        class="nav-link px-3 py-2 rounded {{ request()->routeIs('frontend.challenges.list') ? 'active fw-semibold text-primary bg-light' : 'text-dark' }}">
                        <i class="bi bi-flag me-1"></i> Tantangan
                    </a>
                </li>
                {{-- Profil/Login logic --}}
                @if (Auth::guard('student')->check())
                    <li class="nav-item">
                        <a href="{{ route('frontend.profil') }}"
                            class="nav-link px-3 py-2 rounded {{ request()->routeIs('frontend.profil') ? 'active fw-semibold text-primary bg-light' : 'text-dark' }}">
                            <i class="bi bi-person me-1"></i> Profil
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('student.login') }}" class="nav-link px-3 py-2 rounded text-dark">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <!--end::Top Navigation (Desktop only)-->
    <style>
        .navbar-nav .nav-link {
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            font-size: 1rem;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link:focus {
            background: #f1faff;
            color: #009ef7 !important;
            box-shadow: 0 2px 8px rgba(0, 158, 247, 0.07);
            font-weight: 600;
        }

        .navbar-brand img {
            transition: box-shadow 0.2s;
        }

        .navbar-brand:hover img {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
    </style>

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root" style="background-color: #ffffff;">
        <!--begin::Page-->
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
            {{-- @include('layout/partials/_header') --}}
            <!--begin::Wrapper-->
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
                <!--begin::Wrapper container-->
                <div class="app-container  container-xxl d-flex flex-row-fluid ">
                    {{-- @include('layout/partials/_sidebar') --}}
                    <!--begin::Main-->
                    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                        <!--begin::Content wrapper-->
                        <div class="d-flex flex-column flex-column-fluid">
                            {{-- @include('layout/partials/_toolbar') --}}


                            {{-- @include('layout/partials/_content') --}}

                            <!--begin::Content-->
                            <main class="py-4">
                                @yield('content')
                            </main>
                            <!--end::Content-->

                        </div>
                        <!--end::Content wrapper-->
                        @include('layout/partials/_footer')
                    </div>
                    <!--end:::Main-->
                </div>
                <!--end::Wrapper container-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!-- Floating Create Work Button -->
    <a href="{{ route('frontend.works.create') }}" id="floating-create-work-btn" class="floating-create-work-btn"
        title="Buat Karya">
        <span class="plus-icon" style="padding:-2">+</span>
    </a>

    <style>
        .floating-create-work-btn {
            position: fixed;
            right: 24px;
            bottom: 80px;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background-color: #00B2FF;
            /* warna biru sesuai gambar */
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1051;
            text-decoration: none;
            transition: background-color 0.2s, transform 0.2s;
        }

        .floating-create-work-btn:hover {
            background-color: #009ee0;
            transform: scale(1.05);
        }

        .floating-create-work-btn .plus-icon {
            color: white;
            font-size: 2.5rem;
            font-weight: 600;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 991.98px) {
            .floating-create-work-btn {
                width: 56px;
                height: 56px;
                bottom: 72px;
            }

            .floating-create-work-btn .plus-icon {
                font-size: 2.2rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('floating-create-work-btn');
            if (btn) {
                const isCreatePage = window.location.pathname ===
                    "{{ route('frontend.works.create', [], false) }}";
                if (!isCreatePage) {
                    btn.style.display = 'flex';
                }
            }
        });
    </script>


    <!--begin::Bottom Navigation-->
    @php
        // Cek apakah ada menu yang aktif
        $isActive =
            request()->routeIs('frontend.works.index') ||
            request()->routeIs('frontend.lms.topics') ||
            request()->routeIs('frontend.challenges.list') ||
            request()->routeIs('frontend.profil') ||
            request()->routeIs('student.login');
    @endphp


    <nav class="pb-2 navbar navbar-light bg-light lg fixed-bottom d-lg-none animate__animated animate__fadeInUp"
        style="animation-duration: 0.7s;">
        <div class="container d-flex justify-content-around align-items-end pb-4" style="height: 50px;">
            <a href="{{ route('frontend.works.index') }}"
                class="text-center text-decoration-none nav-link-animate nav-link-bottom {{ request()->routeIs('frontend.works.index') ? 'active' : '' }}">
                <div class="nav-icon-wrapper ">
                    <i class="bi bi-briefcase fs-2"></i>
                </div>
            </a>

            <a href="{{ route('frontend.lms.topics') }}"
                class="text-center text-decoration-none nav-link-animate nav-link-bottom {{ request()->routeIs('frontend.lms.topics') ? 'active' : '' }}">
                <div class="nav-icon-wrapper">
                    <i class="bi bi-journal-bookmark fs-2"></i>
                </div>
            </a>
            <a href="{{ route('frontend.home') }}"
                class="text-center text-decoration-none nav-link-animate nav-link-bottom
                    {{ !$isActive || request()->routeIs('frontend.home') ? 'active' : '' }}">
                <div class="nav-icon-wrapper">
                    <i class="bi bi-house-door fs-2"></i>
                </div>
            </a>
            <a href="{{ route('frontend.challenges.list') }}"
                class="text-center text-decoration-none nav-link-animate nav-link-bottom {{ request()->routeIs('frontend.challenges.list') ? 'active' : '' }}">
                <div class="nav-icon-wrapper">
                    <i class="bi bi-flag fs-2"></i>
                </div>
            </a>
            {{-- Profil/Login logic --}}
            @if (Auth::guard('student')->check())
                <a href="{{ route('frontend.profil') }}"
                    class="text-center text-decoration-none nav-link-animate nav-link-bottom {{ request()->routeIs('frontend.profil') ? 'active' : '' }}">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-person fs-2"></i>
                    </div>
                </a>
            @else
                <a href="{{ route('student.login') }}"
                    class="text-center text-decoration-none nav-link-animate nav-link-bottom {{ request()->routeIs('student.login') ? 'active' : '' }}">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-box-arrow-in-right fs-2"></i>
                    </div>
                </a>
            @endif
        </div>
    </nav>
    <!--end::Bottom Navigation-->

    <style>
        .nav-link-bottom {
            border-radius: 12px;
            padding: 0 10px 0 10px;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 62px;
            justify-content: flex-end;
            position: relative;
            z-index: 2;
        }

        .nav-link-bottom .nav-icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: transparent;
            transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
            margin-bottom: 2px;
            box-shadow: none;
            position: relative;
            z-index: 2;
        }

        .nav-link-bottom.active .nav-icon-wrapper,
        .nav-link-bottom:active .nav-icon-wrapper,
        .nav-link-bottom:focus .nav-icon-wrapper {
            background: #009ef7;
            color: #fff !important;
            box-shadow: 0 4px 24px rgba(0, 158, 247, 0.18);
            animation: bounceActive 0.4s;
            transform: translateY(-40px) scale(1.18);
            border-radius: 50%;
            border: 4px solid #FFFDE7;
            /* Cream outline */
            z-index: 3;
        }

        .nav-link-bottom.active,
        .nav-link-bottom:active,
        .nav-link-bottom:focus {
            background: transparent;
            color: #009ef7 !important;
        }

        .nav-link-bottom.active i,
        .nav-link-bottom:active i,
        .nav-link-bottom:focus i {
            color: #fff !important;
        }

        .nav-link-bottom.active p,
        .nav-link-bottom:active p,
        .nav-link-bottom:focus p {
            color: #009ef7 !important;
        }

        .nav-link-bottom .nav-icon-wrapper i {
            transition: color 0.2s, transform 0.2s;
            font-size: 8px !important;
            /* Bigger icon */
        }

        @keyframes bounceActive {
            0% {
                transform: translateY(0) scale(1);
            }

            30% {
                transform: translateY(-36px) scale(1.22);
            }

            60% {
                transform: translateY(-20px) scale(0.98);
            }

            100% {
                transform: translateY(-40px) scale(1.18);
            }
        }

        @media (max-width: 575.98px) {
            .navbar.fixed-bottom {
                padding-bottom: env(safe-area-inset-bottom, 0);
            }

            .nav-link-bottom {
                font-size: 13px;
                padding: 0px 6px 0 6px;
                height: 54px;
            }

            .nav-link-bottom .nav-icon-wrapper {
                width: 48px;
                height: 48px;
            }

            .nav-link-bottom .nav-icon-wrapper i {
                font-size: 2rem !important;
            }

            .nav-link-bottom.active .nav-icon-wrapper,
            .nav-link-bottom:active .nav-icon-wrapper,
            .nav-link-bottom:focus .nav-icon-wrapper {
                transform: translateY(-26px) scale(1.13);
                border-width: 3px;
            }

            @keyframes bounceActive {
                0% {
                    transform: translateY(0) scale(1);
                }

                30% {
                    transform: translateY(-22px) scale(1.18);
                }

                60% {
                    transform: translateY(-10px) scale(0.97);
                }

                100% {
                    transform: translateY(-26px) scale(1.13);
                }
            }
        }
    </style>


    <script>
        // Interaktif: highlight active nav on click (for links without route)
        document.addEventListener('DOMContentLoaded', function() {
                    const navLinks = document.querySelectorAll('.nav-link-bottom');
                    navLinks.forEach(link => {
                        link.addEventListener('click', function() {
                            navLinks.forEach(l => l.classList.remove('active'));
                            this.classList.add('active');
                        });
                    });
    </script>
    });
    </script>

    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        .nav-link-animate {
            transition: transform 0.2s, color 0.2s;
        }

        .nav-link-animate:hover i,
        .nav-link-animate:focus i {
            color: #009ef7;
            transform: scale(1.2) rotate(-8deg);
        }

        .nav-link-animate:hover p,
        .nav-link-animate:focus p {
            color: #009ef7;
        }

        .navbar.fixed-bottom {
            box-shadow: 0 -2px 16px rgba(0, 0, 0, 0.08);
        }
    </style>

    <!--end::App-->
    @include('partials/_drawers')
    <!--end::Modals-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ asset('assets2/') }}";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets2/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets2/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets2/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="{{ asset('assets2/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets2/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/utilities/modals/create-campaign.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/utilities/modals/offer-a-deal/type.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/utilities/modals/offer-a-deal/details.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/utilities/modals/offer-a-deal/finance.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/utilities/modals/offer-a-deal/complete.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/utilities/modals/offer-a-deal/main.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets2/js/custom/utilities/modals/users-search.js') }}"></script>
    @yield('scripts')

    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>

</body>

</html>
