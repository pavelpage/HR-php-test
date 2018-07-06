<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="{{asset('/css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('/js/app.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$pageTitle}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>
                @if ($temperature)
                    Значение температуры - {{$temperature}} &deg;C
                    @else
                        В настоящий момент невозможно получить данные по температуре
                @endif
            </p>
        </div>
    </div>
</div>
</body>
</html>
