<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Swiper demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- Demo styles -->
  <style>
    html,
    body {
      position: relative;
      height: 100%;
    }

    body {
      background: #eee;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #000;
      margin: 0;
      padding: 0;
    }

    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
/*      display: block;*/
      width: 100vw;
      height: 100vh;
      object-fit: cover;
    }
    .swiper-slide .content {
        position: absolute;
        width: 95vw;
        height: 80vh;
        /*color: #fff;
        background: #000;*/

    }
    .content li {
        text-align: left;
        font-size: 18pt;
        margin-left: 5vw;
        text-transform: uppercase;
        line-height: 8vh;
    }
    .imgcontent {
        position: relative;
    }
    .cimg img {
        padding: 10px 20px;
        margin-left: 5vw;
        width: 80%;
        height: 80vh;
/*        border-radius: 40px;*/
    }
    .day {

        position: absolute;
        margin-top: 65vh;
        margin-left: 25vw;
        width: 20vw;
        color: #000;
        padding: 1vh 0;
        
/*        border-radius: 20px;*/
        border: 1px solid #0d2273;

    }
    
    .title {
        padding: 1%;
        background: #0d2273;
        color:#fff;
        border-radius: 150px;
        font-size: 38pt;
    }

    .autoplay-progress {
      position: absolute;
      right: 16px;
      bottom: 16px;
      z-index: 10;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: var(--swiper-theme-color);
    }

    .autoplay-progress svg {
      --progress: 0;
      position: absolute;
      left: 0;
      top: 0px;
      z-index: 10;
      width: 100%;
      height: 100%;
      stroke-width: 4px;
      stroke: var(--swiper-theme-color);
      fill: none;
      stroke-dashoffset: calc(125.6 * (1 - var(--progress)));
      stroke-dasharray: 125.6;
      transform: rotate(-90deg);
    }

  </style>
</head>

<body>
  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      
      <!-- @forelse($simenus as $simenu)
      
      <div class="swiper-slide">
          <img src="{{asset('sliders/Slide1.JPG')}}">
      </div>
      @empty
      @endforelse -->
      @php
        $i = 0;
        $j = 0;
      @endphp
      @forelse($masters as $master)
      
      <div class="swiper-slide">
        <img src="{{asset('sliders/banner2.png')}}">
        <div class=" content">
            <div class="row">
                <div class="col-lg-6">
                    
                    <div class="title">
                        {{$banners[$i]->day_type." 's Menu"}}
                    </div>
                    <div class="mt-3">
                        <ul>
                            @foreach(explode(',', $master->menu->description) as $item)
                                <li>{{ trim($item) }}</li>
                            @endforeach
                        </ul>

                        <!-- {{$master->menu->description}} -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="imgcontent">
                        <div class="day card shadow fw-bold text-center"><span style="color: #0d2273;font-size: 20pt;">{{dayFormat($master->day)}}</span>Special Meal</div>
                        <div class="cimg"><img src="{{$master->menu->imageurl}}"></div>   
                    </div>
                </div>
                
                
            </div>
        </div>
          @php $i++ @endphp

          
      </div>
      @empty
      @endforelse
      @forelse($simenus as $simenu)
      
      <div class="swiper-slide">

          <img src="{{asset('sliders/banner1.png')}}">
          <div class=" content">
            <div class="row">
                <div class="col-lg-6">
                    
                    <div class="title">
                        {{$banners[$j]->day_type." 's Menu"}}
                    </div>
                    <div class="mt-3">
                        <ul>
                            <li>{{$simenu->sambar}}</li>
                            <li>{{$simenu->rasam}}</li>
                            <li>{{$simenu->poriyal}}</li>
                        </ul>

                        <!-- {{$master->menu->description}} -->
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
            </div>
          </div>
      </div>
      @php $j++ @endphp
      @empty
      @endforelse
      <div class="swiper-slide">
        <img src="{{asset('sliders/Slide5.JPG')}}">
      </div>
      
    </div>
    <!-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div> -->
    <div class="swiper-pagination"></div>
    <div class="autoplay-progress">
      <svg viewBox="0 0 48 48">
        <circle cx="24" cy="24" r="20"></circle>
      </svg>
      <span></span>
    </div>
  </div>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    const progressCircle = document.querySelector(".autoplay-progress svg");
    const progressContent = document.querySelector(".autoplay-progress span");
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      on: {
        autoplayTimeLeft(s, time, progress) {
          progressCircle.style.setProperty("--progress", 1 - progress);
          progressContent.textContent = `${Math.ceil(time / 1000)}s`;
        }
      }
    });
  </script>
</body>

</html>