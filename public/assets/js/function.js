(function ($) {
    'use-strict'

    $(".scroll").mCustomScrollbar({
        axis: "y",
        theme: "dark",
    });

    $("ul#activeUsers").on('click', '.onlineUser', function () {

        $(".onlineUser").removeClass('active');
        $(this).addClass('active');
        let id = $(this).data('id');
        let activeStatus = $(this).find('div.active_person').length ? "active_person" : "inactive_person";

        let name = $(this).find('p.chat_name').text();

        let div = $('.chat_message_content');
        div.find('p.chat_name').text(name);
        let statusChat = div.find('div#statusUser');
        statusChat.attr('class', 'status');
        statusChat.attr('class', activeStatus);


        $.ajax({
            url: 'messages',
            method: 'post',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                'reciver_id': id,
                'sender_id': $('meta[name="auth_id"]').attr('content'),
            },
            success: function (response) {
                if (response.status) {
                    $('ul.list_chat_message_content').empty();
                    $('ul.list_chat_message_content').append(response.data);
                    $(".body_chat_message_content").mCustomScrollbar("scrollTo", "bottom");
                    $('.active').find('p.unreaded').text(0);
                }

            }
        });

    });

    $('form#sendMessage').on('submit', function (e) {
        e.preventDefault();
        let content = $.trim($(this).find('#message').val());
        if (content.length != 0) {
            $(this).find('#message').val('');
            let id = $('a.active').data('id');
            $.ajax({
                url: 'send/message',
                method: 'post',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    'reciver_id': id,
                    'sender_id': $('meta[name="auth_id"]').attr('content'),
                    'content': content
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $('ul.list_chat_message_content').append(response.data);
                        $("ul.list_chat_message_content").mCustomScrollbar("scrollTo", "bottom");

                    } else if (response.status === 'error') {
                        alert(response.data)
                    }
                }
            });
        }


    })


}(jQuery));
