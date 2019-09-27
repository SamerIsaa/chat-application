<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title></title>
    <meta property="og:type" content=""/>
    <meta property="og:title" content=""/>
    <meta property="og:description" content=" "/>
    <meta property="og:image" content=""/>
    <meta property="og:image:width" content=""/>
    <meta property="og:image:height" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=" "/>
    <meta property="og:ttl" content=""/>
    <meta name="twitter:card" content=""/>
    <meta name="twitter:domain" content=""/>
    <meta name="twitter:site" content=""/>
    <meta name="twitter:creator" content=""/>
    <meta name="twitter:image:src" content=""/>
    <meta name="twitter:description" content=""/>
    <meta name="twitter:title" content=" "/>
    <meta name="twitter:url" content=""/>
    <meta name="description" content="  "/>
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>
    <meta name="copyright" content=" "/>
    {{--    <link rel="shortcut icon" href="{{ asset('assets') }}/img/favicon.ico">--}}
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/mCustomScrollbar.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth_id" content="{{ auth()->id() }}">
</head>

<body>


<div class="main-wrapper">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="main_chat_messgae">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="chat_right_content">

                        <div class="content-tab scroll">
                            <ul id="activeUsers">
                                @if($onlineUsers)
                                    @foreach($onlineUsers as $user)
                                        <li>
                                            <a href="javascript:;" data-id="{{ $user->id }}"
                                               class="d-flex align-items-center justify-content-between onlineUser">
                                                <div>
                                                    <div class="d-table-cell vertical-middle position-relative">
                                                        @if($user->isOnline)
                                                            <div class="active_person" id="statusUser"></div>
                                                        @else
                                                            <div class="inactive_person" id="statusUser"></div>
                                                        @endif
                                                    </div>
                                                    <div class="d-table-cell pl-3 vertical-middle">
                                                        <p class="chat_name">{{ $user->name }}</p>
                                                    </div>

                                                    <div class="d-table-cell pl-3 vertical-middle">
                                                        <p class="unreaded">{{ $user->unreadedMessages->count() }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif


                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-lg-8">
                    <div class="chat_message_content">
                        <div class="header_chat_message_content d-flex align-items-center justify-content-between">
                            <div>
                                <div class="d-table-cell vertical-middle position-relative">
                                    <div class="active_person" id="statusUser"></div>
                                </div>
                                <div class="d-table-cell vertical-middle pr-3 " style="padding-right: 10px;">
                                    <p class="chat_name">رعد الحلبي</p>
                                </div>
                            </div>

                        </div>
                        <div class="body_chat_message_content scroll">
                            <ul class="list_chat_message_content">


                            </ul>
                        </div>
                        <div class="footer_chat_message_content">
                            <form action="" id="sendMessage">
                                <div class="form-group">
                                    <input type="text" placeholder="اضف نص الرسالة" id="message">
                                    <button type="submit"><img src="{{ asset('assets') }}/img/send-button.png" alt="">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<script src="{{ asset('assets') }}/js/jquery.js"></script>
<script src="{{ asset('assets') }}/js/popper.js"></script>
<script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/js/mCustomScrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/function.js"></script>

<script src="https://js.pusher.com/5.0/pusher.min.js"></script>

<script>


    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('bc78a4d8177cc40becd2', {
        cluster: 'mt1',
        authEndpoint: 'broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}"
            }
        }
    });

    var privateChannel = pusher.subscribe('private-message.' + "{{ auth()->id() }}");
    privateChannel.bind('message', function (data) {
        console.log(JSON.stringify(data));
        // console.log(data.message.reciver_id);
        if (data.message.reciver_id == "{{ auth()->id() }}") {
            let sender_id = $('a.active').data('id');
            if (sender_id === data.message.sender_id) {

                let li = document.createElement('li');

                let div = document.createElement('div');
                div.classList.add('send', 'd-flex', 'align-items-center');


                let pInfo = document.createElement("p");
                pInfo.classList.add('info');
                pInfo.textContent = data.message.content;

                let pDate = document.createElement("p");
                pDate.classList.add('date', 'text-right', 'pr-3');
                pDate.textContent = data.message.created_at;

                div.append(pInfo);
                div.append(pDate);

                li.append(div);
                $('ul.list_chat_message_content').append(li);


            } else {
                let a = $("ul#activeUsers").find(`a[data-id='${data.message.sender_id}']`);
                let unreadedNum = parseInt(a.find('p.unreaded').text());
                console.log(++unreadedNum);
                a.find('p.unreaded').text( unreadedNum++);

                // $('.active').find('p.unreaded').text(0);
                // alert('another chat');
            }
        }

    });

    var channel = pusher.subscribe('userLogin');
    channel.bind('userLogin', function (data) {


        if (data.user.id != "{{ auth()->id() }}") {
            let activeStatus = data.user.isOnline ? "active_person" : "inactive_person";
            let id = data.user.id;
            // let liUser = $('.onlineUser')
            let activeUser = $(`a[data-id = ${id}]`);
            if (activeUser.length > 0) {

                let status = activeUser.find('div#statusUser');
                status.attr('class', '');
                status.attr('class', activeStatus);

            }
            //
            // if (data.user.isOnline) {
            //
            //
            //     let newUser = document.createElement('li');
            //     let ancore = document.createElement('a');
            //     ancore.classList.add("d-flex", "align-items-center", "justify-content-between", "onlineUser");
            //     ancore.href = 'javascript:;';
            //     ancore.setAttribute('data-id', data.user.id);
            //
            //
            //     let containerDiv = document.createElement('div');
            //
            //     let activeSign = document.createElement('div');
            //     activeSign.classList.add("d-table-cell", "vertical-middle", "position-relative");
            //     let activePerson = document.createElement('div');
            //     activePerson.classList.add('active_person');
            //     activeSign.appendChild(activePerson);
            //
            //     let nameDiv = document.createElement('div');
            //     nameDiv.classList.add("d-table-cell", "pl-3", "vertical-middle");
            //     let chatName = document.createElement('p');
            //     chatName.classList.add('chat_name');
            //     chatName.innerText = data.user.name;
            //     nameDiv.appendChild(chatName);
            //
            //     containerDiv.append(activeSign);
            //     containerDiv.append(nameDiv);
            //     ancore.append(containerDiv);
            //
            //     newUser.append(ancore);
            //
            //
            //     document.querySelector('ul#activeUsers').append(newUser);
            //
            // } else {
            //     let id = data.user.id;
            //     let activeUser = $(`a[data-id = ${id}]`);
            //     activeUser.remove();
            //
            // }
        }

    });


</script>

</body>

</html>