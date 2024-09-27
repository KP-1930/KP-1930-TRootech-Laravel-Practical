<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        h1 {
            font-size: 48px;
            color: #333;
        }
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>403 - Access Denied</h1>
    <p>You don't have permission to access this page.</p>
    <a href="{{ url('/home') }}">Go to Homepage</a>
</body>
</html>
