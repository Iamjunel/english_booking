 @extends('layout.student_layout')
 @section('content')
 <div class="container ">
     <div class="col-md-10 col-sm-10 clearfix m-3">
         <div class="d-flex justify-content-center"> 
             <a href="/student" class="h3 text-dark pr-1"><i class="fas fa-2x fa-caret-left text-secondary"></i></a> 
         <h3 class="text-center mb-2"><span style="line-height: 2.0">レッスン予約</span></h3>
          </div>
        <div id='full_calendar_events' class="bg-light"></div>
        
    </div>
     </div>
 </div>
 
 @endsection
 
