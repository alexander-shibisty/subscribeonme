var m_meter;
var no_active_delay = 120;
var walk = 0;// Количество секунд простоя мыши, при котором пользователь считается неактивным
var now_no_active = 0;
//обнулить счетчик
function activeUser() {
    now_no_active = 0;
}
//Увеличиваем и сравниваем
function updateChat() {
    now_no_active++;
    walk++;
    if (now_no_active >= no_active_delay) {
        clearInterval(m_meter);
        m_meter = null;
    }
    if(walk === 7200) {
        success('Прошло несколько часов. Возможно, пора прогуляться?');
    }
}

function message_meter() {
    var li = LINKS.location();
    var dialog = (li[2] === 'dg') ? li[3]:false;
   // if(dialog) {
        $.get('blocks/prowin/message_meter.php',{
            dialog:dialog
        },function(m_data){
            if(m_data){
                if($('#profile_menu_metr').text() !== m_data) {
                    $('#profile_menu_metr').fadeIn(200).html(m_data);  
                } 
            }
            else {
                $('#profile_menu_metr').html('0').fadeOut(200);
            }
        });
    //}
}

$(function(){
    setInterval(updateChat, 1000);

    $(document).mousemove(function(){
        activeUser();
        if(!m_meter) {
            m_meter = setInterval(message_meter,5000);
        }
    });
    
    $('.user_action').click(function(){
        if(this.id === 'online') {
            var status = 'online';
            $('.user_action_tr').removeClass('user_action_tr');
            $(this).addClass('user_action_tr');
        }
        else{
            var status = 'offline';
            $('.user_action_tr').removeClass('user_action_tr');
            $(this).addClass('user_action_tr');
        }
            $.post('blocks/prowin/status.php',{
                user_status:status
            },function(sdata){
                if(sdata === 'success') {
                    success('Вы изменили статус присутствия.');
                }
                else{
                    error('Статус присутствия изменить не удалось.');
                }
            });
    });
    $('#exit').click(function(){
        $.post('blocks/prowin/exit.php',{},function(exit){
            if(exit){
                location.reload();
            }
        });
    });
    m_meter;
});