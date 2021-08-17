<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ebook Library</title>
    <style>
        .wrapper {
            max-width: 1400px;
            margin: 0 auto;
        }

        img {
            width: 100%;
            display: block;
        }

        section .wrapper { width: 90%; }

        .page-404 figure {
            width: 80%;
            margin: 0 auto;
        }

        .page-404 .backtohome-container { text-align: center; }

        .page-404 .backtohome-container a {
            color: #2d3748;
            font-family: sans-serif;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
            transition: .5s linear all;
        }

        .page-404 .backtohome-container a:hover { color: #a0adc3; }

    </style>
</head>
<body>
<main class="page-404">
    <div class="wrapper">
        <figure>
            <img src="{{asset('assets/images/404_page(1).gif')}}" alt="404 Page not Found">
        </figure>
        <div class="backtohome-container">
            <a href="{{route('home')}}">Back To Home</a>
        </div>
    </div>
</main>
</body>
</html>
