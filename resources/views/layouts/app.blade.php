<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') - {{ config('app.name') }}</title>
  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  
@include('parts.links')
@yield('links')
  <!-- Vendor CSS Files -->
  
</head>

<body>
    <!-- ======= Header ======= -->
@include('parts.header')
  
  <!-- ======= Sidebar ======= -->
@include('parts.sidebar')
@yield('main')
  

  
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Pricol</span></strong>
    </div>
    <div class="credits">
      Developed by IT Team Version-1,2023.
    </div>
  </footer>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
@include('parts.script')
@yield('script')
</body>

</html>