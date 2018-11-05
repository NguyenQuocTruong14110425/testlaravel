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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #000;
                font-family:  sans-serif;
                font-weight: 400;
                height: 100vh;
                margin: 0;
            }
            .container
            {
                margin-top: 100px;
            }
            .form-control
            {
                color: #1b1e21;
                border-radius: 10px;
                font-weight: 400;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!-- action="{{URL::to('/zendesk/search-user/search')}}" -->
                <form id="form-oauth" method="POST" >
                    <meta  id="csrfToken" name="csrf-token" content="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="query">Email</label>
                        <input type="text" id="query" name="query" class="form-control"
                               value="truong160196@gmail.com" required/>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>

            $('#form-oauth').submit(function (event) {
                event.preventDefault();

                // get the form data
                // there are many ways to get this data using jQuery (you can use the class or id also)
                var formData = {
                    "visitor": {
                        "phone": "",
                        "notes": "",
                        "id": "1.12345",
                        "name": "John",
                        "email": "visitor_john@doe.com"
                    },
                    "message": "Hi there!",
                    "type": "offline_msg",
                    "timestamp": 1444156010,
                    "session": {
                        "browser": "Safari",
                        "city": "Orlando",
                        "country_code": "US",
                        "country_name": "United States",
                        "end_date": "2014-10-09T05:46:47Z",
                        "id": "141109.654464.1KhqS0Nw",
                        "ip": "67.32.299.96",
                        "platform": "Mac OS",
                        "region": "Florida",
                        "start_date": "2014-10-09T05:28:31Z",
                        "user_agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10) AppleWebKit/600.1.25 (KHTML, like Gecko) Version/8.0 Safari/600.1.25"
                    }
                };
                var username ='truong160196@gmail.com';
                var password ='0123Truong';
                var auth = btoa(username + ":" + password);
                var url = 'https://www.zopim.com/api/v2/chats';
                var token = $('meta[name="csrf-token"]').attr('content');
                var  UAgent= window.navigator.userAgent;
                console.log(UAgent);
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Access-Control-Allow-Credentials': 'true',
                        'access-control-allow-headers':'Access-Control-Allow-Origin, Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type,CORELATION_ID',
                        'access-control-allow-methods':'GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS',
                        'Access-Control-Allow-Origin': 'http://localhost:8888',
                        'cache-control':'no-cache',
                        'contentType': 'application/json',
                        'Accept': 'application/json',
                        'User-Agent':UAgent,
                        'Authorization':"Basic " + auth
                    },
                    success: function (response) {
                        var obj = eval(response);
                        if (obj) {
                            if (obj.error == 0) {
                                alert('success');
                            }
                            else {
                                alert('error send');
                            }
                        }
                    },
                    complete: function () {
                        //this will run after sending an ajax complete
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(ajaxOptions);
                        alert('error occured');
                        // if any error occurs in request
                    }
                });
            });
    </script>
    </body>
</html>
