@extends('layouts.app')
@section('title')
    {{__('Menu Details')}}
@endsection
@section('main')
<style type="text/css">
    .cl li::before{ 
            
            content: "\00BB"; 
            margin-right: 10px;
        } 
       .v ul 
        {
            padding-left: 0 ;
        }
    ul li{
        list-style: none;
    }
    .n img {
         object-fit: cover;
         height: 180px;
    }

    @media (max-width:350px)
    {
        ul li {
            font-size: 12px;
        }
    }
</style>
<main id="main" class="main">
    <div class="container-fluid">
        <div class="row">
            @forelse($masters as $master)
            @if($loop->first)
            <div class="col-lg-12 text-center">
                <div class="card"><h2 class="p-2 text-primary fw-bold">Special Meal</h2></div>
            </div>
            @endif
                <div class="col-lg-6 col-md-6">
                    <div class="card n shadow">
                        @if($loop->first)
                        <h3 class="text-white text-center bg-primary p-2">Today's Menu</h3>
                        @else
                        <h3 class="text-white text-center bg-primary p-2">Tommorrow's Menu</h3>
                        @endif
                    
                        <div class="row">
                            <div class="col-6 col-lg-4">
                                <img src="{{$master->menu->imageurl}}" class="p-2 shadow" width="100%">
                            </div>
                            <div class="col-6 col-lg-8">
                                <div class="v">
                                    
                                
                                <ul class="cl">
                                @foreach(explode(',', $master->menu->description) as $item)
                                    <li>{{ trim($item) }}</li>
                                @endforeach
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty  
            @endforelse
        </div>
        <div class="row">
            
            @forelse($si_menus as $simenu)
            @if($loop->first)
            <div class="col-lg-12 text-center">
                <div class="card"><h2 class="p-2 text-primary fw-bold">South Indian Meal</h2></div>
            </div>
            @endif
                <div class="col-lg-6 col-md-6">
                    <div class="card shadow">
                        @if($loop->first)
                        <h3 class="text-white text-center bg-primary p-2">Today's Menu</h3>
                        @else
                        <h3 class="text-white text-center bg-primary p-2">Tommorrow's Menu</h3>
                        @endif
                    
                        <ul class="cl">
                            <li>{{$simenu->sambar}}</li>
                            <li>{{$simenu->rasam}}</li>
                            <li>{{$simenu->poriyal}}</li>
                        </ul>
                    </div>
                </div>
            @empty  
            @endforelse
        </div>
        

    </div>
  </main><!-- End #main -->
@endsection
