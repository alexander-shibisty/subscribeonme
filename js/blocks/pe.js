$(function(){
        $('.friend_button').click(function(){
            var pid = $(this).parents('.people_article').attr('id');
            var unick = $('#'+pid).children('.pp').children('a').children('.people_title').text();
            $.post('blocks/pe/friend.php',{
                pioneer: pid
            },function(fdata){
                if(fdata && fdata === 'success'){
                    success('Вы успешно отправили заявку в друзья пользователю '+ unick + '.');
                }
                else {
                    error(fdata);
                }
            });
        });
        $('.subscribe_button').click(function(){
            var pid = $(this).parents('.people_article').attr('id');
            var unick = $('#'+pid).children('.pp').children('a').children('.people_title').text();
            $.post('blocks/pe/subscribe.php',{
                pioneer: pid
            },function(sdata){
                if(sdata && sdata === 'success'){
                    success('Вы успешно подписались на пользователя '+ unick + '.');
                }
                else {
                    error(sdata);
                }
            });
        });
        $('.message_button').click(function(){
            var pid = $(this).parents('.people_article').attr('id');
            modal_form(pid,'СООБЩЕНИЕ ДЛЯ '+ $('#'+pid).children('.pp').children('a').children('.people_title').text(),'<textarea id="write_message"></textarea><button id="send_message">ОТПРАВИТЬ</button>',function(){
            $('#send_message').click(function(){
                    var text = $('#write_message').val();
                    if(!text) {
                        error('Вы ничего не написали.');
                    }
                    else {
                        $.post('blocks/mm/message_new_dialog.php',{
                            page: pid,
                            text: text
                        },function(wdata){
                            if(wdata && wdata === 'success'){
                                success('Сообщение успешно отправлено!');
                                $('#write_message').val('').focus();
                            }
                            else {
                                error(wdata);
                            }
                        });
                    }
                });
            });
        });
});
