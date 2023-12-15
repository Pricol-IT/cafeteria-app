@extends('layouts.app')
@section('title')
    {{__('Menu Master')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-6"> <h3 class="fw-bold text-primary">Menu Master - Special Meal</h3></div>
            <div class="col-lg-6 text-lg-end"><a href="{{route('menu_master.create')}}" class="btn btn-primary round">Add Menu</a></div>
        </div>
        <div class="row">
            @forelse($masters as $master)
            <div class="col-lg-6  ">
                <div class="d-flex m-1 bg-white shadow ">
                    
                    <div class="image m-3"><img src="{{$master->imageurl}}" width="100px"></div>
                    <div class="content p-3">
                        <h5 class="text-primary fw-bold d-flex justify-content-between">{{$master->name}} 
                        <span>
                            <a href="{{route('menu_master.edit',$master->id)}}">
                                <i class="bi bi-pencil"></i>
                            </a> 
                            <form action="{{ route('menu_master.destroy', $master->id) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('{{ __('Are you sure you want to delete this Menu') }}');" class="btn ll-p-0"><i class="bi bi-trash"></i>
                                </button>
                            </form></span>
                        </h5>
                        <p>{{$master->description}}</p>
                    </div>
                    
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
  </main><!-- End #main -->
@endsection