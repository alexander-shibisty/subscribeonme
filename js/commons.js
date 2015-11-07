function change_placeholder (input, text) {
    $(input).attr('placeholder', text).focus(function() {
        $(this).attr('placeholder', '');
    });
    $(input).attr('placeholder', text).blur(function() {
        $(this).attr('placeholder', text);		
    });
}

function error(text) {
        $('#error').animate({'bottom': '10px'},100);
        $('#error_text p').html(text);
        var error_clear = setTimeout(function () {
            $('#error').animate({'bottom': '-120px'},100,function(){
                $('#error_text p').html(' ');
            });
        },5000);
        $('#error').hover(function(){
            clearTimeout(error_clear);
            $('#error_close').click(function(){
                $('#error').animate({'bottom': '-120px'},100,function(){
                    $('#error_text p').html(' ');
                });
            });
        });

}

function success(text) {
    $('#success').animate({'bottom': '10px'},100);
    $('#success_text p').html(text);
    var error_clear = setTimeout(function () {
        $('#success').animate({'bottom': '-120px'},100,function(){
            $('#success_text p').html(' ');
        });
    },5000);
    $('#success').hover(function(){
        clearTimeout(error_clear);
        $('#success_close').click(function(){
            $('#success').animate({'bottom': '-120px'},100,function(){
                $('#success_text p').html(' ');
            });
        });
    });

}
//Функция для разбора json
function json_array(text,array,head,footer) {
    var con = (head) ? head : '';
    if(text && /%n/.test(text)) {
        var t_num = text.match(/%n/g).length;
        for(var n = 0; n <= array.length-1 ; n++) {
            var ftext = text;
            for(var i=0;i <= t_num; i++) {
                var reg = new RegExp('%n\\['+i+'\\]','g');
                ftext = ftext.replace(reg,eval('array['+n+'].'+'n'+i));
            }
            con += ftext;
        }
    }
    return (footer)? con+footer : con;
}
//Функция для modal_form
var mmod = null;
var unick;
function modal_form(id,title,html,callback) {
            if(!mmod) {
                var w_width = WINDOW.window_width/2-$('#modal_form').width()/2;
                var h_height =  WINDOW.window_height/2-$('#modal_form').height()/2;
                $('#modal_form').fadeIn(250).css({'top': h_height, 'left': w_width});
                $('#mf_bar p').html(title);
                $('#mf_con').html(html);
                mmod = 1;
                callback();
            }
            else if(unick !== id) {
                $('#mf_bar p').html(title);
                $('#mf_con').html(html);
                unick = id;
                callback();
            }
            else {
                $('#modal_form').fadeOut(250);
                mmod = null;
            }
}
$('#form_close').click(function(){
        $('#modal_form').fadeOut(250);
        mmod = null;
});
$('#modal_form').draggable();

//Прогресс бар
function randomNumber (m,n) {
    m = parseInt(m);
    n = parseInt(n);
    return Math.floor( Math.random() * (n - m + 1) ) + m;
}
//Parser
function video_link(link) {
    var link_reg = /(?:https?\:\/\/)?(?:www\.)?((?:[-а-яa-zёЁцушщхъфырэчстью0-9_\.]{2,}))/;
    var link_dom = link.match(link_reg);
    var video_result = [];
    switch(link_dom[1]) {
        case 'youtube.com':
            var yt_reg = /v=([^\&]+)/;
            var yt_result = link.match(yt_reg);
            video_result[0] = '<iframe width="560" height="315" src="//www.youtube.com/embed/'+yt_result[1]+'" frameborder="0" allowfullscreen></iframe>';
            var youtubeApi = getJsonApi('http://gdata.youtube.com/feeds/api/videos/'+yt_result[1]+'?v=2&alt=json');
            video_result[1] = youtubeApi.entry.title.$t;
            video_result[2] = youtubeApi;
            video_result[3] = youtubeApi;
            break;
        case 'youtu.be':
            var yt_reg = /youtu\.be\/([^\&]+)$/;
            var yt_result = link.match(yt_reg);
            video_result[0] = '<iframe width="560" height="315" src="//www.youtube.com/embed/'+yt_result[1]+'" frameborder="0" allowfullscreen></iframe>';
            var youtubeApi = getJsonApi('http://gdata.youtube.com/feeds/api/videos/'+yt_result[1]+'?v=2&alt=json');
            video_result[1] = youtubeApi.entry.title.$t;
            video_result[2] = youtubeApi;
            video_result[3] = youtubeApi;
            break;
        case 'vimeo.com':
            var yt_reg = /\/(\d+){0,}$/;
            var yt_result = link.match(yt_reg);
            video_result[0] = '<iframe src="//player.vimeo.com/video/'+yt_result[1]+'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0" width="560" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
            break;
    }
    return video_result;
}

function getJsonApi(url) {
    var getJsinApi;
    $.ajaxSetup({
        async: false
    });
    $.getJSON(url,function(data){
        getJsinApi = data;
    });
    $.ajaxSetup({
        async: true
    });
    return getJsinApi;
}

function image_link() {
    
}

function link_link() {
    
}

function text_parser(text) {
    
}
