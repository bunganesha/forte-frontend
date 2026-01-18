<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('../assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('../assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link id="pagestyle" href="{{ asset('../assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link href="{{ asset('../assets/css/custom.css') }}" rel="stylesheet" />

    @stack('styles')
</head>

<body class="g-sidenav-show bg-dark text-white dark-version">

    <!-- FORM LOGOUT (HIDDEN) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    @include('layouts.sidebar')

    <main class="main-content position-relative border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="false">

            <div class="container-fluid py-1 px-3">

                <!-- LEFT -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-white" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-white active">
                            @yield('title', 'Dashboard')
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">
                        @yield('title', 'Dashboard')
                    </h6>
                </nav>

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end">
                    <ul class="navbar-nav justify-content-end">

                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center me-3">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item dropdown d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0"
                                data-bs-toggle="dropdown">
                                <i class="fa fa-user me-sm-1"></i>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="Iconly/Regular/Outline/Profile">
                                        <g id="Profile">
                                            <g id="Group 6">
                                                <g id="Union">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.8889 12.6188H11.9209C14.8489 12.6188 17.2299 10.2378 17.2299 7.30976C17.2299 4.38176 14.8489 1.99976 11.9209 1.99976C8.99189 1.99976 6.60989 4.38176 6.60989 7.30676C6.59989 10.2268 8.9669 12.6098 11.8889 12.6188ZM8.03789 7.30976C8.03789 5.16876 9.77989 3.42776 11.9209 3.42776C14.0609 3.42776 15.8019 5.16876 15.8019 7.30976C15.8019 9.44976 14.0609 11.1918 11.9209 11.1918H11.8919C9.75989 11.1838 8.03089 9.44376 8.03789 7.30976Z"
                                                        fill="black" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.99988 18.1731C3.99988 21.8701 9.96188 21.8701 11.9209 21.8701C15.3199 21.8701 19.8399 21.4891 19.8399 18.1931C19.8399 14.4961 13.8799 14.4961 11.9209 14.4961C8.52088 14.4961 3.99988 14.8771 3.99988 18.1731ZM5.49988 18.1731C5.49988 16.7281 7.65988 15.9961 11.9209 15.9961C16.1809 15.9961 18.3399 16.7351 18.3399 18.1931C18.3399 19.6381 16.1809 20.3701 11.9209 20.3701C7.65988 20.3701 5.49988 19.6311 5.49988 18.1731Z"
                                                        fill="black" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>


                                <span class="d-sm-inline d-none">Profile</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                @hasanyrole('user')
                                    <li>
                                        <a class="dropdown-item border-radius-md text text-white" href="{{ route('settings.index') }}">
                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M18.2783 6.09554L17.6559 5.01545C17.1293 4.10153 15.9624 3.78624 15.0472 4.31064V4.31064C14.6116 4.56727 14.0918 4.64008 13.6024 4.51301C13.113 4.38594 12.6943 4.06944 12.4385 3.6333C12.274 3.35607 12.1856 3.04032 12.1822 2.71796V2.71796C12.1971 2.20115 12.0021 1.70033 11.6417 1.32959C11.2813 0.958861 10.7862 0.749787 10.2692 0.75H9.01518C8.50865 0.749994 8.02299 0.951838 7.66568 1.31087C7.30837 1.6699 7.10885 2.15652 7.11129 2.66304V2.66304C7.09628 3.70885 6.24416 4.54873 5.19825 4.54863C4.87589 4.54528 4.56014 4.45687 4.28291 4.29233V4.29233C3.36774 3.76794 2.20079 4.08322 1.67422 4.99714L1.00603 6.09554C0.48009 7.00832 0.79108 8.17453 1.70168 8.70423V8.70423C2.29358 9.04596 2.65821 9.67751 2.65821 10.361C2.65821 11.0445 2.29358 11.676 1.70168 12.0177V12.0177C0.792236 12.5439 0.480907 13.7073 1.00603 14.6173V14.6173L1.63761 15.7065C1.88433 16.1517 2.29828 16.4802 2.78787 16.6194C3.27746 16.7585 3.80232 16.6968 4.2463 16.4479V16.4479C4.68276 16.1933 5.20287 16.1235 5.69102 16.2541C6.17917 16.3848 6.59492 16.705 6.84584 17.1436C7.01038 17.4208 7.09879 17.7366 7.10214 18.0589V18.0589C7.10214 19.1155 7.95863 19.972 9.01518 19.972H10.2692C11.3222 19.972 12.1772 19.121 12.1822 18.0681V18.0681C12.1798 17.56 12.3805 17.0719 12.7398 16.7126C13.0991 16.3534 13.5872 16.1526 14.0953 16.155C14.4169 16.1636 14.7313 16.2517 15.0106 16.4113V16.4113C15.9234 16.9373 17.0896 16.6263 17.6193 15.7157V15.7157L18.2783 14.6173C18.5334 14.1794 18.6034 13.6579 18.4729 13.1683C18.3423 12.6787 18.0219 12.2613 17.5827 12.0086V12.0086C17.1434 11.7559 16.8231 11.3385 16.6925 10.8489C16.5619 10.3592 16.6319 9.83774 16.887 9.39989C17.0529 9.11026 17.2931 8.87012 17.5827 8.70423V8.70423C18.4878 8.17482 18.7981 7.01542 18.2783 6.10469V6.10469V6.09554Z"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <circle cx="9.64665" cy="10.361" r="2.63616" stroke="white"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>

                                            <i class="fa fa-sign-out-alt me-2"></i>Settings
                                        </a>
                                    </li>
                                @endhasanyrole
                                <li>
                                    <a class="dropdown-item border-radius-md text-danger" href="javascript:void(0)"
                                        onclick="confirmLogout()">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g transform="translate(-3, 0)">
                                                <g id="Iconly/Regular/Light/Login">
                                                    <g id="Login">
                                                        <path id="Stroke 1" d="M15.8125 12.0218H3.77148" stroke="red"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path id="Stroke 3"
                                                            d="M12.8848 9.10577L15.8128 12.0218L12.8848 14.9378"
                                                            stroke="red" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path id="Stroke 4"
                                                            d="M8.50439 7.38897V6.45597C8.50439 4.42097 10.1534 2.77197 12.1894 2.77197H17.0734C19.1034 2.77197 20.7484 4.41697 20.7484 6.44697V17.587C20.7484 19.622 19.0984 21.272 17.0634 21.272H12.1784C10.1494 21.272 8.50439 19.626 8.50439 17.597V16.655"
                                                            stroke="red" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>

                                        <i class="fa fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('../assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('../assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

    @stack('scripts')

    <script>
        var iconNavbarSidenav = document.getElementById('iconNavbarSidenav');
        var iconSidenav = document.getElementById('iconSidenav');
        var sidenav = document.getElementById('sidenav-main');
        var body = document.getElementsByTagName('body')[0];
        var className = 'g-sidenav-pinned';

        if (iconNavbarSidenav) {
            iconNavbarSidenav.addEventListener("click", toggleSidenav);
        }

        if (iconSidenav) {
            iconSidenav.addEventListener("click", toggleSidenav);
        }

        function toggleSidenav() {
            if (body.classList.contains(className)) {
                body.classList.remove(className);
                setTimeout(function() {
                    sidenav.classList.remove('bg-white');
                }, 100);
                sidenav.classList.remove('bg-transparent');
            } else {
                body.classList.add(className);
                sidenav.classList.add('bg-white');
                sidenav.classList.remove('bg-transparent');
                if (iconSidenav) {
                    iconSidenav.classList.remove('d-none');
                }
            }
        }
    </script>

    <!-- SWEETALERT LOGOUT -->
    <script>
        window.confirmLogout = function() {
            Swal.fire({
                title: 'Yakin ingin logout?',
                text: 'Kamu akan keluar dari sesi login.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>


</body>

</html>
