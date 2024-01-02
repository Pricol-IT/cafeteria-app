@extends('layouts.app')
@section('title')
    {{__('Reports')}}
@endsection
@section('main')
<main id="main" class="main">
    
    <div class="row">
        <div class="col-lg-12">
          <div class="breadcome-list">
            <div class="row p-3">
              <div class="col-lg-6">
                <h4 class="text-white fw-bold">Live Reports</h4>
              </div>
              <div class="col-lg-6 text-lg-end">
                    
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
            <!--  -->
        </div>
        <div class="col-lg-12">
            <div class="card breadcome-bottom">
                <div class="p-4">
                    <table width="100%">
                        <tr>
                            <td></td>
                            <td>Booked</td>
                            <td>Remaining</td>
                        </tr>
                        <tr>
                            <td><h5 class="text-primary">Special Meals</h5></td>
                            <td>{{$result1[0]->spm}}</td>
                            <td>{{$results[0]->spm}}</td>
                            
                        </tr>
                        <tr>
                            <td><h5 class="text-primary">South Indian</h5></td>
                            <td>{{$result1[0]->sim}}</td>
                            <td>{{$results[0]->sim}}</td>

                        </tr>
                        <tr>
                            <td><h5 class="text-primary">Curd</h5></td>
                            <td>{{$result1[0]->curd}}</td>
                            <td>{{$results[0]->curd}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</main>
@endsection