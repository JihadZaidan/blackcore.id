<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Blackcore Admin - @yield('title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/vendors/feather/feather.css">
  <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="/js/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('vendors/jquery-multiselect/jquery.multiselect.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="/css/admin-styles.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/images/logokecil.png" />
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  @stack('styles')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('partials.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('partials.settings-panel')
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @include('partials.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        {{-- <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a
                href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.
              All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                class="ti-heart text-danger ml-1"></i></span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a
                href="https://www.themewagon.com/" target="_blank">Themewagon</a></span>
          </div>
        </footer> --}}
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <input id="backbuttonstate" type="text" value="0" style="display:none;" />


  <!-- plugins:js -->
  <script src="/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="/vendors/chart.js/Chart.min.js"></script>
  <script src="/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="/js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="/js/off-canvas.js"></script>
  <script src="/js/hoverable-collapse.js"></script>
  <script src="/js/template.js"></script>
  <script src="/js/settings.js"></script>
  <script src="/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="/js/dashboard.js"></script>
  <script src="/js/Chart.roundedBarCharts.js"></script>
  <script src="{{ asset('vendors/jquery-multiselect/jquery.multiselect.js') }}"></script>
  <script src="{{ asset('vendors/tinymce/tinymce.min.js') }}"></script>
  <!-- End custom js for this page-->
  <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js "></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {

      var ibackbutton = document.getElementById("backbuttonstate");

      setTimeout(function() {

        if (ibackbutton.value == "0") {
          // Page has been loaded for the first time - Set marker
          ibackbutton.value = "1";

          @if (session()->has('success'))
            Swal.fire({
              title: 'Success',
              text: "{{ session('success') }}",
              icon: 'success',
              allowOutsideClick: false
            });
          @endif

          @if (session()->has('error'))
            Swal.fire({
              title: 'Error',
              text: "{{ session('error') }}",
              icon: 'error',
              allowOutsideClick: false
            });
          @endif
        } else {}

      }, 200);

    }, false);

    function stringToSlug(text) {
      return text.toLowerCase()
        .trim()
        .replace(/[^\a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    }

    document.querySelectorAll('[data-slug-target]').forEach((element) => {
      element.addEventListener('keyup', () => {
        let target = element.getAttribute('data-slug-target')
        document.querySelector(target).value = stringToSlug(element.value)
      })
    })
  </script>

  @stack('scripts')
</body>

</html>
