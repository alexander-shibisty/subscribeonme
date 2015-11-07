var WINDOW = {
    window_width : $(window).width(),
    window_height : $(window).height(),
    all_resize : function() {
        var x = (this.window_width > 800) ? 200 : 0;
        $('#body').css({'width':this.window_width-x, 'left':x});
    },
    profile_window : function() {
        var x = (WINDOW.window_width > 800) ? 0 : -200;
        $('#profile_window').css({'left': x},250);
    },
    speed_scroll: function() {
        var scroll_return;
        $('#scroll').click(function(){
            if($('#body').scrollTop() === 0 && scroll_return) {
                $('#body').stop(true).scrollTop(scroll_return);
                scroll_return = $('#body').scrollTop();
            }
            else {
                scroll_return = $('#body').scrollTop();
                $('#body').stop(true).scrollTop(0);
            }
        });
    }
};
$(function(){
    WINDOW.profile_window();
    WINDOW.all_resize();
    WINDOW.speed_scroll();
    var y = (WINDOW.window_width > 800) ? 0 : 1;
        $('.profile_co').click(function(){
            if (y === 0) {
                $('#profile_window').animate({'left': -200},250);
                var f = (WINDOW.window_width > 800) ? 1 : 0;
                if(f)$('#body').css({'width':WINDOW.window_width, 'left':0});
                y = 1;
            }
            else {
                $('#profile_window').animate({'left': 0},250);
                var f = (WINDOW.window_width > 800) ? 1: 0;
                if(f)$('#body').css({'width':WINDOW.window_width-200, 'left':200});
                y = 0;
            }
        });
    $(window).resize(function(){
        WINDOW.window_width = $(window).width();
        WINDOW.window_height = $(window).height();
        WINDOW.profile_window();
        WINDOW.all_resize(); 
        var w_width = $(window).width()/2-$('#modal_form').width()/2;
        var h_height = $(window).height()/2-$('#modal_form').height()/2;
        $('#modal_form').css({'top': h_height, 'left': w_width});
    });
    $('#body').scroll(function(){
       if($('#body').scrollTop() >= 200 && $('#scroll_search').css('display') === 'none') {
           $('#scroll_search').css({'width':$('#content').width()}).fadeIn(150);
           var scr_w = ($('#body').width() - $('#content').width())/2;
           var scr_p = $('#content').width()/5;
           $('#content_search').css({'position':'fixed','top':'55px','right':scr_w+6,'width':scr_p});
       }
       else if($('#body').scrollTop() <= 200 && $('#scroll_search').css('display') === 'block') {
           $('#scroll_search').fadeOut(150);
           $('#content_search').css({'position':'static','top':'auto','right':'auto'});
       }
    });
});