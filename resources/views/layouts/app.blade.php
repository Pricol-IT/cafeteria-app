<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="{{asset('icon/favicon.ico')}}" rel="icon">
  <link href="{{asset('icon/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <title>@yield('title') - {{ config('app.name') }}</title>
  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  
@include('parts.links')
@yield('links')
  <!-- Vendor CSS Files -->
  <script>
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["setDomains", ["*.cafeteria.mypricol.in"]]);
  _paq.push(["disableCookies"]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//matomo.mypricol.in/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '2']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img referrerpolicy="no-referrer-when-downgrade" src="//matomo.mypricol.in/matomo.php?idsite=2&amp;rec=1" style="border:0;" alt="" /></p></noscript>
</head>

<body oncontextmenu="return false;">
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