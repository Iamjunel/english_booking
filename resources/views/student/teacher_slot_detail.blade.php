 @extends('layout.student_layout')
 @section('content')
 
     
    <div class="col-md-8 col-sm-12 clearfix mt-1 mb-5">
        <a href="/student/teacherlist" class="pr-1 text-dark float-right">講師リストに戻る</a>
        <div class ="d-flex justify-content-between mt-5">
        @if($not_current)    
        <a href="/student/slot/detail/{{$id}}/{{$previous_date}}" class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></a>
        @else
        <span class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></span>
        @endif
        <span style="font-size: 20px;line-height:1.9">{{$date_jp}} <span style="font-size:22px;font-weight:600;font-family: emoji">~</span> {{$date_jp_w}}</span>
        <a href="/student/slot/detail/{{$id}}/{{$next_date}}" class="text-dark pr-1"><i class="fas fa-3x fa-caret-right text-secondary"></i></a>
        
    </div>
    <h3 class="text-center">{{$com->name}}</h3>
    
        <table class="table table-hover table-bordered bg-light">
            <th>時間</th>
            <th>{{date('m/d',strtotime($date))}}月</th>
            <th>{{date('m/d',strtotime('+1days',strtotime($date)))}}火</th>
             <th>{{date('m/d',strtotime('+2days',strtotime($date)))}}水</th>
              <th>{{date('m/d',strtotime('+3days',strtotime($date)))}}木</th>
              <th>{{date('m/d',strtotime('+4days',strtotime($date)))}}金</th>
              <th>{{date('m/d',strtotime('+5days',strtotime($date)))}}土</th>
              <th>{{date('m/d',strtotime('+6days',strtotime($date)))}}日</th>
        <tbody>
            @foreach ($time as $key => $t)
            
            <tr class="{{(idate('H', strtotime($t["time"])) < 10)? 'hide-slot' : ''}}">
                <td style="width: 100px">{{-- {{ date('H:i', strtotime($t["time"]))}} --}} {{ date('H:i', strtotime($t["time"]))}}  ~ {{ date('H:i', strtotime($t["time"]) + 1500 )}}</td>
                @for($day = 0; $day < 7;$day++)
                    @if($day > 0)
                        @php $curr_date = date('Y-m-d',strtotime('+'.$day.'days',strtotime($date))); @endphp
                    @else
                        @php $curr_date = $date; @endphp
                    @endif
                    @if($t["status_$curr_date"] != null)
                    @if($t["status_$curr_date"] =="circle")
                    <td style="width: 100px" >
                    <a href="/student/contact/{{$id}}/{{$curr_date}}/{{$t["time"]}}/{{$t["status_$curr_date"]}}"> 
                    <div class="text-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                        <circle cx="8" cy="8" r="8"/>
                    </svg>
                    </div>
                    </a>
                    </td>
                    @elseif($t["status_$curr_date"] =="times")
                    <td style="width: 100px" >
                    <a onclick="return false" href="/student/contact/{{$id}}/{{$curr_date}}/{{$t["time"]}}/{{$t["status_$curr_date"]}}"> 
                   <span class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            </span>
                    </a>
                    </td>
                    @else
                        <td style="background-color: darkgrey;width:100px"></td>
                
                @endif
           
                    @else
                    <td style="background-color: darkgrey;width:100px"></td>
                    @endif
                @endfor 
                  
                
                
            </tr>
            
            @endforeach
           
           </tbody>
        </table>
    
     </div>
 
 
 @endsection