<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        input[name="cid"] {
        text-transform: lowercase;
        }
        input[name="password"] {
        text-transform: lowercase;
        }
        </style>
</head>
{{-- <body style="background-color:rgb(231 226 190 / 38%);overflow:hidden"> --}}
    <body style="overflow-x:hidden">
    <nav class="container pt-2">
        @if(Session::get('cid'))
            <a class=" text-dark float-right" href="{{url('admin/logout')}}">ログアウト</a>
        @endif
        {{-- <a href="/admin" class="text-dark" style="text-decoration: none">津ケアタクネット</a> --}}
        <a href="/admin" class="text-dark" style="text-decoration: none">Think English (admin)</a>
    </nav>
    <hr/>
    <div class="">
        <div class="row justify-content-center pt-2">
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
            @endif
        </div>
        <div class="row justify-content-center">
            
           

           @yield('content')
     </div>
    </div> 

 
 <script src="{{ asset('js/app.js') }}"></script>
 <script>
   function halfWidth(obj) {
   var str = obj.value; 
   var result =""; 
   str = str.replace(/[\u3040-\u309F]+/g, "");
   if(str.length == 0){
     obj.value = "";
   }
   else
   {
       for (var i = 0; i <str.length; i ++){
     
        if (str.charCodeAt (i) == 12288){
        result += String.fromCharCode(str.charCodeAt (i) -12256); 
        continue;
        } 
        
        if (str.charCodeAt (i)> 65280 && str.charCodeAt (i) <65375){ 
        result += String.fromCharCode (str.charCodeAt (i) -65248);
        }
        else 
        {
          result += String.fromCharCode (str.charCodeAt (i));
        } 
    obj.value = result.toLowerCase(); 
    }
   }
   
   console.log(str.length);

   
  }
   
     $('div.alert').delay(3000).slideUp(300);
     </script>



</body>
</html>
   