<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
  data-assets-path="{{ asset('/admin') }}/" data-template="vertical-menu-template-no-customizer">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>QUIZ</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/fonts/tabler-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <!-- Page CSS -->
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  </head>

  <body>
    <script>
      @if (\Session::has('success'))
        Swal.fire(
          'Success',
          '{!! \Session::get('success') !!}',
          'success'
        )
      @elseif (\Session::has('error'))
        Swal.fire(
          'Opps!',
          '{!! \Session::get('error') !!}',
          'error'
        )
      @endif
    </script>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include('layouts_dashboard.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('layouts_dashboard.navbar')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            @yield('content')
            <!-- / Content -->

            <!-- Footer -->
            @include('layouts_dashboard.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js admin/vendor/js/core.js') }} -->
    <script src="{{ asset('admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('admin/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin/vendor/libs/swiper/swiper.js') }}"></script>

    <script src="{{ asset('admin/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('admin/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('admin/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('admin/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('admin/js/forms-selects.js') }}"></script>
    <script src="{{ asset('admin/js/dashboards-analytics.js') }}"></script>

    @include('layouts_dashboard.metascript')
    @include('layouts_dashboard.script')

    @stack('script')
  </body>

</html>
