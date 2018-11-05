<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{URL::asset('public/css/style.css')}}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="{{URL::asset('public/js/chatsdk.js')}}" type="text/javascript"></script>        <!-- Styles -->
        <script src="{{URL::asset('public/js/chat.js')}}" type="text/javascript"></script>        <!-- Styles -->
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{--<button onclick="getChat()" class="btn btn-success">get all chat</button>--}}
                {{--<button onclick="getRESTChat()" class="btn btn-success">get demo chat</button>--}}
                {{--<!-- action="{{URL::to('/zendesk/search-user/search')}}" -->--}}
                {{--<form id="form-chat-create" method="POST" >--}}
                    {{--<meta  id="csrfToken" name="csrf-token" content="{{ csrf_token() }}">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="query">Email</label>--}}
                        {{--<input type="text" id="query" name="query" class="form-control"--}}
                               {{--value="truong160196@gmail.com" required/>--}}
                    {{--</div>--}}
                    {{--<button type="submit" class="btn btn-success">Create</button>--}}
                {{--</form>--}}
                {{--<form id="form-chat-update" method="PUT" >--}}
                    {{--<meta  id="csrfToken" name="csrf-token" content="{{ csrf_token() }}">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="query">Email</label>--}}
                        {{--<input type="text" id="query" name="query" class="form-control"--}}
                               {{--value="truong160196@gmail.com" required/>--}}
                    {{--</div>--}}
                    {{--<button type="submit" class="btn btn-success">Update</button>--}}
                {{--</form>--}}
            </div>
        </div>
    </div>
    <div id="error"></div>
    <script>

        window.addEventListener("load", init(), false);

        // function onLoad() {
        //     zChat.init({
        //         account_key: '66JrUsDcIYOT6Rxs33LlRNcYCGhKcHKM'
        //     });
        //     zChat.on('error', function(event_data) {
        //         console.log('error message');
        //     });
        //     zChat.on('connection_update', function(status) {
        //         console.log(status);
        //         if (status === 'connected') {
        //            console.log('connected update')
        //         }
        //     });
        //     zChat.setVisitorInfo({ display_name: 'Khach qua duong' }, function(err) {
        //         if (!err) {
        //             // server has received visitor name update successfully
        //             var info = zChat.getVisitorInfo();
        //             $('#name').append(info.display_name)
        //             console.log(zChat.getVisitorInfo());  // { display_name: 'Jane' }
        //         }
        //     });
        //     zChat.on('chat', function(event_data) {
        //         if (event_data.type === 'chat.msg') {
        //             console.log(event_data);
        //             var displayName = event_data.display_name;
        //             var MessChat = event_data.msg;
        //             var option  =  event_data.options;
        //             var divMessage = '<div class="mess-2"><p>' + MessChat + '</p><span>' + displayName + '</span></div>';
        //             if(option.length > 0)
        //             {
        //                 var messquestion = '<p>'+ MessChat +'</p>';
        //                 var messOption = '';
        //                 for (let i = 0; i< option.length;i++)
        //                 {
        //                     var input = '<input class="form-check-input" type="radio" name="option" id="option'+i+'" value="'+ option [i]+'">';
        //                     var lable = '<label class="form-check-label" for="option'+i+'">'+  option [i] +'</label>';
        //                     messOption+= '<div class="form-check">'+ input + lable +'</div>'
        //                 }
        //                 divMessage = '<div class="mss-group">' + messquestion + messOption +'</div>'
        //             }
        //             $('#message').append(divMessage)
        //             console.log('msg loading ....')
        //         }
        //         if (event_data.type === 'chat.queue_position') {
        //             console.log('msg queue position ....')
        //         }
        //         if (event_data.type === 'chat.memberjoin') {
        //             console.log('msg member join ....')
        //         }
        //         if (event_data.type === 'chat.memberleave') {
        //             console.log('msg member leave ....')
        //         }
        //         if (event_data.type === 'chat.typing') {
        //             console.log('someone chating ....')
        //         }
        //     });
        //     var wsUri = "wss://rtm.zopim.com/stream";
        //     websocket = new WebSocket(wsUri);
        //     websocket.onopen = function(evt) { onOpen(evt) };
        //     websocket.onclose = function(evt) { onClose(evt) };
        //     websocket.onmessage = function(evt) { onMessage(evt) };
        //     websocket.onerror = function(evt) { onError(evt) };
        // }
        //
        // function onOpen(evt) {
        //     console.log("Connected to server");
        // }
        //
        // function onClose(evt) {
        //     console.log(evt);
        //     console.log("Not connected");
        // }
        //
        // function onMessage(evt) {
        //     // There are two types of messages:
        //     // 1. a chat participant message itself
        //     // 2. a message with a number of connected chat participants
        //     // var a = zChat.getChatLog();
        //     console.log('message');
        //     var message = evt.data;
        //     if (message.startsWith("log:")) {
        //         console.log("log" + length);
        //     }else if (message.startsWith("connected:")) {
        //         console.log("log" + message);
        //     }
        // }
        //
        // function onError(evt) {
        //     console.log("Communication error");
        // }
        //
        // function addMessage(message) {
        //     console.log(message);
        //     websocket.send( zChat.sendChatMsg(message));
        //     var divMessage = '<div class="mess-1"><p>' + message + '</p></div>'
        //     $('#message').append(divMessage)
        //
        // }
        //
        // $('#form-chat').submit(function (event) {
        //     event.preventDefault();
        //     var mss = $('#msg').val();
        //    $('#msg').val('');
        //     addMessage(mss);
        // })

        // $('input:radio').change(function (event) {
        //     if($(this).val())
        //     {
        //         var mssoption = $(this).val();
        //         $('#msg').val('');
        //         addMessage(mssoption);
        //     }
        // })
        function getRESTChat()
        {
            var username ='truong160196@gmail.com';
            var password ='0123Truong';
            var urlPostChat = 'https://rtm.zopim.com/stream/heldsdslo';
            var URLGet = '{{URL::to('/zendesk/chat/all')}}';
            var Method = 'GET';
            var Header = [
                'Content-Type: application/json',
                'Authorization: Bearer 00XoDr8NpSzVfn94Ecp1b33ZiBKP9VCHMIQyM9DEFCiLEkNCOZj0WX0PYBRwisAb'
            ];
            var Data = {
                "URL": urlPostChat,
                "UserName":username,
                "Password":password,
                "Method":Method,
                "Header":Header
            }
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'GET',
                url: URLGet,
                data: Data,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Access-Control-Allow-Credentials': 'true',
                    'access-control-allow-headers':'Access-Control-Allow-Origin, Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type,CORELATION_ID',
                    'access-control-allow-methods':'GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS',
                    'contentType': 'application/json',
                    'Accept': 'application/json',
                },
                success: function (response) {
                    console.log(response);
                    document.getElementById("error").innerHTML =response.id;
                },
                complete: function () {
                    //this will run after sending an ajax complete
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.responseText);
                    document.getElementById("error").innerHTML =xhr.responseText;
                    // if any error occurs in request
                }
            });
        }
            function getChat()
            {
                var username ='truong160196@gmail.com';
                var password ='0123Truong';
                var urlPostChat = 'https://www.zopim.com/api/v2/chats';
                var URLGet = '{{URL::to('/zendesk/chat/all')}}';
                var Method = 'GET';
                var Header = [ 'Content-Type: application/json'];
                var Data = {
                    "URL": urlPostChat,
                    "UserName":username,
                    "Password":password,
                    "Method":Method,
                    "Header":Header
                }
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'GET',
                    url: URLGet,
                    data: Data,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Access-Control-Allow-Credentials': 'true',
                        'access-control-allow-headers':'Access-Control-Allow-Origin, Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type,CORELATION_ID',
                        'access-control-allow-methods':'GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS',
                        'contentType': 'application/json',
                        'Accept': 'application/json',
                    },
                    success: function (response) {
                        console.log(response);
                        document.getElementById("error").innerHTML =response.id;
                    },
                    complete: function () {
                        //this will run after sending an ajax complete
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.responseText);
                        document.getElementById("error").innerHTML =xhr.responseText;
                        // if any error occurs in request
                    }
                });
            }
            $('#form-chat-create').submit(function (event) {
                event.preventDefault();

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
                var urlPostChat = 'https://www.zopim.com/api/v2/chats';
                var URLPost = '{{URL::to('/zendesk/chat')}}';
                var Method = 'POST';
                var Header = [ 'Content-Type: application/json'];
                console.log(URLPost);
                var Data = {
                    "URL": urlPostChat,
                    "Message":formData,
                    "UserName":username,
                    "Password":password,
                    "Method":Method,
                    "Header":Header
                }
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: URLPost,
                    data: Data,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Access-Control-Allow-Credentials': 'true',
                        'access-control-allow-headers':'Access-Control-Allow-Origin, Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type,CORELATION_ID',
                        'access-control-allow-methods':'GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS',
                        'contentType': 'application/json',
                        'Accept': 'application/json',
                    },
                    success: function (response) {
                        console.log(response);
                        document.getElementById("error").innerHTML =response.id;

                        // var obj = eval(response);
                        // if (obj) {
                        //     if (obj.error == 0) {
                        //         alert('success');
                        //     }
                        //     else {
                        //         alert('error send');
                        //     }
                        // }
                    },
                    complete: function () {
                        //this will run after sending an ajax complete
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.responseText);
                        document.getElementById("error").innerHTML =xhr.responseText;
                        // if any error occurs in request
                    }
                });
            });
            $('#form-chat-update').submit(function (event) {
                event.preventDefault();

                var formData = {"visitor.name" : "Joe"};
                var username ='truong160196@gmail.com';
                var password ='0123Truong';
                var urlPostChat = 'https://www.zopim.com/api/v2/chats/' + "1810.2869679.R7HejsKe0CmZW" ;
                var URLPost = '{{URL::to('/zendesk/chat')}}';
                var Method = 'PUT';
                var Header = [ 'Content-Type: application/json'];
                console.log(URLPost);
                var Data = {
                    "URL": urlPostChat,
                    "Message":formData,
                    "UserName":username,
                    "Password":password,
                    "Method":Method,
                    "Header":Header
                }
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'PUT',
                    url: URLPost,
                    data: Data,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Access-Control-Allow-Credentials': 'true',
                        'access-control-allow-headers':'Access-Control-Allow-Origin, Access-Control-Allow-Headers, Origin, X-Requested-With, Content-Type,CORELATION_ID',
                        'access-control-allow-methods':'GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS',
                        'contentType': 'application/json',
                        'Accept': 'application/json',
                    },
                    success: function (response) {
                        console.log(response);
                        document.getElementById("error").innerHTML =response;

                        // var obj = eval(response);
                        // if (obj) {
                        //     if (obj.error == 0) {
                        //         alert('success');
                        //     }
                        //     else {
                        //         alert('error send');
                        //     }
                        // }
                    },
                    complete: function () {
                        //this will run after sending an ajax complete
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.responseText);
                        document.getElementById("error").innerHTML =xhr.responseText;
                        // if any error occurs in request
                    }
                });
            });
    </script>
    </body>
</html>
