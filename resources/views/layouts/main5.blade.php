<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="card text-center">
        <div class="card-header">
            @include('layouts.header5')
        </div>

        <div class="card-body">
            @yield('content')
        </div>

        <div class="card-footer text-muted panel-footer">
            Kreirao: Željko Frketić
            <h6>&bdquo;Algebra učilište – BACK-END DEVELOPER&ldquo;</h6>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    @yield('script')
</body>

</html>