$(function(){
        var files;
        change_placeholder('#video_embed','Вставьте ссылку на видео');
        change_placeholder('#video_embed_category','Категория видео');
        change_placeholder('#video_embed_title','Название');
        change_placeholder('#video_embed_date','Дата публикации');
        change_placeholder('#video_embed_image','Превью-картинка');
        change_placeholder('#video_embed_node','Связь');
        change_placeholder('#video_embed_text','Опишите видео');
        var date = new Date();
        $('#video_embed_date').datetimepicker({
            format: 'Y-m-d H:i:s',
            minDate:'-1970/01/1',
            maxDate:'+1970/01/31',
            lang: 'ru',
            closeOnWithoutClick :true
        });
        $('#video_embed').keydown(function(){
                if($('#video_embed').val()) {
                    $('#form_video').slideDown(250);
                    $('#video_embed_button').text('Просмотр');
                    var vdata = video_link($('#video_embed').val());
                    $('.video_embed_video').html(vdata[0]);
                    $('#video_embed_title').val(vdata[1]);
                }
        });
        $('#video_embed_button').click(function(){
            if($('#video_embed').val()) {
                $('#form_video').slideDown(250);
                $('#video_embed_button').text('Просмотр');
                var vdata = video_link($('#video_embed').val());
                $('.video_embed_video').html(vdata[0]);
                $('#video_embed_title').val(vdata[1]);
                $('#video_embed_button_pst').click(function() {
                    var link = $('#video_embed').val();
                    if(link !== '') {
                        var form = new FormData();             
                        form.append('link',link);
                        
                        var title = $('#video_embed_title').val();
                        if(title) {
                            form.append('title',title);
                        }
                        
                        var cat = $('#video_embed_category').text();
                        if(cat) {
                            switch(cat) {
                                case 'letsplay':
                                    form.append('category',cat);
                                    break;
                                default:
                                    error('Извините, такой категории не существует.');
                                    return false;
                            }
                        }
                        
                        var node_cat = $('#video_embed_node_cat').text();
                        if(node_cat) {
                            switch(node_cat){
                                case 'game':
                                    form.append('node_cat',node_cat);
                                    break;
                                default:
                                    error('Извините, такой связи не может быть');
                                    return false;
                            }
                        }
                        
                        var node = $('#video_embed_node').text();
                        if(node) {
                            form.append('node',node);
                        }
                        
                        var time = $('#video_embed_date').val();
                        if(time) {
                            form.append('date',time);
                        }
                        
                        var text = $('#video_embed_text').val();
                        if(text) {
                            form.append('title',text);
                        }
                        
                        var img = files;
                        if(img) {
                            form.append('image',img[0]);
                        }
                        
                        var stat = $('#video_embed_status_active').attr('id');
                        if(stat) {
                            switch(stat){
                                case 'for_all':
                                case 'for_sub':
                                case 'for_friends':
                                case 'for_me':
                                    form.append('status',stat);
                                    break;
                                default:
                                    error('Извините, ошибка данных.');
                                    return false;
                            }
                        }

                        var http = new XMLHttpRequest();
                        http.open('POST','blocks/mv/upload/video_new_post.php');
                        http.onreadystatechange = function() {
                            if (http.readyState === 4) {
                                if(http.status === 200) {
                                    success(this.responseText);
                                }
                            }
                        };
                        http.send(form);
                    }
                });
            }
        });
        $('#video_embed_close').click(function(){
            $('#form_video').slideUp(250,function(){
                $('.video_embed_video').html('');
                $('#video_embed_title').val('');
                $('#video_embed_date').val('');
                $('#video_embed_text').val('');
                $('#video_embed_category').val('');
                $('#video_embed_node').text('');
                $('#video_embed').val('').focus();
            });
            $('#video_embed_button').text('Посмотреть').removeClass('video_embed_button_pst');
            $('#video_embed_button_pst').unbind('click');
            
            
        });
        $('.video_embed_status').click(function(){
            $('.video_embed_status_pt').removeClass('video_embed_status_active');
            $(this).children('.video_embed_status_pt').addClass('video_embed_status_active');
        });
        //var cat_in;
        $('#video_embed_category').focus(function(){
            $('#video_embed_category_auto').fadeIn(100);
            /*if($('#video_embed_category').val().length >= 3){
                clearTimeout(cat_in);
                cat_in = setTimeout(function(){
                    $('#video_embed_category_auto').fadeIn(100);
                },1000); 
            }*/
        });
        $('.video_embed_category_auto').click(function(){
            $('#video_embed_category').val($(this).find('p').text());
            $('#video_embed_category_auto').fadeOut(100);
        });
        
        //Вставка картинки как превью 
    $('#video_embed_image').change(function(){
        files = $(this)[0].files;
        if(files.length > 1) {
            alert('Нельзя залить больше одного файла.');
        }
        else {  
            read_file(files,'.pre_video_embed_image',function(){
                //Hello World
            });
        }
        return false;
    });

});