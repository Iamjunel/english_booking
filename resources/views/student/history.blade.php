 @extends('layout.student_layout')
 @section('content')
 <div class="container">
     <div class="col-md-12 col-sm-12 clearfix">  
         <div class=""> 
        {{--  <a href="/student" class="text-dark pr-1 " style="font-size: 21px;vertical-align: sub;"><i class="fas fa-2x fa-caret-left text-secondary"></i></a> --}} 
         <span class="h3 text-center"><center>レッスン履歴</center></span>
         </div>
         <table class="table table-striped table-hover table-bordered text-center ">
        <thead >
            <tr >
        
            <th class="text-center" style="vertical-align:middle">日時</th>
            <th class="text-center" style="vertical-align:middle">講師</th>

            </tr>
        </thead>
        <tbody >
            @if($teacher)
                @foreach ($teacher as $t)
                
                <tr>
                <td style="vertical-align:middle">{{$t->name}}</td>
                
                <td style="vertical-align:middle"><a class="btn btn-danger" href="/student/teacher/detail/{{$t->enc_id}}">詳細</a></td>
                </tr>
                
                @endforeach
            @endif
            
        </tbody>
        </table>
     </div>
 </div>
 
 @endsection
 
