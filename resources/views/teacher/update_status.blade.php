 @extends('layout.teacher_layout')
 @section('content')
    
   
    <div class="col-md-8 col-sm-12 clearfix mt-1 mb-5">
     <a href="/teacher/booking" class="pr-1 text-dark float-right">{{-- カレンダーに戻る --}} Return to calendar</a>
    <div class ="d-flex justify-content-between mt-5">
    @if($not_current)    
    <a href="/teacher/slot/edit/{{$enc_id}}/{{$previous_date}}" class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></a>
    @else
     <span class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></span>
    @endif
    <span style="font-size: 20px;line-height:2.1">{{-- {{$date_jp}} --}} {{$date}}</span>
    <a href="/teacher/slot/edit/{{$enc_id}}/{{$next_date}}" class="text-dark pr-1"><i class="fas fa-3x fa-caret-right text-secondary"></i></a>
    
    </div>
         {{-- <h3 class=""><a href="/care-taxi/slot/{{$id}}/{{$date}}" class="text-dark pr-1"></a></h3> --}}
    @if(count($time)>1)
    <form action="/teacher/status/update"  method="POST">
        @csrf
        
        <input type="submit" class="btn btn-warning btn-block mb-1" value="Update" />
        <input type="hidden" name="id" value="{{$id}}" /></td>
         <input type="hidden" name="date" value="{{$date}}" /></td>
        <table class="table table-hover table-bordered bg-light" style="margin-bottom: 0px !important">
            <th>Time</th>
            <th>Booking Status</th>
            <th>Comment</th>
        <tbody>
            
            @foreach ($time as $key => $t)
            @if($this_time_str > strtotime($t["time"]) && $date == date('Y-m-d'))
            <?php $t["status"] ="times"; ?>
            @endif
            <tr>
                <td style="width: 150px">{{ date('H:i', strtotime($t["time"]))}} ~ {{ date('H:i', strtotime($t["time"]) + 1500 )}}</td>
                <td style="width: 200px">
                        
                        <div class="form-check form-check-inline">
                        <input class="form-check-input line" type="radio" name="status-{{$t["time"]}}"  value="line"
                        @if($t["status"] == 'line')
                        {{'checked'}} 
                        @endif
                        @if($this_time_str > strtotime($t["time"]) && $date == date('Y-m-d'))
                        {{'disabled'}}
                        @endif
                        >
                        <label class="form-check-label" for="inlineRadio2">
                            <span class="text-secondary align-middle">
                            <i class="fa-minus fas"></i>
                            </span>
                        </label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input circle" type="radio" name="status-{{$t["time"]}}" id="inlineRadio1" value="circle"
                         @if($t["status"] == 'circle')
                        {{'checked'}} 
                        @endif
                        @if($this_time_str > strtotime($t["time"]) && $date == date('Y-m-d'))
                        {{'disabled'}}
                        @endif
                        >
                        <label class="form-check-label" for="inlineRadio1">
                            <span class="text-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                            <circle cx="8" cy="8" r="8"/>
                            </svg>
                            </span>
                        </label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input times" type="radio" name="status-{{$t["time"]}}" id="inlineRadio3" value="times"
                        @if($t["status"] == 'times')
                        {{'checked'}} 
                        @endif
                        >
                        <label class="form-check-label" for="inlineRadio3">
                            <span class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            </span>
                        </label>
                        </div>
                </td>
                <td >
                    <div class="">
                    <input type="text" class="form-control status-{{$t["time"]}} @if($t["status"] != 'circle')
                        {{'hide'}} 
                        @endif" id="status-{{$t["time"]}}" name="comment-{{$t["time"]}}" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$t["comment"]}}" >
                </div>
                </td>
            </tr>
            @endforeach
           
           </tbody>
        </table>
        <input type="submit" class="btn btn-warning btn-block mt-1" value="Update" />
    </form>
    @else 
     <a href="/care-taxi/slot/edit/{{$enc_id}}/{{$date}}" class="btn btn-secondary btn-block clearfix mb-1 disabled">{{-- 編集 --}} Update</a>
     <table class="table table-hover table-bordered bg-light" style="margin-bottom: 0px !important">
            <th>Time</th>
            <th>Booking Status</th>
            <th>Comment</th>
        <tbody>           
           </tbody>
        </table>
         <a href="/care-taxi/slot/edit/{{$enc_id}}/{{$date}}" class="btn btn-secondary btn-block clearfix mb-1 disabled">{{-- 編集 --}} Update</a>
     @endif
     </div>
 
 
 @endsection