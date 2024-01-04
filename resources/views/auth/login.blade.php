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
        <div class="col-lg-6 col-md-6">
          <div class="cv">
            <div class="p-3 ">
              <div class="row mt-lg-5 smv">
                  <div class="col-lg-8 offset-lg-2 mt-3 mt-lg-5">
                    <h1 class="text-primary  fw-bold fst-italic">My Pricol</h1>
                    <h6 class="fw-bold">Cafeteria Log in</h6>
                    <span class="text-secondary">Welcome back! Please enter your details</span>
                <form method="POST" action="{{ route('login') }}" class="p-3">
                  @csrf
                
                  <div class="row mb-3">
                    <label class="h6">Username</label>
                    <input id="emp_id" type="text" class="form-control form-rounded @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ old('emp_id') }}"  autocomplete="emp_id" autofocus placeholder="Username" >

                        @error('emp_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                  </div>
                  <div class="row">
                    <label class="h6">Password</label>
                    <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                  </div>

                  <div class="row ">
                    @if (Route::has('password.request'))
                        <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a> -->
                    @endif

                    <input type="submit" name="Login" class="btn btn-primary mt-4" value="Login">
                    
                  </div>
                </form>
                  </div>
              </div>
                
            </div>
            
          </div>
          
        </div>
        <div class="col-lg-6 col-md-6 gradient-custom-2"></div>
      </div>
    </section>

    
  </body>
</html>

