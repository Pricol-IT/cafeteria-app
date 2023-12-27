<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{asset('icon/favicon.ico')}}" rel="icon">
  <link href="{{asset('icon/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <title>Login - {{ config('app.name') }}</title>
    <style type="text/css">
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

    </style>
    
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <section>
      <div class="container p-3">
        <h1 class="text-white text-center p-3 fw-bold fst-italic">Cafeteria</h1>
        <div class="loginBox d-flex justify-content-center">
          <div class="loginCard p-4 bg-white rounded shadow">
            <div class="logo text-center p-3">
              <img src="{{asset('img/pricol_logo.png') }}" alt="logo" width="" />
            </div>
            <form method="POST" action="{{ route('login') }}" class="p-3">
            @csrf
            
              <div class="row p-3">
                
                <input id="emp_id" type="text" class="form-control  @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ old('emp_id') }}"  autocomplete="emp_id" autofocus placeholder="Username">

                    @error('emp_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="row p-3">
                
                <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>

              <div class="row mb-3 p-3">
                @if (Route::has('password.request'))
                    <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a> -->
                @endif
                <button
                  type="submit"
                  class="btn btn-primary form-control form-control-lg"
                >
                  Login
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

