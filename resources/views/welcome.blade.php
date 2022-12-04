<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            * {
                font-size: 20px;
            }
            .row {
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                justify-content: space-around;
                align-items: stretch;
                align-content: space-around;
            }
            .col {
                display: flex;
                flex-direction: column;
                align-items: stretch;
                align-content: space-around;
                justify-items: center;
                height: 98vh
            }
            .col-md-1 {width: 8.333333333%;}.col-md-2 {width: 16.666666666%;}.col-md-3 {width: 24.999999999%;}.col-md-4 {width: 33.333333332%;}.col-md-5 {width: 41.666666665%;}.col-md-6 {width: 49.999999998%;}.col-md-7 {width: 58.333333331%;}.col-md-8 {width: 66.666666664%;}.col-md-9 {width: 74.999999997%;}.col-md-10 {width: 83.33333333%;}.col-md-11 {width: 91.666666663%;}.col-md-11 {width: 100%;}
            .line-left {
                border-left: 1px solid;
            }
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col col-md-4">
                <form method="POST" action="/subscriber/save" enctype="multipart/form-data">
                    @csrf
                
                    <input type="file" accept=".csv" required name="csvFile" id="csvFile">
                    <br>
                    <br>
                    <input type="submit" value="Upload">
                </form>
            </div>
            <div class="col-md-8 line-left">

            </div>
        </div>
    </body>
</html>
