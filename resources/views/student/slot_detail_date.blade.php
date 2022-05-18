 @extends('layout.student_layout')
 @section('content')
     
     <div class="col-md-10 col-sm-10 clearfix p-5">
         <div class="row m-1 float-right">
             {{-- back to calendar --}}
             <a href="/student/slot" class="btn btn-light text-dark border-dark t">カレンダーへ戻る</a>
         </div>
         <div class="clearfix"></div>
         <div class ="d-flex justify-content-between mt-5 ">
        @if($not_current)    
        <a href="/student/slot/{{$previous_date}}" class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></a>
        @else
        <span class="text-dark pr-1"><i class="fas fa-3x fa-caret-left text-secondary"></i></span>
        @endif
        <span style="font-size: 18px;line-height:2.3">{{$date_jp}}</span>   
        <a href="/student/slot/{{$next_date}}" class="text-dark pr-1"><i class="fas fa-3x fa-caret-right text-secondary"></i></a>
             
    </div>
        
     <div class="row">
         <div class="container col-md-12 col-sm-12 ">
            <div class="col-md-12 col-sm-12 border mb-1 text-center"> 
                {{-- <h4 class="text-center text-danger">スタッフより</h4>   --}} 
            <div class="row mt-3"> 
                <div class="container col-md-12  d-flex justify-content-center mb-2"> 
                     <span class="mr-5"><img src="{{ asset('images/syoshinsya.svg') }}" width="25" height="25"> -- 初心者向け</span>
                     <span class="mr-5"><img src="{{ asset('images/shikentaisaku.svg') }}" width="25" height="25"> -- 試験対策</span>
                     <span class="mr-5"><img src="{{ asset('images/nichijyokaiwa.svg') }}" width="25" height="25"> -- 日常会話</span>
                    
                </div>       
            </div>

            </div>
         </div>
     </div>
    <form action="/care-taxi/company/update/"  method="POST" >
        @csrf
        
       {{--  <input type="submit" class="btn btn-primary float-right" value="アップデート" /> --}}
        {{-- <input type="hidden" name="id" value="{{$company->id}}" /></td> --}}
        <table class="table table-hover table-bordered bg-light" >
            <thead class="bg-light">
            <th style="width: 150px;position:sticky;display:none" class="bg-light" id="show" >{{-- 時間 --}} ↑全ての時間を表示 <span class="text-primary"> <i class="fas fa-caret-right" ></i></span></th>
            <th style="width: 150px;position:sticky;display:none" class="bg-light" id="remove">{{-- 時間 --}} ↑全ての時間を表示 <span class="text-primary"></i> <i class="fas fa-caret-down" ></i> </span></th>
            <th style="width: 150px;position:sticky;" class="bg-light text-center" >時間 </span></th>
            @foreach ($comp_list as $com)
            <th class="text-center text-break" style="min-width:100px;vertical-align:baseline" ><a class="text-dark" href="/student/teacher/detail/{{$com->enc_id}}">{{$com->nickname}}</a><br>

            @if($com->beginner != "times" )
             {{-- <span class="text-secondary"><i class="fas fa-wheelchair "></i> </span> --}}
             <span class=""><img src="{{ asset('images/syoshinsya.svg') }}" width="20" height="20"></span>
             
            @endif
             @if($com->exam != "times" )
             {{--  <span class="text-dark"><i class="fab fa-accessible-icon"></i> </span> --}}
               <span class=""><img src="{{ asset('images/shikentaisaku.svg') }}" width="25" height="25"></span>
            @endif
             @if($com->conversation != "times" )
              {{-- <span class="text-success"><i class="fas fa-walking"></i> </span> --}}
                <span class=""><img src="{{ asset('images/nichijyokaiwa.svg') }}" width="25" height="25"></span>
            @endif
        
            </th>      
           @endforeach
            </thead>
        <tbody style="overflow:auto!important">
            @foreach ($time as $key => $t)
            @if((date('H', strtotime($t["time"])) < 23))
            
    
            <tr class="{{(idate('H', strtotime($t["time"])) < 8)? 'hide-slot' : ''}}"
                @foreach ($comp_list as $com1)
                    <?php $disabled = "";
                    ?>
                     @if(isset($t["status_".$com1->id]) )
                  
                     @if($t["status_".$com1->id] == "times" && $t["student_id"] != $students_id)
                     <?php $disabled = "return false"; 
                     break;
                     ?>
                     @endif
                     @endif
                @endforeach 
                >
                <td style="" class="">{{ date('H:i', strtotime($t["time"]))}}  ~ {{ date('H:i', strtotime($t["time"]) + 1500 )}}</td>
                 @foreach ($comp_list as $com)
                 
                 @if(isset($t["status_".$com->id]))
                     <?php $disabled = "";
                    ?>
                    
                  
                     @if($t["status_".$com1->id] == "times" && $t["student_id"] != $students_id)
                     <?php $disabled = "return false"; 
                    // break;
                     ?>
                    
                     @endif
                    @if($t["status_".$com->id] == "circle")
                    
                    <td class="text-center <?php echo (!empty($disabled))? "disabled-cursor" : ""; ?>"><a  href="/student/contact/{{$com->id}}/{{$date}}/{{$t["time"]}}/{{$t["status_".$com->id]}}"> 
                        <div class="text-info"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                            <circle cx="8" cy="8" r="8"/>
                        </svg>
                    </div>
                        </a>
                    </td>
                    @elseif($t["status_".$com->id] == "times")
                    <td class="text-center disabled-cursor"><a onclick="{{$disabled}}" href="/student/contact/{{$com->id}}/{{$date}}/{{$t["time"]}}/{{$t["status_".$com->id]}}"> 
                        <span class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            </span>
                        </a>
                    </td>
                    @elseif($t["status_".$com->id] == "line")
                    <td style="background-color: darkgrey"></td>
                    @endif
                    
                 @else
                    <td style="background-color: darkgrey"></td>
                 @endif

                 @endforeach
               
                
            </tr>
            @endif
            @endforeach
           
           </tbody>
        </table>
    </form>
     </div>
 
 
 @endsection