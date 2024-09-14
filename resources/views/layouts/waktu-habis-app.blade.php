<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.375rem;
            box-shadow: 0 0 0.125rem rgba(0, 0, 0, 0.075);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        .alert {
            border: 1px solid #dc3545;
            background-color: #f8d7da;
            color: #721c24;
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }

        .alert h4 {
            margin-top: 0;
            font-size: 1.5rem;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            text-align: center;
            text-decoration: none;
            border-radius: 0.375rem;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-primary {
            color: #ffffff;
            background-color: #007bff;
            border: 1px solid #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>