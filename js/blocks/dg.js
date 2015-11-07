$(function(){
    //функция отправки сообщения
    var url_get = LINKS.location();
    function message(){
        var text_val = $('#text').text();
        if(text_val !== '') {
            $.post('blocks/dg/message_new_post.php',{
                text:text_val,
                page:url_get[3]
            },function(message_data) {
                if(/\d/.test(message_data)){
                    $('#text').html('').focus();
                    var mdate = new Date;
                    var getMonth = (mdate.getMonth()+1 < 10) ? '0'+mdate.getMonth()+1 : mdate.getMonth()+1;
                    var getDay = (mdate.getDate() < 10) ? '0'+mdate.getDate() : mdate.getDate();
                    var getHours = (mdate.getHours() < 10) ? '0'+mdate.getHours() : mdate.getHours();
                    var getMinutes = (mdate.getMinutes() < 10) ? '0'+mdate.getMinutes() : mdate.getMinutes();
                    var getSeconds = (mdate.getSeconds() < 10) ? '0'+mdate.getSeconds() : mdate.getSeconds();
                    $('#messages').prepend('<article class="'+$('.messages').attr('class')+'" id="'+message_data+'">\n\
                        <div class="user" style="'+$('#user').attr('style')+'">\n\
                        <div class="user_date"><p>Alexandr</p></div></div><div class="text">\n\
                        <p>'+(mdate.getFullYear() + '-' + getMonth + '-' + getDay+' '+getHours+':'+getMinutes+':'+getSeconds)+'</p>\n\
                        <span>'+text_val+'</span>\n\
                        </div>\n\
                        </article>');
                }
                /*
                 <article class="messages %n[0]" id="%n[1]">
                                                                            <div class="user_name">
                                                                                <p style="float:left;">%n[3]</p>
                                                                                <p style="float:right; font-size:10px;">%n[4]</p>
                                                                            </div>
                                                                            <div class="user" style="background: #000 no-repeat center url(upload_image/avatars/pre_150px/%n[2].jpg);">
                                                                            </div>
                                                                            <div class="text">
                                                                                <span>%n[5]</span>
                                                                            </div>
                </article>
                 */
                else {
                    error(message_data);
                }
            });
        }
        else {
            $('#text').focus();
        }
    };
            //Основная логика
            $('#text').focus();
            $('#message_input_button').click(message);
            $('#text').keydown(function(e){
                if(e.keyCode === 13){
                    message();
                }
            });
            $('#text').keyup(function(){
                $('#text_meter').text($('#text').text().length);
            });
            var dg_up = setInterval(function() {
                url_get = LINKS.location();
                var last_id = $('.messages:first').attr('id');
                $.get('blocks/dg/message_update.php',{
                    page:url_get[3],
                    last_id:last_id
                },function(data_update){
                    if(url_get[2] !== 'dg') {
                        clearInterval(dg_up);
                    }
                    else if(data_update.length > 0) {
                        var message = '';
                        for(var im = 0; im<=data_update.length-1;im++){
                            if($('.messages[id="'+ data_update[im].message_id +'"]').length === 0) {
                                message += '<article class="messages '+data_update[im].dialog_id+'" id="'+ data_update[im].message_id +'">\n\
                                                        <div class="user" style="background: #000 no-repeat center url(upload_image/avatars/pre_150px/'+data_update[im].avatar+'.jpg);">\n\
                                                        <div class="user_date"><p>'+data_update[im].nickname+'</p></div></div><div class="text">\n\
                                                        <p>'+data_update[im].date+'</p>\n\
                                                        <span>'+data_update[im].text+'</span>\n\
                                                        </div></article>';
                            }
                        }
                        if(message) {
                            $('#messages').prepend(message);
                        }
                        $('#messages article:not(.'+ url_get[3] +')').remove();
                    }
                }, 'json');
            }, 5000); 
});