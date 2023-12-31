@extends('layouts.app')
@section('title')
    {{__('Weekly Menu')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
          <div class="breadcome-list">
            <div class="row p-3">
              <div class="col-lg-6">
                <h4 class="text-white fw-bold">Weekly Menu</h4>
              </div>
              <div class="col-lg-6 text-lg-end"><a href="{{route('user.weekly')}}" class="btn btn-danger round">Back</a></div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
            <div class="card  breadcome-bottom p-2">
                
                <div class="row">
                    <div class="col-lg-12">

                        <div class="table-responsive">
                            <table class="table datatable">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Date</th>
                                     <th scope="col">Menu</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                
                                @forelse ($weeklys as $weekly)
                                
                                @php
                                $formattedDate = date('Y-m-d:10:i:s', strtotime($weekly->day));
                                @endphp
                                @if($formattedDate >= date('Y-m-d:H:i:s'))
                                <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{ dayFormat($weekly->day) }}<br>{{convertDateFormat($weekly->day)}}</td>
                                  <td>
                                    @if($weekly->spm != null)
                                        <p class="mb-2"><span class="text-primary">Special Meal -</span>  {{$weekly->spm}}</p>
                                   @endif
                                    @if($weekly->sim != null)
                                        <p class="mb-2"><span class="text-primary">South Indian Meal -</span>  {{$weekly->sim}}</p>
                                   @endif
                                   @if($weekly->curd != null)
                                        <p class="mb-2"><span class="text-primary">Curd -</span>  {{$weekly->curd}}</p>
                                   @endif
                                 </td>
                                 <td>
                                 <form method="post" action="{{ route('user.removeweeklyday', ['id' => $weekly->id]) }}" onsubmit="return confirm('Are You Sure,You want to remove this menu')">
                                    @csrf
                                    @method('POST')
                                    
                                    <button type="submit"  class="btn btn-sm btn-danger">Remove</button >
                                </form>
                                  </td>
                                  
                                </tr>
                                @endif
                                
                                @empty
                                <tr>
                                    
                                    <td colspan="5"> No Data Found</td>
                                </tr>
                                @endforelse
                              </tbody>
                            </table>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection