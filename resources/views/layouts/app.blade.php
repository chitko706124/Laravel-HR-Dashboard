<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    {{-- <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- Argon --}}
    <link rel="stylesheet" href="{{ asset('vendor/argon-design-system.min.css') }}">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

    <!-- MDB -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" /> --}}

    {{-- Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">

    {{-- Daterang Picker --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    {{-- Flatpiker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />



    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        p {
            margin-bottom: 0 !important;
        }

        .row {
            margin: 0 !important;
        }
    </style>
    @yield('style')
</head>

<body>

    @include('layouts.sidebar')

    <div id="app">
        @include('layouts.header')

        <main style="height: 90vh;overflow:auto">
            <div class=" row justify-content-center " style="padding-top: 80px">
                <div class=" col-md-8">
                    @yield('content')
                </div>
            </div>
        </main>

        @include('layouts.bottom')

    </div>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- Argon  --}}
    <script src="{{ asset('vendor/argon-design-system.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker.min.js') }}"></script>

    <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script> --}}

    {{-- Datatable --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.7/features/searchHighlight/dataTables.searchHighlight.min.js">
    </script>
    <script src="https://bartaz.github.io/sandbox.js/jquery.highlight.js"></script>

    {{-- Daterang Picker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>



    {{-- Js Validation --}}
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Flatpiker --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <script src="{{ asset('vendor/webauthn/webauthn.js') }}"></script>


    <script>
        $(document).ready(function() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF_TOKEN': token.content
                    }
                })
            }

            $.extend(true, $.fn.dataTable.defaults, {
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                searchHighlight: true,
                columnDefs: [{
                        targets: "hidden",
                        visible: false,
                    },
                    {
                        targets: "no-sort",
                        sortable: false,
                    }
                ],
                language: {
                    paginate: {
                        'next': '<i class="fa fa-angle-right"></i>',
                        'previous': '<i class="fa fa-angle-left"></i>'
                    }
                }
            });

            $('.open-btn').on('click', function() {
                var sideNav = document.getElementById('side_nav');

                if (sideNav.classList.contains('activeSidebar')) {
                    $('.sidebar').removeClass('activeSidebar');
                } else {
                    $('.sidebar').addClass('activeSidebar');
                }
            });

            $('.back-btn').on('click', function() {
                window.history.go(-1);
                return false;
            })


            $('.close-btn').on('click', function() {
                $('.sidebar').removeClass('activeSidebar');
            })


            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            @if (session('create'))
                Toast.fire({
                    icon: "success",
                    title: "{{ session('create') }}"
                });
            @endif

            $(".select-2").select2({
                theme: "bootstrap-5",
            });

            $(".selectNoSearch").select2({
                theme: "bootstrap-5",
                allowClear: true,
                minimumResultsForSearch: Infinity // Hide the search box
            });

        })
    </script>

    @yield('js')
</body>

</html>
