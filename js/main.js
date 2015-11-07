$(function(){
    $(document).on('click','.new_local',function(e){
        e.preventDefault();
        var n_local= $(this).attr('href');
        LINKS.history(n_local);
        $('title').text($(this).text());
    });
    $(document).on('click','.new_modal',function(e){
        e.preventDefault();
        var modal_id = $(this).attr('href');
        var modal_type = modal_id.match(/(video|image|article|liter|audio)=(\w+)$/);
        LINKS.var_add(modal_type[1],modal_type[2]);
    });
    /*---MODAL---*/
    $('#modal_close').click(function(){
        $('#modal_window').fadeOut(200);
        $('#modal_content').html('');
        LINKS.var_delete('video','\\w+');
    });
    $('#modal_undock').click(function(){
        if($('.modal_wdng').length <= 10) {
          var md_con = $('#modal_content').html();
            $('#modal_window').fadeOut(200);
            $('#all').prepend('<section class="modal_wdng">\n\
                                <div class="wdng_cap">\n\
                                    </div><div class="wdng_bar">\n\
                                    <button class="wdng_close"></button>\n\
                                    <button class="wdng_rollup"></button>\n\
                                </div>'+md_con+'<section>');
            $('.modal_wdng').mousedown(function(){
                $('.wdng_cap').fadeIn(100);
                $('.wdng_active').removeClass('wdng_active');
                $(this).addClass('wdng_active');
            });
            $('.modal_wdng').mouseup(function(){
                $('.wdng_cap').fadeOut(100);
            });
            $('.modal_content').html('');
            $('.modal_wdng').draggable();
            LINKS.var_delete('video','\\w+');
            $('.wdng_close').click(function(){
                $(this).parent('.wdng_bar').parent('.modal_wdng').remove();
            });  
        }
        else {
            error('К сожалению нельзя создать больше 10 окон.');
        }
    });
    $('#modal_rollup').click(function(){
        var md_con = $('#modal_content').html();
        var md_id = 'vo&video=62';
        var md_title = 'Видео: S.T.A.L.K.E.R. Shadow of Chernobyl';
        $('#modal_window').fadeOut(200);
        $('#wdng_rollup').prepend('<a href="'+md_id+'" class="new_modal">\n\
                                    <div class="wdng_rollup_pn">\n\
                                        <p>'+md_title+'</p>\n\
                                    </div></a>');
        $('#modal_content').html('');
        LINKS.var_delete('video','\\w+');
    });
    /*---MODAL---*/
    $('#str').click(function(){
        $('.load_animation').stop(true).fadeIn(100);
        var li = LINKS.location();
        var last_id = $('article:last').attr('id'); 
        $.get('blocks/str.php',{
            local: li[2],
            category: li[3],
            last_id: last_id
        },function(str_data){
            if(str_data) {
                var arp = json_array(template,str_data);
                if($('#content_block').length) {
                    $('#content_block').append(arp);
                }
                else {
                    $('.content_block').append(arp);
                }
                LINKS.var_add('page',last_id);
            }
            $('.load_animation').fadeOut(500);
        },'json');
    });
    
    //Интерактивность в меню
    $(document).on('click','#content_menu a',function(){
        var elemLink = LINKS.location();
        var attr_loc = (elemLink[3] && elemLink[2] !== 'pl') ? elemLink[2]+'='+elemLink[3] : elemLink[2];
        var cat = LINKS.var_get('cat');
        var attr_cat = (cat) ? attr_loc+'?'+cat[0] : attr_loc ;
        if($('#menu').children('a[href="'+elemLink[2]+'"]').length || $('#profile_menu').children('a[href="'+elemLink[2]+'"]').length) {
            $('#menu').children('a[href="'+elemLink[2]+'"]').attr('href',attr_cat);
            $('#profile_menu').children('a[href="'+elemLink[2]+'"]').attr('href',attr_cat);
        }
        else {
            $('#menu').children('a[href^="'+elemLink[2]+'"]').attr('href',attr_cat);
            $('#profile_menu').children('a[href^="'+elemLink[2]+'"]').attr('href',attr_cat);
        }
    });
    
    $('.profile_menu_button,#menu a span').click(function(){
        $('.profile_menu_button,#menu a span').removeClass('profile_menu_button_tr');
        $(this).addClass('profile_menu_button_tr');
    });
    
    //Меню и поиск
    
    change_placeholder('#search input','Поиск по странице...');
    var search_ret;
    var keytimer;
    var listtimer;
    $('#search input').keyup(function(e){
        clearTimeout(keytimer);
        keytimer = setTimeout(function(){
            $('#content').stop(true).animate({'opacity':'1'},200);
        },1000);
        if(e.keyCode === 13){
            LINKS.var_add('q',$('#search input').val());
            $('#search_list').stop(true).fadeOut(100);
        }
        else {
            if ($('#search input').val() !== 0) {
                clearTimeout(listtimer);
                listtimer = setTimeout(function(){
                    $('#search_list').stop(true).fadeIn(100);
                },1000);
            }
            $('.search_list_title').click(function(){
                var search_text = $(this).children('p').text();
                $('#search input').val(search_text).focus();
                $('#search_list').stop(true).fadeOut(100);
            });
        }
    });
    $('#search input').keydown(function(){
        $('#content').stop(true).animate({'opacity':'.5'},200);
    });
    $('#search input').blur(function(){
        $('#search_list').stop(true).fadeOut(100);
    });
    $('#search_list').mouseleave(function(){
        $('#search_list').stop(true).fadeOut(100);
    });
    
});