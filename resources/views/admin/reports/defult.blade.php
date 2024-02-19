<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @yield('css')
    <style>
            @import url(//fonts.googleapis.com/earlyaccess/phetsarath.css);

        body{
            font-family: 'Phetsarath', sans-serif;
        }

    </style>
</head>

<body>
    @yield('body')

    @yield('script')
</body>

</html>
