<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Newslatter - Lieper Books</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #beb7df;
        }

        .card {
            width: 400px;
            padding: 50px 50px;
            position: relative;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2)
        }

        .card h3 {
            color: #111;
            margin-bottom: 50px;
            padding-left: 10px;
            line-height: 1em
        }

        .inputbox {
            margin-bottom: 50px
        }

        .inputbox input {
            position: absolute;
            width: 300px;
            background: transparent
        }

        .inputbox input:focus {
            color: #495057;
            background-color: #fff;
            border-color: #e54b38;
            outline: 0;
            box-shadow: none
        }

        .inputbox span {
            position: relative;
            top: 7px;
            left: 1px;
            padding-left: 10px;
            display: inline-block;
            transition: 0.5s
        }

        .inputbox input:focus~span {
            transform: translateX(-10px) translateY(-32px);
            font-size: 12px
        }

        .inputbox input:valid~span {
            transform: translateX(-10px) translateY(-32px);
            font-size: 12px
        }
    </style>
</head>

<body class="antialiased">
    <div class="card">
        <h3>Our Newsletter</h3>
        <form method="post" action="{{ url('newslatterUser') }}">
            <div class="inputbox">
                <input type="text" name="email" class="form-control" required="required">
                <span>Email</span>
            </div>
            <button class="btn btn-info btn-block">Send</button>
        </form>
    </div>
</body>

</html>