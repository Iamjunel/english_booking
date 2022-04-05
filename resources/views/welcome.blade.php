@extends('layout.homepage')
{{--  @section('content')
     <div class="col-md-3 m-3">
     <a href="user" class="p-3 btn btn-lg btn-outline  text-dark btn-block border-dark">利用者</a>
     <a href="care-taxi" class="p-3 btn btn-lg btn-outline  text-dark btn-block border-dark">介護タクシー</a>
     <a href="admin/login" class=" p-3 btn btn-lg btn-outline text-dark  btn-block border-dark">管理者</a>
 </div>
 @endsection
 --}}
 @section('content')
     
 <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <div class="mb-auto">
        <div>
          <h6 class="float-left mb-0">介護タクシー予約サイト</h6>
          <p class="nav nav-masthead justify-content-center float-right">津ケアタクネット</p>
        </div>

    </div>

      <div class="px-3">
        <img class="img-fluid" src="{{ asset('images/top-rogo.gif') }}" alt="津ケアタクネット">
        <p class="lead my-3">この「津ケアタクネット」では、<br>三重県津市内の介護タクシー空き状況がリアルタイムにチェックできます。</p>
        <h3 class="my-5"><span class="marker_hoso">空き状況をチェックする</span> → <span class="marker_hoso">ドライバーに電話</span> → <span class="marker_hoso">スグに予約完了！</span></h3>
        <div class="mb-5">
      <a class="btn btn-secondary btn-lg" href="user/login" role="button">空き状況をチェックする</a>
    </div>

    </div>
      <div class="mt-auto">
        <div>
          <nav class="nav nav-masthead justify-content-center float-right">
            <a class="nav-link" href="care-taxi/login">TAXY</a>
            <a class="nav-link" href="admin/login">kanri</a>
          </nav>
        </div>
    </div>

    </div>
 @endsection