<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Translate</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Vazirmatn', sans-serif;

        }

        body {
            height: 100vh;
            text-align: center;
            background: #252525;

        }

        .page {
            color: #fff;
        }

        .content {
            text-align: right;
            margin: auto;
            width: 500px;
            background: white;
            color: #000;
            border-radius: 3px;

        }
    </style>
</head>

<body dir="rtl">

    <div class="main">

        @foreach ($data as $key => $value)
            <div class="page">
                <h4>{!! $key !!}</h4>
                <br>
                <div class="content">
                    <p>
                        {!! $value !!}
                    </p>
                </div>
            </div>
            <br>
            <hr>
            <br>
        @endforeach
    </div>



</body>

</html>
