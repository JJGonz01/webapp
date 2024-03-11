<!DOCTYPE html>
<html lang="en">
<html>

<head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--CSS-->
        <link rel="stylesheet" href="{{asset('/css/main.css')}}">
        <link rel="stylesheet" href="{{asset('/css/navbar/navbar.css')}}">
        <link rel="stylesheet" href="{{asset('/css/auth/test.css')}}">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>


</head>
<body>
    <!--script src="{{asset('tests/tests.js')}}">
    </script-->
    @if(null != (auth()->user()))
   @endif
   <div class="slave-test">
       @yield('login')
   </div>
</body>
</html>