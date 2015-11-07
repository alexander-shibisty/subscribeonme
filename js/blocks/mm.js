$(function(){
           $('.add_friend').click(function() {
            var this_id = this.id;
            var pioneer_id = $(this).parents('.people_article').attr('id');
            $.post('blocks/mm/add_friend.php',{
                add_id: this_id,
                pioneer_id: pioneer_id
            },function(addf){
                if(addf && addf === 'success') {
                    $('#'+pioneer_id).html('Добавлен!');
                    success('Заявка принята.');
                }
                else {
                    error(addf);
                }
            });
        });
        $('.re_friend').click(function() {
            var this_id = this.id;
            var pioneer_id = $(this).parents('.people_article').attr('id');
            $.post('blocks/mm/remove_friend.php',{
                rem_id: this_id,
                pioneer_id: pioneer_id
            },function(ref){
                if(ref && ref === 'success'){
                    $('#'+pioneer_id).remove();
                    success('Заявка отклонена.');
                }
                else {
                    error(ref);
                }
            });
        });
});