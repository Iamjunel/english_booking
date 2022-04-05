@extends('layout.taxi_layout')
   @section('content')
  {{-- 
    Teachers Homepage Menu
 --}}
     <div class="col-md-3 m-3">
     <a href="care-taxi/booking" class="p-3 btn btn-lg btn-outline  text-dark btn-block border-dark">Lesson Confirmation/ Registration</a>
     <a href="care-taxi/company/edit/{{$id}}" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark">Profile Information / Correction</a>
 </div>
 
 @endsection