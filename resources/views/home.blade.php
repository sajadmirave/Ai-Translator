<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OCR Translator</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Vazirmatn', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0d1b2a;
            flex-flow: column;
        }

        .container {
            width: 400px;
            height: 120px;
            background: #1b263b;
            border-radius: 14px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-flow: column;
            margin: 20px;
        }

        .btn {
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center;
        }

        button {
            padding: 7px 17px;
            border: none;
            background: #415a77;
            border-radius: 6px;
            margin-top: 5px;
            cursor: pointer;
            color: #fff;
        }

        .file {
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center
        }

        input {
            width: 200px;
        }

        .txt {
            /* margin: 10px; */
            color: #e63946;
        }
    </style>
</head>

<body>

به برنامه خوش آمدید
    <div class="container">
        <form action="{{ route('convert.tiff') }}" enctype="multipart/form-data" method="post">
            <div class="file">
                <input type="file" name="pdf">
            </div>

            <div class="btn">
                <select name="language" id="">
                    <option value="persion-to-english">فارسی به انگلیسی</option>
                    <option value="english-to-persion">انگلیسی به فارسی</option>
                    <option value="french-to-persion">فرانسوی به فارسی</option>
                </select>
                <button type="submit">ترجمه</button>
            </div>


        </form>
    </div>
    <p class="txt">.این فرایند ممکن است کمی طول بکشد</p>
</body>

</html>
