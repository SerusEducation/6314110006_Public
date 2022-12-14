<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Error Page: 403</title>
    <style>
        body {
            background-color: black;
            animation-name: animation;
        }

        @keyframes animation {
            0%   {background-color: red;}
            25%  {background-color: yellow;}
            50%  {background-color: blue;}
            100% {background-color: green;}
        }
    </style>
</head>
<body>
    <div class="text-center">
        <img name="icon-danger" width="50%" src="{{ asset('images\danger.png') }}" alt="error">
        <h1 class="" style="color: red">403 Unauthorize</h1>
        <h2 class="" style="color: red">YOU'RE NOT ADMIN!!!</h2>
    </div>
</body>
</html>
