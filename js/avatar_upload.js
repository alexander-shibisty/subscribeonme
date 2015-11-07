/*Создаем переменную под ассоциативный массив,
//для сохранения в нее координат вырезки и размер 
//будущего изображения*/
var coords_lol = {
    avatar_width: 0,
    avatar_height: 0
};
/*Создаем функцию, для передачи ее в объект Jcro
//Именно в ней и будет инициализация массива*/
function showCoords(c) {
    coords_lol = {
        img_x : c.x,
        img_y : c.y,
        img_w : c.w,
        img_h : c.h
     };
};
/*На случай, если подключено более одной библиотеки,
//чтобы они не конфликтовали*/
var $ = jQuery.noConflict();
//Создаем jquery функцию, где будет проходить весь цирк
$(function() {
    $.event.props.push('dataTransfer');
    
    $(document).on('drop', function(ev){
        ev.preventDefault();
        ev.stopPropagation();
    });
    
    $('#avatar_upload').click(function(){
        if($('#up').css('display') === 'none') {
            $('#up').fadeIn(250);
            $('#avatar_upload').css({'background':'#fff url("img/system_icon/upload_close.png") no-repeat center'});
        }
        else {
            $('#up').fadeOut(250);
            $('#avatar_upload').css({'background':'#fff url("img/system_icon/upload_open.png") no-repeat center'});
        }
    });
    
    $('#up').on('dragleave', function() {
        $('#up p:first').text('Ну куда же вы?');
    }).on('dragover', function() {
        $('#up p:first').text('Теперь отпустите!');
    }).on('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var files = e.dataTransfer.files;
        if(files.length > 1) {
            error('Нельзя залить больше одного файла.');
        }
        else {  
            $('#img_container').fadeIn(100);
            $('#up p:first').text('Вы можете изменить свое решение, просто перетащите другую картинку.');
            read_file(files,'#pre_hiden',function(){
                $('#cropbox').Jcrop({
                    aspectRatio:1,
                    minSize:[150,150],
                    setSelect:[0,0,150,150],
                    bgOpacity: 0.2,
                    bgColor: '#000',
                    onSelect:showCoords
                });
                $('#startupload').fadeIn(100);
                $('#startupload button').one('click',function(){
                    if(coords_lol) {
                        if($('#cropbox').width() >= 150) {
                            upload(files, 'blocks/prowin/avatar_upload.php');
                            $('#startupload button').attr('disabled','disabled');
                            $('#startupload button').text('ЗАГРУЗКА');
                        }
                        else {
                            error('Извините, но нельзя загрузить картинку размером меньше 150px.');

                        }
                    }
                    else {
                        error('Пожайлуста, выберите область.');
                    }
                });
            });
        }
        return false;
    });
    $('#uploadbtn').change(function(){
        var files = $(this)[0].files;
        if(files.length > 1) {
            alert('Нельзя залить больше одного файла.');
        }
        else {  
            $('#img_container').fadeIn(100);
            $('#up p:first').text('Вы можете изменить свое решение, просто перетащите другую картинку.');
            read_file(files,'#pre_hiden',function(){
                $('#cropbox').Jcrop({
                    aspectRatio:1,
                    minSize:[150,150],
                    setSelect:[0,0,150,150],
                    bgOpacity: 0.2,
                    bgColor: '#000',
                    onSelect:showCoords
                });
                $('#startupload').fadeIn(100);
                $('#startupload button').one('click',function(){
                    if(coords_lol) {
                        if($('#cropbox').width() >= 150) {
                            upload(files, 'blocks/prowin/avatar_upload.php');
                            $('#startupload button').attr('disabled','disabled');
                            $('#startupload button').text('ЗАГРУЗКА');
                        }
                        else {
                            error('Извините, но нельзя загрузить картинку размером меньше 150px.');

                        }
                    }
                    else {
                        error('Пожайлуста, выберите область.');
                    }
                });
            });
        }
        return false;
    });
});
//Вставка картинки как превью
function read_file(files,element,callback) {
    if (files[0].type.match(/image.*/) && files[0].name.match(/^[\w-\W]{0,100}\.jpg$/) && files[0].size <= 5000000) {         
        $(element).html('<img />');
        var pre = $(element+' img');
        //pre.get(0).file = files;
        var pre_reader = new FileReader();// Создаем объект FileReader и по завершении чтения файла, отображаем миниатюру и обновляем инфу обо всех файлах
        pre_reader.onload = (function(hImg) {
            return function(e) {
                hImg.attr('src', e.target.result);
                hImg.attr('id', 'cropbox');
                hImg.css({'max-width':'640px', 'max-height':'480px'});  
                callback();
            };
        })(pre);
        pre_reader.readAsDataURL(files[0]);
      }
    else {
        error('Только картинки расширения ".JPG", весом не больше 5 мегабайт.');
    }
}
function upload(file, url) {
   /*Сначала мы отправим пустой запрос на сервер. 
    Это связано с тем, что иногда Safari некорректно обрабатывает
    первый файл.*/
    //$.get(url);
    var http = new XMLHttpRequest();// Создаем объект XHR, через который далее скинем файлы на сервер.
    if (http.upload && http.upload.addEventListener) {// Процесс загрузки
        http.upload.addEventListener(// Создаем обработчик события в процессе загрузки.
        'progress',
        function(e) {
            if (e.lengthComputable) {
                var progress = Math.ceil((e.loaded * 100) / e.total);
                $('#loadbar_progress_plane').animate({'width':progress+'%'},100);
            }
        },false);
        http.onreadystatechange = function () {
            // Действия после загрузки файлов
            if (this.readyState === 4) { // Считываем только 4 результат
                if(this.status === 200) {// Если все прошло гладко
                    if(this.responseText === 'success') {
                        success('Аватар успешно загружен.');
                    }
                    else {
                        error(this.responseText);
                    }
                    $('#up').fadeOut(100);
                } 
                else {
                    error('Ошибка');
                }
            }
        };
        http.upload.addEventListener(//еще одно событие удачной загрузки
        'load',
        function(e) {
            //alert('есть' + e);
        });
        http.upload.addEventListener(//еще одно событие не удачной загрузки
        'error',
        function(e) {
            //error('Ошибка 2' + e);
        });
    }
    //Также нужно отправить текущий размер блока,
    //ведь его размер и исходной размер изображения могут отличаться,
    //это нужно будет учитывать при обработке
    var avatar_width  = $('#pre_hiden img').width();
    var avatar_height = $('#pre_hiden img').height();
    var form = new FormData();
    form.append('settings[width]', avatar_width);//POST, передаем дополнительные данные
    form.append('settings[height]', avatar_height);
    form.append('settings[left]', coords_lol.img_y);
    form.append('settings[top]', coords_lol.img_x);
    form.append('settings[zoomx]', coords_lol.img_w);
    form.append('settings[zoomy]', coords_lol.img_h);
    form.append('avatar', file[0]);//Крепим сам файл
    http.open('POST', url);
    http.send(form);// И отправляем форму, в которой наш файл. Через XHR.
}