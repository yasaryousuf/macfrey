<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin Free Bootstrap Admin Dashboard Template</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('admin')}}/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{asset('admin')}}/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="{{asset('admin')}}/vendors/css/vendor.bundle.addons.css">
  
  
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('/css/custom-admin.css')}}">
  <link rel="stylesheet" href="{{asset('admin')}}/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('admin')}}/images/favicon.png" />
  
  <script src="{{asset('admin')}}/js/jquery-3.3.1.min.js"></script>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin.includes.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
        
    @include('admin.includes.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.includes.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  @yield('script')
  <!-- plugins:js -->
  <script src="{{asset('admin')}}/vendors/js/vendor.bundle.base.js"></script>
  <script src="{{asset('admin')}}/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('admin')}}/js/off-canvas.js"></script>
  <script src="{{asset('admin')}}/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('admin')}}/js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>