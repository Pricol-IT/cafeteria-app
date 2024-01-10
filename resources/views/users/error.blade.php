<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{asset('icon/favicon.ico')}}" rel="icon">
  <link href="{{asset('icon/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <title>Login - {{ config('app.name') }}</title>
    <!-- <style type="text/css">
      section {
          height: 100vh;
          background-image: linear-gradient(
              rgba(0, 114, 187, 0.7),
              rgba(0, 114, 187, 0.7)
            ),
            url("{{asset('img/cafeteria background.png')}}");
          background-size: cover;
        }

        .loginCard {
          width: 400px;
        }

    </style> -->
    <style>
      .cv {
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
            background-position: center center;
          background-size: cover;
      }
      @media (max-width: 992px) {
       .smv {
        margin-top: 12vh!important;
       }
      }
  </style>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/mdb.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/style.css')}}" />
  </head>
  <body oncontextmenu="return false;">
      
    <section>
      <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="error-404 h1 text-center">
                <h1 class="text-primary fw-bold mt-5" style="font-size: 80pt;"> 404</h1>
                <h3 class="text-primary">The page you are looking for doesn't exist.</h3>
            </div>
            
        </div>
      </div>
    </section>

    
  </body>
</html>

