@extends('layout.student_layout')
   @section('content')
     <div class="col-md-4 p-1 m-3">
     <a href="student/slot" class="p-3 btn btn-lg btn-outline  text-dark btn-block border-dark">{{-- 空き状況確認 --}} レッスン予約 {{-- booking the lesson --}}</a>
     <a href="student/teacherlist" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark">講師一覧 {{-- teacher lists --}}</a>
     <a href="student/profile" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark">プロフィール {{-- profile --}}</a>
     <a href="student/history" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark">レッスン履歴 {{-- history lists --}}</a>
     
 </div>
 
 @endsection