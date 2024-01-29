<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Swiper demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <!-- Demo styles -->
  <style>
    html,
    body {
      position: relative;
      height: 100vh;
    }

    body {
      background: #eee;
      font-family: Poppins;
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
        font-weight:700;
    }
    .imgcontent {
        position: relative;

    }
    .cimg img {
        padding: 10px 20px;
        margin-left: 2vw;
        width: 35vw;
        height: 85vh;
/*        border-radius: 10%;*/
        margin-top:-2vh;
    }
    .day {

        position: absolute;
        
        margin-top: 50vh;
        margin-left: 0vw;
        width: 30vw;
        height: 20vh;
        color: #000;
        z-index: 1;
        background: #fff;
        padding: 1vh 0;
        box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        border-radius: 2vh;
        font-size: 28pt;
/*        border: 1px solid #0d2273;*/

    }
/*.day1 {

        position: absolute;
        
        margin-top: 75vh;
        margin-left: 15vw;
        width: 25vw;
        height: 8vh;
        color: #000;
        z-index: 1;
        background: #fff;
        padding: 1vh 0;
        box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        border-radius: 2vh;
        font-size: 14pt;
        border: 1px solid #0d2273;

    }*/
    .day .qu {
        color: #fff;
        background: #0d2273;
/*        width: vw;*/
/*        height: 14vh;*/
/*        padding: 0.5vh 0;*/
        margin-left: -2vw;
        margin-top: 1vh;
        padding: 1vw;
        border-radius: 10px;
/*        text-align: center;*/
        font-size: 50px;
/*        font-weight: 700;*/
        float: left;
    }

    .day1 .qu {
        color: #fff;
        background: #0d2273;
/*        width: vw;*/
/*        height: 14vh;*/
/*        padding: 0.5vh 0;*/
        margin-right: -2vw;
        margin-top: 1vh;
        padding: 1vw;
        border-radius: 10px;
/*        text-align: center;*/
        font-size: 50px;
/*        font-weight: 700;*/
        float: right;
    }

    /*.qu svg {
        width: 5vw;
    }*/
    /*.title {
        padding: 1%;
        background: #0d2273;
        color:#fff;
        border-radius: 10px;
        font-size: 38pt;
        font-family: Open Sans;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        margin: 0 5%;
    }*/
    .title {
/*        padding: 1vh ;*/
        height: 15vh;
        background: #0d2273;
        color:#fff;
        border-radius: 10px;
        font-size: 38pt;
        font-weight: 600;
        font-family: Open Sans;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        position: relative;
        margin-bottom: 6vh;
    }
    .title1 {
/*        padding: 1vh ;*/
        height: 15vh;
        background: #fff;
        color:#0d2273;
        border-radius: 10px;
        font-size: 38pt;
        font-weight: 600;
        font-family: Open Sans;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        position: relative;
        margin-bottom: 6vh;
        margin-left: 8vh;
        margin-right: 8vh;
    }
    .sday
    {
        background: #0d2273;
        color: #fff;
        font-size: 20pt;
        align-items: center;
        margin: 0 20vh;
        padding: 0 1vw ;
/*        top:7vh;*/
        border-radius: 10px;
        text-align: center;

    }
    .spday
    {
        background: #fff;
        color: #0d2273;
        font-size: 20pt;
        font-weight: 600;
        align-items: center;
        margin: 0 20vh;
        padding: 0 1vw ;
/*        top:7vh;*/
        border-radius: 10px;
        text-align: center;
        border: 1px solid #0d2273;
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
.cl li {
    font-size: 24pt;
    line-height: 10vh;
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
        <img src="{{ $banners[$i]->spmurl }}">
        <div class=" content">
            <div class="row">
                <div class="col-lg-6">
                    @if($banners[$i]->day_type == 'Today')
                    <div class="title shadow">
                        {{$banners[$i]->day_type." 's Menu"}}
                        <div class="spday">
                        Special Meal
                        </div>
                    </div>
                    <div class="mt-3">
                        <ul>
                            @foreach(explode(',', $master->menu->description) as $item)
                                <li>{{ trim($item) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if($banners[$i]->day_type == 'Tomorrow')
                    <div class="imgcontent">
                        <!-- <div class="day1   fw-bold ">
                            
                                <div class="qu">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="4vw" height="8vh" viewBox="0 0 256.000000 256.000000" preserveAspectRatio="xMidYMid meet">

                                    <g transform="translate(0.000000,256.000000) scale(0.100000,-0.100000)" fill="#ffffff" stroke="none">
                                    <path d="M0 1760 l0 -480 316 0 317 0 -5 -67 c-10 -127 -72 -263 -170 -369 -94 -102 -256 -182 -390 -192 l-68 -5 0 -163 0 -164 53 0 c209 0 452 106 620 269 140 135 246 336 276 521 7 40 11 273 11 598 l0 532 -480 0 -480 0 0 -480z"/>
                                    <path d="M1600 1760 l0 -480 316 0 317 0 -5 -67 c-10 -127 -72 -263 -170 -369 -94 -102 -256 -182 -390 -192 l-68 -5 0 -163 0 -164 53 0 c209 0 452 106 620 269 140 135 246 336 276 521 7 40 11 273 11 598 l0 532 -480 0 -480 0 0 -480z"/>
                                    </g>
                                    </svg>
                                </div>
                                <span style="color: #0d2273;font-size: 14pt;"></span>&nbsp;<span style="font-size: 14pt;">Special Meal</span>
                            
                        </div> -->
                        <div class="cimg"><img src="{{$master->menu->imageurl}}"></div>   
                    </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    @if($banners[$i]->day_type == 'Today')
                    <div class="imgcontent">
                        <!-- <div class="day   fw-bold ">
                                <div class="qu">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="4vw" height="8vh" viewBox="0 0 256.000000 256.000000" preserveAspectRatio="xMidYMid meet">

                                    <g transform="translate(0.000000,256.000000) scale(0.100000,-0.100000)" fill="#ffffff" stroke="none">
                                    <path d="M0 1760 l0 -480 316 0 317 0 -5 -67 c-10 -127 -72 -263 -170 -369 -94 -102 -256 -182 -390 -192 l-68 -5 0 -163 0 -164 53 0 c209 0 452 106 620 269 140 135 246 336 276 521 7 40 11 273 11 598 l0 532 -480 0 -480 0 0 -480z"/>
                                    <path d="M1600 1760 l0 -480 316 0 317 0 -5 -67 c-10 -127 -72 -263 -170 -369 -94 -102 -256 -182 -390 -192 l-68 -5 0 -163 0 -164 53 0 c209 0 452 106 620 269 140 135 246 336 276 521 7 40 11 273 11 598 l0 532 -480 0 -480 0 0 -480z"/>
                                    </g>
                                    </svg>
                                </div>
                                <span style="color: #0d2273;font-size: 28pt;">{{dayFormat($master->day)}}</span><br><span style="font-size: 28pt;">Special Meal</span>
                            
                        </div> -->
                        <div class="cimg"><img src="{{$master->menu->imageurl}}"></div>   
                    </div>
                    @endif
                    @if($banners[$i]->day_type == 'Tomorrow')
                    <div class="title ">
                        {{$banners[$i]->day_type." 's Menu"}}
                        <div class="spday">
                        Special Meal
                        </div>
                    </div>
                    <div class="mt-3">
                        <ul>
                            @foreach(explode(',', $master->menu->description) as $item)
                                <li>{{ trim($item) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                
                
            </div>
        </div>
          @php $i++ @endphp

          
      </div>
      @empty
      @endforelse
      @forelse($simenus as $simenu)
      
      <div class="swiper-slide">

          <img src="{{ $banners[$j]->simurl }}">
          <div class=" content">
            <div class="row">
                @if($banners[$j]->day_type == 'Today')
                <div class="col-lg-6 offset-lg-6">
                    
                    <div class="title1">
                        {{$banners[$j]->day_type." 's Menu"}}
                        <div class="sday">
                        South Indian
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <ul class="cl">
                            <li>{{$simenu->sambar}}</li>
                            <li>{{$simenu->rasam}}</li>
                            <li>{{$simenu->poriyal}}</li>
                        </ul>
                    </div>
                    
                </div>
                @endif
                @if($banners[$j]->day_type == 'Tomorrow')
                <div class="col-lg-6 offset-lg-3">
                    
                    <div class="title1">
                        {{$banners[$j]->day_type." 's Menu"}}
                        <div class="sday">
                        South Indian
                    </div>
                    </div>
                    
                    <div class="mt-3">
                        <ul class="cl">
                            <li>{{$simenu->sambar}}</li>
                            <li>{{$simenu->rasam}}</li>
                            <li>{{$simenu->poriyal}}</li>
                        </ul>
                    </div>
                    
                </div>
                @endif
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
        delay: 8000,
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