<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{asset('icon/favicon.ico')}}" rel="icon">
  <link href="{{asset('icon/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <title>Login - {{ config('app.name') }}</title>
    
    <style>
      body, section{
        margin: 0 auto;
      }
      .flexview 
      {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }
      
       input  {
        border-radius: 50px!important;
        height: 50px;
       }
      .gradient-custom-2 {
        background-image: 
            url("{{asset('assets/plugins/des-logo.png')}}");
            background-repeat: no-repeat;
            background-position: left center;
          background-size: cover;
      }
      
  </style>
  
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/mdb.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/style.css')}}" />
<!-- <script>
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["setCookieDomain", "*.cafeteria.mypricol.in"]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//matomo.mypricol.in/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '2']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script> -->
  </head>
  <body oncontextmenu="return false;">
      
    <section class="container-fluid">
      <div class="row ">
        <div class="col-lg-6 col-md-6">
          <div class="flexview">
            <div style="padding: 10px 3em;">
                
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                <div class="row">
                  <div class="col-lg-8 offset-lg-2  col-md-12 mb-3">
                    <h1 class="text-primary  fw-bold fst-italic">My Pricol</h1>
                    <h6 class="fw-bold">Cafeteria Log in</h6>
                    <span class="text-secondary ">Welcome back! Please enter your details</span>

                  </div>
                
                  <div class="col-lg-8 offset-lg-2  col-md-12 ">
                    <label class="h6">Username</label>
                    <input id="emp_id" type="text" class="form-control form-rounded @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ old('emp_id') }}"  autocomplete="emp_id" autofocus placeholder="Username" >

                        @error('emp_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                  </div>
                  <div class="col-lg-8 offset-lg-2  col-md-12 ">
                    <label class="h6">Password</label>
                    <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                  </div>

                  <div class="col-lg-8 offset-lg-2  col-md-12 ">
                    @if (Route::has('password.request'))
                        <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a> -->
                    @endif
                    <br>
                    <input type="submit" name="Login" class="btn btn-primary form-control " value="Login">
                    
                  </div>
                </div>
                </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 gradient-custom-2"></div>
      </div>
    </section>

    
  </body>
</html>

