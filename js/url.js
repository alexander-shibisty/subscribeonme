var template;
//var cache;
var LINKS = {
    location: function() {
	var url_get = location.href.match(/http:\/\/localhost:8080\/puls\/\??((\w+){0,}=?(\w+){0,}.*)?$/);
        var url_str = (url_get[2]) ? url_get[2]:'hm';
        var url_lc = (url_get[3]) ? url_str + '=' + url_get[3] : url_str;
        var url_array = [url_get[0],url_get[1],url_str,url_get[3],url_lc];
	return url_array;
    },
    history: function(url) {
        var fullhref = this.location();
        if (fullhref[1] !== url && url !== '') {
            window.history.pushState(null, null, 'http://localhost:8080/puls/' + url);
            window.history.replaceState(null, null, 'http://localhost:8080/puls/' + url);
        }
        else if (fullhref[1] !== url && url === '') {
            window.history.pushState('', '', 'http://localhost:8080/puls/');
            window.history.replaceState('', '', 'http://localhost:8080/puls/');
        }
    },
    new_location: function(loc, cat, page, sec) {
        $('#menu_bar_progress').fadeIn(100).animate({'width':randomNumber(10,60)+'%'},500);
        $.ajax({
            type: "GET",
            url: 'blocks/blocks.php',
            data: ({ // '?get_first'+loc+'&get_first_var='+cat
                get_first:loc,
                get_first_var:cat,
                cat: sec,
                page:page
            }),
            dataType: 'json',
            success: function(data_get){				
                if(data_get) {
                    $('#menu_bar_progress').stop(true).animate({'width': '100%'},350,function(){
                        $('#menu_bar_progress').fadeOut(100).css({'width': '0%'});
                    });
                    var htp = json_array(data_get[0].tmp,data_get,data_get[0].head,data_get[0].footer);
                    template= data_get[0].tmp;
                    $('#body').scrollTop(0);
                    $('#content').html(htp);
                }
            },
            error: function() {
                $('.load_animation').fadeOut(500);
                error('Упс! Что-то пошло не так...');
                $('#content').html('<div id="material_null"><p>МАТЕРИАЛЫ НЕ ЗАГРУЗИЛИСЬ</p></div>').animate({'opacity':1},200);
            },
            async: false
        });
    },
    new_modal: function(url,id) {
        $('.load_animation').stop(true).fadeIn(100);
        $.post('modal/modal.php',{
            category:url,
            id:id
        },function(data_m){
            if(data_m) {
                $('.load_animation').fadeOut(500);
                $('#modal_window').fadeIn(100).css({'height':$(window).height()});
                //cache = $('#modal_content').html();
                $('#modal_content').html(data_m);
                $('#modal_content iframe').css({'width':1000, 'min-height':562});
            }
        });
    },
    var_delete: function(get,data) {
        if(!data) {
            data = '[-а-яa-zёЁцушщхъфырэчстью0-9_\\.%]+';
        }
        var var_link = this.location();
        var reg = new RegExp('&?('+get+')=('+data+'){0,}','i');
        var var_del = var_link[1].replace(reg,'');
        this.history(var_del);
    },
    var_add: function(get,data) {
        var reg = new RegExp(get,'i');
        var var_get = location.href.match(reg);
        if(var_get) {
            var hh = this.var_get(get);
            var var_link = this.location();
            if(!hh) {
                var reg = new RegExp('('+get+')=?','i');
                var var_del = var_link[1].replace(reg, get+'='+data);
            }
            else {
                var reg = new RegExp('('+get+')=('+hh[2]+'){0,}','i');
                var var_del = var_link[1].replace(reg, get+'='+data);
            }
            this.history(var_del);
        }
        else {
            var var_link = this.location();
            var var_add = var_link[1]+'&'+get+'='+data;
            this.history(var_add);
        }
    },
    var_get: function(get,data) {
        if(!data) {
            data = '[-а-яa-zёЁцушщхъфырэчстью0-9_\\.%]+';
        }
        var reg = new RegExp('('+get+')=('+data+')','i');
        var var_get = location.href.match(reg);
        return var_get;
    }
};

$(function(){
    var url_local = '';
    var url_lc;
    var link_time = setInterval(function(){
        var url_interval = LINKS.location();
        if(url_local !== url_interval[1]) {
            url_local = url_interval[1];
            //Модальное окно
            if(/article|audio|image|liter|video/.test(url_interval[1])) {
                m_id = LINKS.var_get('video','\\d+');
                LINKS.new_modal(m_id[1],m_id[2]);
                return false;
            }
            else if($('#modal_content').text !== '') {
                $('#modal_window').fadeOut(200);
                $('#modal_content').html('');
            }

            if(/cat/.test(url_interval[1])) {
                var cat_get = LINKS.var_get('cat');
                LINKS.new_location(url_interval[2],url_interval[3],null,cat_get[2]);
            }
            else if(url_interval[2] && url_interval[4] !== url_lc) {
                LINKS.new_location(url_interval[2],url_interval[3]);
                url_lc = url_interval[4];
            }
        }
    },100);
});
