<!DOCTYPE html>
<html lang="en">
<html>

<head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--CSS-->
        <link rel="stylesheet" href="{{asset('/css/main.css')}}">
</head>
<body>
    <script src="{{asset('tests/tests.js')}}">
    </script>
    @if(null != (auth()->user()))
   @endif
   <div class="slave-test">
       @yield('login')
   </div>

</body>
</html>