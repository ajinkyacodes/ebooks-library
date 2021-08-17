<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ebooks Library</title>
    <link rel="icon" href="{{ asset('/assets/images/ebook_logo.png') }}" type="image/gif" sizes="16x16">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Mali:ital,wght@0,200;0,300;0,400;0,500;0,600;1,200;1,300;1,400;1,500;1,600;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Fredoka+One&family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&family=Russo+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    @yield('styles')
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    @include('inc.header')
    @yield('content')
    @include('inc.footer')
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        @if(Session::has('success'))
        toastr.success("{{Session::get('success')}}");
        @endif
        @if(Session::has('warning'))
        toastr.warning("{{Session::get('warning')}}");
        @endif
        @if(Session::has('info'))
        toastr.info("{{Session::get('info')}}");
        @endif
        @if(Session::has('error'))
        toastr.error("{{Session::get('error')}}");
        @endif
    </script>
    @yield('scripts')
</body>
</html>
