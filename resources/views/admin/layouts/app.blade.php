<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.partials.head')
</head>
<body>
  <div class="container-scroller">
    <!-- Header Section -->
    @include('admin.layouts.header')
    <!-- End Header Section -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.layouts.sidebar')
      <!-- partial -->
      @yield('content')
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  @include('admin.partials.script')
</body>

</html>

