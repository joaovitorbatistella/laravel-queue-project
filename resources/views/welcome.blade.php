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
            .th {
                font-size:18px;
            }
            .td {
                font-size:18px;
                padding: 0px 8px; 
                border-top: 1px solid black;
                border-right: 1px solid black;
                border-bottom: 1px solid black;
            }
            .alert {
                position: relative;
                padding: 0.75rem 1.25rem;
                margin-bottom: 1rem;
                border: 1px solid transparent;
                border-radius: 0.25rem;
            }
            .alert-success {
                color: #1d643b;
                background-color: #d7f3e3;
                border-color: #c7eed8;
            }

            .alert-success hr {
                border-top-color: #b3e8ca;
            }

            .alert-success .alert-link {
                color: #123c24;
            }
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>


    </head>
    <body>
    @if(session()->has('message'))
        <div id="alert" class="alert alert-success">
            <div class="row">
                <div class="col-md-12">
                    <p>{{session('message')}}</p>
                </div>
            </div>
        </div>
    @endif
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
                <table class="table">
                    <thead>
                        <tr>
                            <th class="th" scope="col">#</th>
                            <th class="th" scope="col">Nome</th>
                            <th class="th" scope="col">Email</th>
                            <th class="th" scope="col">Criado em</th>
                            <th class="th" scope="col">Atualizado em</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($result as $row)
                        <tr>
                            <th class="td" scope="row">{{$row->id}}</th>
                            <td class="td">{{$row->name}}</td>
                            <td class="td">{{$row->email}}</td>
                            <td class="td">{{$row->created_at}}</td>
                            <td class="td">{{$row->updated_at}}</td>
                        </tr>
                    @endforeach
                    
                    
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script>
    $("#alert").fadeOut(8000);
</script>   