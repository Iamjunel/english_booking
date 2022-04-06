 @extends('layout.admin_layout')
 @section('content')
     <div class="col-md-3 m-3">
     <a href="admin/register" class="p-3 btn btn-lg btn-outline  text-dark btn-block border-dark">新規登録</a>
     {{-- new --}}
     <a href="admin/teachers" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark">{{-- 登録情報一覧・削除 --}} 講師一覧・削除</a>     
     <a href="admin/teachers" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark disabled">レッスン予約状況</a>
     <a href="admin/teachers" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark disabled"> ユーザー情報   </a>
 </div>
 
 @endsection
 

 