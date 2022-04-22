 @extends('layout.student_layout')
 @section('content')
 <div class="container">
     <div class="col-md-12 col-sm-12 clearfix">  
         <div class=""> 
         <a href="/student" class=" text-dark pr-1 " style="font-size: 21px;vertical-align: sub;"><i class="fas fa-2x fa-caret-left text-secondary"></i></a> 
         <span class="h3 text-center" style="margin-left:36%;vertical-align: text-bottom;">講師一覧</span>
         </div>
         <table class="table table-striped table-hover table-bordered text-center ">
        <thead >
            <tr >
        
            <th class="text-center" style="vertical-align:middle">講師名</th>
            <th class="text-center" style="vertical-align:middle">初心者向け {{-- beginner --}}</th>
            <th class="text-center" style="vertical-align:middle">試験対策 {{-- exam --}}</th>
            <th class="text-center" style="vertical-align:middle">日常会話 {{-- daily conversation --}}</th>

            <th></th>
            </tr>
        </thead>
        <tbody >
            @foreach ($teacher as $t)
           
            <tr>
            <td style="vertical-align:middle">{{$t->name}}</td>
            <td style="vertical-align:middle">
                @if($t->beginner == "circle")
                <span class="text-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="8"/>
                </svg>
                </span>
                @elseif($t->beginner =="triangle")
                <span class="text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                            </svg>
                            </span>
                @elseif($t->beginner =="times")
                <span class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            </span>
                @else 
                <span > </span>
                @endif
            </td>
           
            <td style="vertical-align:middle">
                @if($t->exam == "circle")
                <span class="text-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="8"/>
                </svg>
                </span>
                @elseif($t->exam =="triangle")
                <span class="text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                            </svg>
                            </span>
                @elseif($t->exam =="times")
                <span class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            </span>
                @else 
                <span > </span>
                @endif
            </td>
            <td style="vertical-align:middle">
                @if($t->conversation == "circle")
                <span class="text-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="8"/>
                </svg>
                </span>
                @elseif($t->conversation =="triangle")
                <span class="text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z"/>
                            </svg>
                            </span>
                @elseif($t->conversation =="times")
                <span class="text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            </span>
                @else 
                <span > </span>
                @endif
            </td>
            <td style="vertical-align:middle"><a class="btn btn-danger" href="/student/teacher/detail/{{$t->enc_id}}">詳細</a></td>
            </tr>
            
          
            @endforeach
            
            
        </tbody>
        </table>
     </div>
 </div>
 
 @endsection
 
