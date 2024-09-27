<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
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
    <h1>404 - Page Not Found</h1>
    <p>Sorry, the page you're looking for doesn't exist.</p>
    <a href="{{ url('/home') }}">Go to Homepage</a>
</body>

</html>