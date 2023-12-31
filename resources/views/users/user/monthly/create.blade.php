@extends('layouts.app')
@section('title')
    {{__('Monthly Menu')}}
@endsection
@section('main')

<main id="main" class="main">
  <div class="row">
    <div class="col-lg-12">
      <div class="breadcome-list">
        <div class="row p-3">
          <div class="col-lg-6">
            <h4 class="text-white fw-bold">Select Monthly Menu</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card breadcome-bottom p-3">
        <form action="{{route('user.monthlystore')}}" method="post" enctype="multipart/form-data">
          @csrf @method('post')
          <div class="row mt-3 mb-3">
            <div class="col-lg-12">
                <h4 class="fw-bold text-primary text-center mb-3">
                Menu Details
              </h4>
            </div>
            <div class="col-lg-8 offset-lg-2">
              
              <div class="row p-2">
                <div class="col-4">
                  <h5 class="text-primary fw-bold">Select Month:</h5>
                </div>
                <div class="col-8">
                  <input type="month" name="monthly" class="form-control" value="{{old('monthly')}}"/>
                  @if ($errors->has('monthly'))
                      <span class="error text-danger">{{ $errors->first('monthly') }}</span>
                  @endif
                </div>
              </div>

              <div class="fooditem">
                <div class=" d-flex justify-content-between align-items-center p-3 ">
                  <img src="{{asset('img/meal1.png')}}"  class=" p-2 m-1 shadow rounded-circle" width="80px" />
                  <h6 class="text-primary fw-bold flex-fill">
                    South Indian Meal
                  </h6>
                  <input class="form-check-input border border-primary p-2" type="checkbox" name="monthly_sim" value="1" />
                </div>
                <div class="southIndianFood d-flex justify-content-between align-items-center p-3">
                  <img src="{{asset('img/curd1.png')}}"  class=" p-2 m-1 shadow rounded-circle"  width="80px"/>
                  <h6 class="text-primary fw-bold flex-fill">
                    Curd
                  </h6>
                  <input class="form-check-input border border-primary p-2" type="checkbox" name="monthly_curd" value="1" />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <center>
              <input type="submit" name="submit" value="Save" class="btn btn-primary" />
              <a href="{{route('user.monthly')}}" class="btn btn-danger">Back</a>
            </center>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script type="text/javascript">
   $(document).ready(function() {
  var today = new Date();
  var currentMonth = today.getMonth() + 1;
  var currentYear = today.getFullYear();
  var nextMonth = currentMonth + 1;
  var nextYear = currentYear;

  if (nextMonth > 12) {
    nextMonth = 1;
    nextYear++;
  }

  var currentMonthFormatted = currentYear + "-" + ("0" + currentMonth).slice(-2);
  var nextMonthFormatted = nextYear + "-" + ("0" + nextMonth).slice(-2);

  $('input[name="monthly"]').attr("min", nextMonthFormatted);
  $('input[name="monthly"]').attr("max", nextMonthFormatted);
  $('input[name="monthly"]').val(nextMonthFormatted);
});
    </script>
@endsection