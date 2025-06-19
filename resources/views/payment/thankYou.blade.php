<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <h1>Thank you for your payment.</h1>
    <h4>{{$statusTitle}}</h4>
    <strong>{{$statusDescription}}</strong>
</body>
</html>
