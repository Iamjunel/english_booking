 @extends('layout.admin_layout')
 @section('content')
     <div class="col-md-3 m-3">
     <a href="admin/register" class="p-3 btn btn-lg btn-outline  text-dark btn-block border-dark">講師登録 {{-- teacher registration --}}</a>
     {{-- new --}}
     <a href="admin/teachers" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark">{{-- 登録情報一覧・削除 --}} 講師一覧 {{-- teacher list --}}</a>     
     <a href="admin/student/register" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark">ユーザー登録 {{-- registration for users --}}</a>
     <a href="admin/student" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark "> ユーザー一覧 {{-- user list --}}   </a>
 </div>
 
 @endsection
 

 