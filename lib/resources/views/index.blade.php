<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: sans-serif;
                font-weight: 600;
                height: 100vh;
                margin: 0;
                font-size:16px;
            }
            .form-basic
            {
                margin: 15px;
                padding: 15px 20px;
                border: 1px solid #5a6268;
                border-radius: 20px;
            }

            .table a
            {
                color: #4aa0e6;
            }
            .table a:hover
            {
                text-decoration: none;
                color: #f6993f;
            }
            .btn-danger
            {
                position: relative;
                color: #fff !important;
                border-radius: 50%;
                width: 25px;
                height: 25px;
                padding: 0 !important;
            }
            .btn-danger:hover
            {
                background: #900000;
            }
        </style>
    </head>
    <body>
            <div class="container">
                <div class="row">
                    <a type="buttons" class="btn btn-info" href="{{URL::to('home')}}">Back</a>
                </div>
                <div class="form-basic">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Date created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($line_of_text as $key=>$value)
                            <tr>
                                <td> <a href="javascript:void(0)"  onclick="getRepace('{{$key}}','{{$value["Value"]}}')">{{$key}}</a></td>
                                <td> <a href="javascript:void(0)" onclick="getRepace('{{$key}}','{{$value["Value"]}}')">{{$value["Value"]}}</a></td>
                                <td>{{ isset($value["Date"]) ? $value["Date"] : 'N\A'}}</td>
                                <td><a type="buttons" class="btn btn-danger" href="{{URL::to('test/delete/'.$key)}}">x</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <form class="form-basic" action="{{URL::to('test/repace')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Keyword</label>
                        <input type="text" id="text1" class="form-control" name="keyword" required>
                    </div>
                    <div class="form-group">
                        <label>Replace</label>
                        <input type="text" id="text2"  class="form-control" name="replace"  required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Repace</button>
                    </div>
                </form>
                <form class="form-basic" action="{{URL::to('test/create')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Key</label>
                        <input type="text" id="text1" class="form-control" name="key" placeholder="enter key" required>
                    </div>
                    <div class="form-group">
                        <label>Value english</label>
                        <input type="text" id="value_en"  class="form-control" name="value_en" placeholder="enter value vi" required>
                    </div>
                    <div class="form-group">
                        <label>Value viet nam</label>
                        <input type="text" id="value_vi"  class="form-control" name="value_vi" placeholder="enter value vi" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Add new</button>
                    </div>
                </form>
            </div>

    <script>
        function getRepace(key,value) {
            $('#text1').val(key);
            $('#text2').val(value);
            $('#text2').focus();
        }
    </script>
    </body>
</html>
