@extends('layouts.app')
@section('title')
    {{__('Create Menu')}}
@endsection
@section('main')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcome-list">
                <div class="row p-3">
                    <div class="col-lg-6">
                        <h4 class="text-white fw-bold">Select Menu</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 ">
            <div class="card breadcome-bottom p-3">
               <div class="row">
                    <div class="col-lg-6"> <h4 class="fw-bold text-primary">Menu Details</h4></div>
                    <div class="col-lg-6 text-lg-end"></div>
                </div>
                <form id="menusubmit">
               <div class="row mt-2 p-3">
                
                   <div class="col-lg-4">
                        <label class="text-primary">Date</label>
                        <input type="date" id="day" class="form-control">
                   </div>
                   <div class="col-lg-4">
                       <label class="text-primary">Menu</label>
                       <select id="menu" class="form-control">
                           <option value="">Select Menu</option>
                           @forelse($masters as $master)
                            <option value="{{$master->id}}">{{$master->name}}</option>
                           @empty
                           @endforelse
                       </select>
                   </div>
                   <div class="col-lg-4">
                       <a href="#." class="btn btn-primary add mt-4">+ Add</a>
                   </div>
               </div>
               </form>
                <form  action="{{route('menu_selection.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Date</td>
                                <td>Menu</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="menubody">
                            
                        </tbody>
                    </table>
                    
                    <div class="row">
                        <center>
                            <input type="submit" name="submit" value="Save" class="btn btn-primary">
                            <a href="{{route('menu_selection.index')}}" class="btn btn-danger">Back</a>
                        </center>
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
  </main><!-- End #main -->
@endsection
@section('script')
<script type="text/javascript" src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
      var currentDate = new Date();
      var nextMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 2, 0);
      
      $('#day').attr('min', currentDate.toISOString().split('T')[0]);
      $('#day').attr('max', nextMonth.toISOString().split('T')[0]);
    });
    $("#menusubmit").submit(function (e) {
      e.preventDefault();
    });
    $("body").on("change","#day",function(){
        
        var selectedDate = $(this).val();
    
        $.ajax({
          url: '/check-date',
          method: 'POST',
          data: { "_token": "{{ csrf_token() }}",day: selectedDate },
          success: function(response) {
            if (response) {
              alert('Record already exists for this day');
            }
          }
        });
        
    });
    $("body").on("click", ".add", function() {
      var day = $('#day').val();
      var menutext = $('#menu option:selected').text();
      var menuvalue = $('#menu option:selected').val();
      
      // Check if the day value is already present in the table
      var isDuplicate = false;
      $('.menubody tr').each(function() {
        var existingDay = $(this).find('td:first-child').text();
        if (existingDay === day) {
          isDuplicate = true;
          return false; // Exit the loop if a duplicate is found
        }
      });
      
      if (day !== '' && menutext !== '' && menuvalue !== '') {
        if (isDuplicate) {
          alert('Duplicate day value. Please choose a different day.');
        } else {
          $('.menubody').append('<tr><td><input type="hidden" name="day[]" value="'+day+'">'+day+'</td><td><input type="hidden" name="menu_master_id[]" value="'+menuvalue+'">'+menutext+'</td><td><button class="btn-danger btn remove" ><i class="bi bi-trash"></i></button></td><tr>');
          $('#menusubmit').trigger('reset');
        }
      } else {
        alert('Please fill in all the details.');
      }
    });

    $("body").on("click",".remove",function(){
          
          if(confirm("Are you sure you want to delete this?")){
                $(this).closest("tr").remove();
            }
            else{
                return false;
            }
        });
</script>
@endsection