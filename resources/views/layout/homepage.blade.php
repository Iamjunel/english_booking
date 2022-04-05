<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .fc-past {
    background-color: rgb(231, 230, 230);
}
.bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }


    .nav-masthead .nav-link {
  padding: .25rem 0;
  font-weight: 700;
  color: rgba(5,57,101,0.5);
  background-color: transparent;
  border-bottom: .25rem solid transparent;
}

.nav-masthead .nav-link:hover,
.nav-masthead .nav-link:focus {
  border-bottom-color: rgba(5,57,101,0.5);
}

.nav-masthead .nav-link + .nav-link {
  margin-left: 1rem;
}


.marker_hoso {
  background: linear-gradient(transparent 60%, #ffc107 60%);
}

        </style>
         
</head>
<body class="d-flex h-100 text-center bg-light">

    
@yield('content')


<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
   