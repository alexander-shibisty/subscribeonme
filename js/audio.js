var audio,duration,startDuration,volume,canvas,ctx,source,context,analyser,fbc_array,bars,bar_x,bar_width,bar_height;

function PlayPauseVideo() {
     if(audio.paused) {
         audio.play();
         startDuration = setInterval(initDuration,1000/66);
         $('#player_pause_buttom').removeAttr('class');
         $('#player_play_buttom').attr('class','player_button');
     }
     else {
         audio.pause();
         clearInterval(startDuration);
         $('#player_play_buttom').removeAttr('class');
         $('#player_pause_buttom').attr('class','player_button');
     }
}
function initDuration() {
     duration.value = audio.currentTime;
}
function clearAnimateRange() {
     clearInterval(startDuration);
     if(!audio.paused) {
         PlayPauseVideo();	
     }
}
function movedRange() {
    audio.currentTime = duration.value;
    PlayPauseVideo();
}
function initMp3Player(){
     var audio = document.getElementById('audio');
     context = new AudioContext();
     analyser = context.createAnalyser();
     canvas = document.getElementById('equalizer_analyzer');
     ctx = canvas.getContext('2d');
     ctx.fillStyle = '#7cd2e8';
     source = context.createMediaElementSource(audio);
     source.connect(analyser);
     analyser.connect(context.destination);
     frameLooper();
}
function audiovol() {
    var auvol = $('#vol').val()/100;
    audio.volume = auvol;
}
function volsafe() {
    document.cookie = "audio_vol="+(audio.volume)*100;
}
function frameLooper(){
     window.requestAnimationFrame(frameLooper);
     fbc_array = new Uint8Array(analyser.frequencyBinCount);
     analyser.getByteFrequencyData(fbc_array);
     ctx.clearRect(0, 0, canvas.width, canvas.height);
     bars = 60;
     for (var i = 0; i < bars; i++) {
         bar_x = i * 5;
         bar_width = 4;
         bar_height = -(fbc_array[i]/2);
         ctx.fillRect(bar_x, canvas.height, bar_width, bar_height);
     }
}

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

$(function(){
    //Для теста
     $('#lol').click(function(){
         $('#audio_player').fadeIn(250);
     });
     //Первым делом
     $('#player_close').click(function(){
        $('#audio_player').fadeOut(250);
     });
     $('#player_modal').click(function(){
        $('#audio_player').draggable();
     });
  var start_vol = (getCookie('audio_vol'))? getCookie('audio_vol') : 50;
  $('#vol').val(start_vol);
     //Вторым делом
    audio = document.getElementById('audio');
    duration = document.getElementById('ratio');
    audio.volume = start_vol/100;
    duration.value = 0;
    initMp3Player();
        var au_in = setInterval(function () {
            var l = ($('#player_waveform').width()/audio.duration)*duration.value;
            duration.min = 0;
            duration.max = audio.duration;
            $('#player_vol_prg').css({'width':$('#vol').val()+'%'});
            $('#player_waveform_progress').css({'width': Math.floor(l)});
            var pl_min = (Math.floor((audio.duration-audio.currentTime)/60) < 10) ? '0'+Math.floor((audio.duration-audio.currentTime)/60) : Math.floor((audio.duration-audio.currentTime)/60);
            var pl_sic = (Math.floor((audio.duration-audio.currentTime)%60) < 10) ? '0'+Math.floor((audio.duration-audio.currentTime)%60) : Math.floor((audio.duration-audio.currentTime)%60);
            $('#player_time').html(pl_min + ':' + pl_sic);
            if (audio.ended) {
                duration.value = 0;
                clearInterval(startDuration);
                if(!$('audio').attr('loop') && $('.player_list:last').attr('id') !== $('audio').attr('class')) {
                    var el_id = $('audio').attr('class');
                    var audio_source = $('#'+el_id).next().children('source').attr('src');
                    var audio_id = $('#'+el_id).next().attr('id');
                    $('audio').attr('src',audio_source);
                    $('audio').attr('class',audio_id);
                    PlayPauseVideo();
                }
                else if($('.player_list:last').attr('id') === $('audio').attr('class')) {
                    var audio_source = $('.player_list:first').children('source').attr('src');
                    var audio_id = $('.player_list:first').attr('id');
                    $('audio').attr('src',audio_source);
                    $('audio').attr('class',audio_id);
                    PlayPauseVideo();
                }
            }
        }, 1000/66);
     //Плей лист
     $('.player_list').click(function(){
        clearInterval(startDuration);
        var audio_source = $(this).children('source').attr('src');
        var audio_id = this.id;
         if($('audio').attr('class') !== audio_id) {
             $('audio').attr('src',audio_source);
             $('audio').attr('class',audio_id);
         }
         PlayPauseVideo();
     });
});