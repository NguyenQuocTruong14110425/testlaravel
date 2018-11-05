$(function($){
    init = function(url)
    {
        InnerHTML.ElementChat();
        onLoad(url);
    }
    onLoad = function(url) {
        zChat.init({
            account_key: 'FD82F799B035AF1C43FDDADE4A0C5E699D5C5F493DAF6DE7D1039E354C311006',
            suppress_console_error : true
        });
        // zChat.init({
        //     account_key            : '66JrUsDcIYOT6Rxs33LlRNcYCGhKcHKM',
        //     suppress_console_error : true,
        //     authentication         : {
        //         jwt_fn : function(callback) {
        //             fetch('http://localhost:8888/testlaravel/zendesk/chat').then(function(res) {
        //                 console.log(res);
        //                 res.text().then(function(jwt) {
        //                     // $('#error').append(jwt);
        //                     // console.log(jwt);
        //                     callback(jwt);
        //                 });
        //             });
        //         }
        //     }
        // });
        zChat.on('error', function(event_data) {
            console.log('error message');
        });
        zChat.on('connection_update', function(status) {
            if (status === 'connected') {
                InnerHTML.EvenRating('Please rate for my shop');
                console.log('connected');
                InnerHTML.EvenEdit();
            }
        });
        InnerHTML.MessStatus('name');
        zChat.on('agent_update', function(event_data) {
            var status = event_data.title + ' ' + event_data.display_name + ' has update type message';
            var divStatus = InnerHTML.MessStatusLeave(status);
            $('#message').append(divStatus)
        });
        zChat.on('visitor_update', function(event_data) {
            console.log(event_data);
        });
        zChat.setVisitorInfo({ display_name: 'support customer' }, function(err) {
            if (!err) {
                var info = zChat.getVisitorInfo();
                InnerHTML.MessDisplayName('name',info.display_name);
            }
        });
        zChat.on('chat', function(event_data) {
            if (event_data.type === 'chat.msg') {
                console.log(event_data);
                var displayName = event_data.display_name;
                var MessChat = event_data.msg;
                var option  =  event_data.options;
                var divMessage = InnerHTML.MessChatReceive(MessChat,displayName);

                if(option.length > 0)
                {
                    divMessage = InnerHTML.MessChatOption(option,MessChat);
                }
                $('#message').append(divMessage)
                $('input:radio').click(function (event) {
                    if($(this).val())
                    {
                        var mssoption = $(this).val();
                        ChatZopim.SendMessage(mssoption);
                    }
                })
                InnerHTML.ScrollBottom('message');
            }
            if (event_data.type === 'chat.queue_position') {
                var status ='Queue position ....';
                console.log(status);
                // var divStatus = InnerHTML.MessStatusLeave(status);
                // $('.status-mess').append(divStatus)
            }
            if (event_data.type === 'chat.memberjoin') {
                var status = event_data.nick + ' ' + event_data.display_name + ' has joined';
                var divStatus = InnerHTML.MessStatusLeave(status);
                $('#message').append(divStatus)
            }
            if (event_data.type === 'chat.memberleave') {
                var status = event_data.nick + ' ' + event_data.display_name + ' has left';
                var divStatus = InnerHTML.MessStatusLeave(status);
                $('#message').append(divStatus)
                InnerHTML.MessStatus('name');
            }
            if (event_data.type === 'chat.typing') {
                var status =  event_data.nick + ' ' + event_data.display_name + ' chating ....';
                var divStatus = InnerHTML.MessStatusLeave(status);
                $('#message').append(divStatus)
            }
            if (event_data.type === 'chat.request.rating') {
                console.log('request rating')
                var status =  event_data.nick + ' ' + event_data.display_name + ' has sent a Chat Rating request' ;
                var divStatus = InnerHTML.MessStatusLeave(status);
                $('#message').append(divStatus)
                InnerHTML.EventRequestRationg('Please rate for my shop');
            }
            if (event_data.type === 'chat.rating') {
                console.log('chat rating');
            }
        });
        // SocketWeb.runServer(url);
    }
    SocketWeb =
        {
            runServer: function(url)
            {
                var wsUri = url;
                websocket = new WebSocket(wsUri);
                websocket.onopen = function(evt) { SocketWeb.onOpen(evt) };
                websocket.onclose = function(evt) { SocketWeb.onClose(evt) };
                websocket.onmessage = function(evt) { SocketWeb.onMessage(evt) };
                websocket.onerror = function(evt) { SocketWeb.onError(evt) };
            },
            onOpen: function(evt)
            {
                console.log("Connected to server");
            },
            onClose: function(evt)
            {
                console.log("Not connected");
            },
            onError: function(evt)
            {
                console.log("Communication error");
            },
            onMessage: function(evt)
            {
                console.log(evt);
            },
            addMessage: function(message)
            {
                // websocket.send( zChat.sendChatMsg(message));
                msg = {}
                zChat.sendChatMsg(message);
                var divMessage = InnerHTML.MessChatSend(message);
                $('#message').append(divMessage)
                InnerHTML.ScrollBottom('message');
            }
        }
    InnerHTML =
        {
            ElementChat: function()
            {
                var divTag = '<div id="form-chat"><div id="name"> <button type="button" class="btn btn-close" id="btn-close"><i class="fas fa-times"></i></button></div><div class="form-group" id="chat-mess"><div class="message" id="message"><div class="mess-2"><p>Hello, welcome shop, can i help you?</p></div></div></div><div id="comment"><div class="input-group"><input type="text" id="msg" name="msg" class="form-control" placeholder="nhập tin nhắn"/> <div class="input-group-append"><div id="emoji" class="emoji"><div class="lst-emoji"><button id="sticker" class="btn btn-icon">😃</button><button id="sticker" class="btn btn-icon">🐻</button> <button id="sticker" class="btn btn-icon">🍔</button><button id="sticker" class="btn btn-icon">⚽</button><button id="sticker" class="btn btn-icon">🌇</button><button id="sticker" class="btn btn-icon">💡</button><button id="sticker" class="btn btn-icon">🎌</button></div><div id="dashboard-emoji" class="dashboard-emoji row"></div></div><a type="buttons" id="btn-send" class="btn btn-success"><i class="fas fa-share-square"></i></a><a type="buttons" id="btn-emoji" class="btn btn-emoji"><i class="far fa-smile-beam"></i></a><a type="buttons" id="btn-rating" class="btn btn-ratting disable"><i class="fas fa-star"></i></a></div></div></div></div>';
                $( document ).ready(function() {
                    $('#btn-send').click(function (event) {
                        var mss = $('#msg').val();
                        if(mss != '')
                        {
                            $('#msg').val('');
                            ChatZopim.SendMessage(mss);
                        }
                    })
                    $('#msg').keyup(function (event) {
                        if(event.keyCode == 13)
                        {
                            var mss = $('#msg').val();
                            if(mss != '')
                            {
                                $('#msg').val('');
                                ChatZopim.SendMessage(mss);
                            }
                        }
                    })
                    $('#btn-close').click(function (event) {
                        $('#message').val('');
                        ChatZopim.CloseMessage();
                    })
                    var arr_icon_smile = ['😀','😂','🤣','😃','😅','😆','😉','😊','😋','😎','😍','😘','😗','😙','😚','🙂','🤗','🤩','😡','😵','🤡','🧐','🤭','🤫','👨‍⚕️','👩‍⚕️','👨‍','🧙','👨‍👩‍👦','💪','👈','👉','👏','🌂']
                    $('#btn-emoji').click(function (event) {
                        $('li').remove();
                        $('#emoji').toggle(function(){
                            for(let i=0;i< arr_icon_smile.length; i++)
                            {
                                var icon = '<li><button id="icon'+ i +'" class="btn col-2">'+ arr_icon_smile[i]+ '</button></li>'
                                $('#dashboard-emoji').append(icon)
                            }
                            $('li>.btn').click(function(){
                                var text = $('#msg').val()  + ' ' + $(this).text();
                                $('#msg').val(text);
                            });
                        });
                    })

                    $('#name').click(function(event){
                        console.log(event.target.tagName);
                        if(event.target.tagName != 'P' && event.target.tagName != 'INPUT' && event.target.tagName != 'I')
                        {
                            $('#comment').toggle();
                            $('#chat-mess').toggle();
                            $('#btn-close').toggle();
                        }
                    });
                });
                $('body').append(divTag);
            },
            MessChatSend : function(message)
            {
                var pTag = '<p>' + message + '</p>'
                var divTag = '<div class="mess-1">'+ pTag +'</div>'
                return divTag;
            },
            MessChatReceive : function(message,displayName)
            {
                var pTag = '<p>' + message + '</p>'
                var DisplayNameTag = '<span>' + displayName +'</span>'
                var divTag = '<div class="mess-2">'+ pTag + DisplayNameTag +'</div>'
                return divTag;
            },
            MessChatOption: function(arrOption,message,name="option",type ="radio")
            {
                var messquestion = '<p>'+ message +'</p>';
                var messOption = '';
                for (let i = 0; i< arrOption.length;i++)
                {
                    var input = '<input class="form-check-input" type="radio" name="option" id="option'+i+'" value="'+ arrOption[i]+'">';
                    var lable = '<label class="form-check-label" for="option'+i+'">'+  arrOption[i] +'</label>';
                    messOption += '<div class="form-check">'+ input + lable +'</div>'
                }
                divTag = '<div class="mss-group"><div class="option">' + messquestion + messOption +'</div></div>'
                return divTag;
            },
            MessStatus: function(id)
            {
                zChat.on('account_status', function(event_data) {
                    var status = '<span class="'+ event_data +'"></span>'
                    $('#' + id).append(status)
                });
            },
            MessDisplayName: function(id,name)
            {
                $('#display-name').remove();
                var nameInfo = '<p title="Nhấp vào đây để thay đổi tên" id="display-name">' + name + '</p>'
                $('#' + id).append(nameInfo)
            },
            MessStatusLeave: function(status)
            {
                var statusLeave = '<div class="status-mess"><p>' + status + '</p></div>'
                return statusLeave;
            },
            ScrollBottom: function(id){
                var element = document.getElementById(id);
                element.scrollTop = element.scrollHeight - element.clientHeight;
            },
            EvenEdit: function()
            {
                $('#display-name').click(function(){
                    $(this).hide();
                    var input = '<input type="text" class="form-control" id="displayname" name="displayname" placeholder="nhập tên hiện thị"/>'
                    var button = '<button class="btn btn-info" id="btn-save"><i class="fas fa-save"></i></button>'
                    var cancel = '<button class="btn btn-info" id="btn-cancel"><i class="fas fa-ban"></i></button>'
                    var buttonGroup = '<div class="btn-group">'+ button + cancel +'</div>';
                    var divTag = '<div id="input-edit" class="input-edit">'+ input + buttonGroup +'</div>'
                    $('#name').append(divTag)
                    $('#btn-save').click(function (event) {
                        var displayname = $('#displayname').val();
                        ChatZopim.SetVisitorInfo(displayname);
                    })
                    $('#btn-cancel').click(function(){
                        $('#display-name').show();
                        $('#input-edit').remove();
                    });
                });
            },
            EvenRating: function(message)
            {

                $('#btn-rating').removeClass('disable');
                $('#btn-rating').click(function(){
                    var messquestion = '<p>'+ message +'</p>';
                    var inputGood = '<button class="btn btn-rate" id="btn-good"><i class="far fa-thumbs-up"></i></button>';
                    var inputBad = ' <button class="btn btn-rate" id="btn-bad"><i class="far fa-thumbs-down"></i></button>';
                    var divGroupRate = '<div class="rating">'+ inputGood + inputBad +'</div>'
                    divTag = '<div id="rate" class="mss-group"><div class="option">' + messquestion + divGroupRate +'</div></div>'
                    $('#message').append(divTag)
                    InnerHTML.ScrollBottom('message');
                    $('#btn-bad').click(function(){
                        zChat.sendChatRating('bad', function(err) {
                            var rating = 'bad';
                            status =  'You has rate <b style="color:red">' + rating + '<b>' ;
                            var divStatus = InnerHTML.MessStatusLeave(status);
                            $('#message').append(divStatus)
                        });
                        $('#rate').remove();
                    });
                    $('#btn-good').click(function(){
                        zChat.sendChatRating('good', function(err) {
                            var rating = 'good';
                            status =  'You has rate <b style="color:red">' + rating + '<b>' ;
                            var divStatus = InnerHTML.MessStatusLeave(status);
                            $('#message').append(divStatus)
                        });
                        $('#rate').remove();
                    });
                });
            },
            EventRequestRationg : function(message)
            {
                $('#btn-rating').removeClass('disable');
                var messquestion = '<p>'+ message +'</p>';
                var inputGood = '<button class="btn btn-rate" id="btn-good"><i class="far fa-thumbs-up"></i></button>';
                var inputBad = ' <button class="btn btn-rate" id="btn-bad"><i class="far fa-thumbs-down"></i></button>';
                var divGroupRate = '<div class="rating">'+ inputGood + inputBad +'</div>'
                divTag = '<div id="rate" class="mss-group"><div class="option">' + messquestion + divGroupRate +'</div></div>'
                $('#message').append(divTag)
                InnerHTML.ScrollBottom('message');
                $('#btn-bad').click(function(){
                    zChat.sendChatRating('bad', function(err) {
                        var rating = 'bad';
                        status =  'You has rate <b style="color:red">' + rating + '<b>' ;
                        var divStatus = InnerHTML.MessStatusLeave(status);
                        $('#message').append(divStatus)
                    });
                    $('#rate').remove();
                });
                $('#btn-good').click(function(){
                    zChat.sendChatRating('good', function(err) {
                        var rating = 'good';
                        status =  'You has rate <b style="color:red">' + rating + '<b>' ;
                        var divStatus = InnerHTML.MessStatusLeave(status);
                        $('#message').append(divStatus)
                    });
                    $('#rate').remove();
                });
            }

        }
    ChatZopim =
        {
            SendMessage : function(message)
            {
                SocketWeb.addMessage(message);
            },
            SetVisitorInfo: function(name = 'visitor customer',email = 'customer@gmail.com',phone='')
            {
                var visitorInfo =
                    {
                        display_name : name,
                        email        : email,
                        phone        : phone,
                    }
                zChat.setVisitorInfo(visitorInfo, function(err) {
                    $('#input-edit').remove();
                    InnerHTML.MessDisplayName('name',name);
                    var status =  'You are update dispaly name is ' + name;
                    var divStatus = InnerHTML.MessStatusLeave(status);
                    $('#message').append(divStatus)
                });
            },
            CloseMessage : function(message)
            {
                zChat.endChat();
            }
        }

}(window.jQuery))
