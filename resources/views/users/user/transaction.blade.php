@extends('layouts.app')
@section('title')
    {{__('Transaction History')}}
@endsection
@section('links')
<style type="text/css">
    #calendar {
    width: 90%;
    height: 80%;
    min-height: 380px;
    margin: 0 auto;
  }
  .fc .fc-daygrid-body-unbalanced .fc-daygrid-day-events
  {
    display: flex;
/*      */
  }
  .fc .fc-day-disabled{
    background: #ffffff ;
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
  @media (max-width: 900px)
  {
    .fc-daygrid-event-dot {
    
    border-width:4px;

  }
  .fc .fc-toolbar-title
  {
    font-size: 1.2em;
  }
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
        <!-- @foreach($singles as $single)
        {{ $single["day"] }}
        @endforeach -->
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
              <h6 class="fw-bold text-primary"><span class="">Note: </span><br> 1.Next day Menu to be booked on previous day itself before 07.00 PM <br> 2.Cancellation of booked menu to be done before 9.58 AM of current date.</h6>
              
              
            </div>
            <div class="card-footer">
              <div class="row p-1 m-1">
                <div class="col-lg-4 col-md-4"><p class="h5"><span class="badge p-2 " style=" margin-right: 5px; background: #7fe84e;"> </span>Special Meal 
                  <!-- : <span class="badge bg-primary badge-pill">{{$spmCount}}</span> -->
                </p></div>
                <div class="col-lg-4 col-md-4"><p class="h5"><span class="badge p-2 " style=" margin-right: 5px; background: #ffff00;"> </span>South Indian 
                  <!-- : <span class="badge  bg-primary badge-pill">{{$simCount}}</span> -->
                </p></div>
                <div class="col-lg-4 col-md-4"><p class="h5"><span class="badge p-2 " style=" margin-right: 5px; background: #f2a40d;"> </span>Curd 
                  <!-- : <span class="badge bg-primary badge-pill">{{$curdCount}}</span> -->
                </p></div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarId = document.getElementById('calendar');
        var date = document.getElementById('date').innerHTML;
            
        var currentDate = new Date();
        var previousMonthStart = new Date(currentDate);
        previousMonthStart.setMonth(currentDate.getMonth() - 1);
        previousMonthStart.setDate(1);

        // Get the first day of the next month
        // var nextMonthStart = new Date(currentDate);
        var nextMonthStart = new Date(currentDate.getFullYear(), currentDate.getMonth()+2, 0);
        // nextMonthStart.setMonth(currentDate.getMonth() + 2);
        // nextMonthStart.setDate(1);
 // console.log(nextMonthStart);

        var spCount = 0;
        var siCount = 0;
        var curdCount = 0;
        var calendar = new FullCalendar.Calendar(calendarId,{

  
      headerToolbar: {
        //   left: 'prev,next',
        // center: 'title',
        // right: 'dayGridMonth'
        right:'prev,next'
      },
       aspectRatio: 2,
      initialDate: date,
      initialView: 'dayGridMonth',
        validRange: {
          start: previousMonthStart,
          end: nextMonthStart
        },
      navLinks: false, // can click day/week names to navigate views
      businessHours: false, // display business hours
      editable: false,
      selectable: false,
      showNonCurrentDates: true,
  //     dayMaxEventRows: true, // for all non-TimeGrid views
  // views: {
  //   dayGrid: {
  //     dayMaxEventRows: 1 // adjust to 6 only for timeGridWeek/timeGridDay
  //   }
  // },
      events: [
        @if(!empty($singles))
        @foreach ($singles as $single)
        @if($single['spm'] != 0)
        {  groupId: 'SP', start: '{{(date("Y-m-d",strtotime($single["day"])))."T01:00:00"}}',color: '#7FE84E',description: 'Special Meal',category: 'spm' },
        @endif
        @if($single['sim'] != 0)
        {   groupId: 'SIM', start: '{{(date("Y-m-d",strtotime($single["day"])))."T01:00:00"}}',color: '#FFFF00',description: 'South Indian',category: 'sim' },
        @endif
        @if($single['curd'] != 0)
        {  groupId: 'Curd', start: '{{(date("Y-m-d",strtotime($single["day"])))."T01:00:00"}}',color: '#F2A40D',description: 'Curd',category: 'curd' },
        @endif
        @endforeach
        @endif
        
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
      displayEventTime : false,
  //     eventRender: function (info) {
  //   console.log(info.event.extendedProps);
  //   // {description: "Lecture", department: "BioChemistry"}
  // }
      
    });

    

    calendar.render();
});

</script>
@endsection