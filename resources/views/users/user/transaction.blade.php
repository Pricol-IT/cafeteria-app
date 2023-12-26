@extends('layouts.app')
@section('title')
    {{__('Transaction History')}}
@endsection
@section('links')
<style type="text/css">
    #calendar {
    width: 90%;
    height: 80%;
    margin: 0 auto;
  }
  .fc .fc-daygrid-body-unbalanced .fc-daygrid-day-events
  {
    display: flex;
/*      */
  }
 /* .fc-sat, .fc-sun {
    background-color: red !important;
}*/
  .fc-daygrid-event-dot {
    /*width: 5px;
    height: 5px;*/
    border-width:6px;
/*    border-radius: 50px;*/
  }
</style>
@endsection
@section('main')
<main id="main" class="main">
    <div id="date" style="display:none;">{{date('Y-m-d')}}</div>
    <div id="startdate" style="display:none;">{{date('Y-m-01')}}</div>
    <div id="enddate" style="display:none;">{{date('Y-m-t')}}</div>
    <div id="ndate" style="display:none;">{{date('t')}}</div>
    
    <div>
      @php
        $spmCount = 0;
        $simCount = 0;
        $curdCount = 0;
      @endphp
      @if(!empty($singles))
      
      @php

        foreach ($singles as $single)
        {
         $spmCount += $single['spm']; 
         $simCount += $single['sim']; 
         $curdCount += $single['curd']; 

        }
        @endphp
        @endif

    </div>
    
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcome-list">
            <div class="row ">
              <div class="col-lg-6">
                <h4 class="text-white fw-bold">Transaction History</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card breadcome-bottom pt-4 pb-4">
            <div class="card-header ">
              <div class="row p-2">
                <div class="col-lg-4 col-md-4"><p class="h5"><span class="badge p-2 " style=" margin-right: 5px; background: #7fe84e;"> </span>Special Meal : <span class="badge bg-primary badge-pill">{{$spmCount}}</span></p></div>
                <div class="col-lg-4 col-md-4"><p class="h5"><span class="badge p-2 " style=" margin-right: 5px; background: #ffff00;"> </span>South Indian : <span class="badge  bg-primary badge-pill">{{$simCount}}</span></p></div>
                <div class="col-lg-4 col-md-4"><p class="h5"><span class="badge p-2 " style=" margin-right: 5px; background: #f2a40d;"> </span>Curd : <span class="badge bg-primary badge-pill">{{$curdCount}}</span></p></div>
              </div>
              
            </div>
            <div id='calendar' class="pt-2"></div>

        </div>
        </div>
      </div>
    
    

</main>
@endsection

@section('script')
<script src="{{asset('fullcalendar/dist/index.global.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarId = document.getElementById('calendar');
        var date = document.getElementById('date').innerHTML;
        var fdate = document.getElementById('startdate').innerHTML;
        var ldate = document.getElementById('enddate').innerHTML;
        
        var calendar = new FullCalendar.Calendar(calendarId,{

  // document.addEventListener('DOMContentLoaded', function() {
  //   var calendarEl = document.getElementById('calendar');

  //   var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
          
        // center: 'title',
        right: 'dayGridMonth'
      },
       aspectRatio: 2,
      initialDate: date,
      initialView: 'dayGridMonth',
        
      navLinks: false, // can click day/week names to navigate views
      businessHours: false, // display business hours
      editable: false,
      selectable: false,

      events: [
        @if(!empty($singles))
        @foreach ($singles as $single)
        @if($single['spm'] != 0)
        { start: '{{(date("Y-m-d",strtotime($single["day"])))."T01:00:00"}}',color: '#7FE84E' },
        @endif
        @if($single['sim'] != 0)
        { start: '{{(date("Y-m-d",strtotime($single["day"])))."T01:00:00"}}',color: '#FFFF00' },
        @endif
        @if($single['curd'] != 0)
        {  start: '{{(date("Y-m-d",strtotime($single["day"])))."T01:00:00"}}',color: '#F2A40D' },
        @endif
        @endforeach
        @endif
        
        // {
        //   title: 'Business Lunch',
        //   start: '2023-01-03T13:00:00',
        //   constraint: 'businessHours'
        // },
        

        // areas where "Meeting" must be dropped
        // {
        //   groupId: 'availableForMeeting',
        //   start: '2023-01-11T10:00:00',
        //   end: '2023-01-11T16:00:00',
        //   display: 'background'
        // },
        // {
        //   groupId: 'availableForMeeting',
        //   start: '2023-01-13T10:00:00',
        //   end: '2023-01-13T16:00:00',
        //   display: 'background'
        // },

        // red areas where no events can be dropped
        // {
        //   start: '2023-01-24',
        //   end: '2023-01-28',
        //   overlap: false,
        //   display: 'background',
        //   color: '#ff9f89'
        // },
        @if(!empty($deliverys))
        @forelse($deliverys as $delivery)
        {
          start: '{{$delivery->day}}',
          end: '{{$delivery->day}}',
          overlap: false,
          display: 'background',
          color: '#f1f1f1'
        },
        @empty
        @endforelse
        @endif
      ],
      displayEventTime : false
    });

    calendar.render();
  });

</script>
@endsection