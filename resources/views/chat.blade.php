@extends('layouts.app')

@section('content')



    <div class="row">



        <div class="col-md-4" style="padding: 100px">
            @foreach($rooms as $room)
                <p><a href="{{url('/room',$room->id)}}">{{$room->name}}</a></p>
            @endforeach
        </div>

        <div class="col-md-3">
            <ul class="chat">
                @foreach($message as $item)
                    <li class='left clearfix'>
                        <span class='chat-img pull-left'>
                            <img src='http://placehold.it/50/55C1E7/fff&text=U' alt='User Avatar' class='img-circle' />
                        </span>
                        <div class='chat-body clearfix'>
                            <div class='header'>
                                <strong class='primary-font'>{{$item->user->name}}</strong>
                            </div>
                            <p>{{$item->message}}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
            <form  class="chat-form" method="post" >
                {{ csrf_field() }}
                <div class="col-md-9">
                    <input name="message" id="input_message" class="form-control" >
                </div>
                <div class="col-md-3">
                    <input id="button_chat" class="btn" type="submit" value="Send">
                </div>

            </form>
        </div>

        <div class="col-md-3"></div>

     </div>


@stop

@section('footer')
    <script>



        var socket = io(':3000');

        function appendMessage(data) {
            $('.chat').append("<li class='left clearfix'>" +
                    "<span class='chat-img pull-left'> " +
                    "<img src='http://placehold.it/50/55C1E7/fff&text=U' alt='User Avatar' class='img-circle' /> " +
                    "</span>" +
                    "<div class='chat-body clearfix'>" +
                    "<div class='header'>" +
                    "<strong class='primary-font'></strong>"+ data.user.name +" </div><p>" + data.message.message + "</p></div></li>");
        }
        {{--function appendMessage2(data) {--}}
            {{--$('.chat').append("<li class='right clearfix'>" +--}}
                {{--"<span class='chat-img pull-right'> " +--}}
                {{--"<img src='http://placehold.it/50/FA6F57/fff&text=ME' alt='User Avatar' class='img-circle' /> " +--}}
                {{--"</span>" +--}}
                {{--"<div class='chat-body clearfix'>" +--}}
                {{--"<div class='header pull-right'>" +--}}
                {{--"<strong class='primary-font '>{{Auth::user()->name}}</strong> </div><p>" + data.message + "</p></div></li>");--}}


        {{--}--}}

//        $('#input_message').keypress(function (e) {
//            if (e.which == 13) {
//                $('form.chat-form').submit();
//            }
//        });

//        var checkStatus = function () {
//            document.body.innerHTML = (navigator.onLine) ? "online" : "offline"
//        };
//
//
//        window.addEventListener("online" , function () {
//            checkStatus()
//
//        });
//        window.addEventListener("offline" , function () {
//            checkStatus()
//
//        });




        $('form.chat-form').on('submit', function () {


            var text = $('input#input_message').val();
            {{--var data = {message : text , name : '{{Auth::user()->name}}'};--}}
            var link = "{{url('/chat/message')}}" ;

            $('input#input_message').val('');


            $.ajax({
                method: "POST",
                url: link,
                data: {
                    _token: '{{ csrf_token() }}',
                    message: text,
                    room_id: '{{$id}}' ,
                }
            });


            return false;
        });

        socket.on('chat_'+ '{{$id}}' +':message', function (data) {
//            console.log(data);
            appendMessage(data);
        });









    </script>
@stop
