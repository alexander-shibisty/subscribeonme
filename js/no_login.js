$(function(){
    change_placeholder ('#login_email_input', 'E-mail');
    change_placeholder ('#login_password_input', 'Password');
    change_placeholder ('#registration_email_input', 'E-mail');
    change_placeholder ('#registration_login_input', 'Nickname');
    change_placeholder ('#registration_password_input', 'Password');
    change_placeholder ('#registration_password_repeat_input', 'Password repeat');
    $('.registration').click(function(){
        if($('#registration').css('display') === 'none') {
            $('#login').fadeOut(200);
            $(this).children('.l_radial').css('background','#5fc8a7');
            $('.login').children('.l_radial').css('background','#b1b1b1');
            setTimeout(function(){
                $('#registration').fadeIn(200);
            },200);
        }
        else {
            $('#registration').fadeOut(200);
            $(this).children('.l_radial').css('background','#b1b1b1');
        }
    });
    $('#registration_button').click(function(e) {
        e.preventDefault();
        if($('#registration_email_input').val() === '') {
                    error('Введите свой Email');
	}
	else if(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test($('#registration_email_input').val()) === false) {
            error('Email некорректный');
	}
	else if($('#registration_login_input').val() === '') {
            error('Введите логин');
	}
                else if($('#registration_password_input').val() === '') {
                    error('Введите пароль');
                }
	else if($('#registration_password_repeat_input').val() === '') {
            error('Повторите пароль');
	}
	else if($('#registration_password_repeat_input').val() !== $('#registration_password_input').val()) {
            error('Пароли не совпадают');
	}
	else if($('#registration_category_input span').text() === '') {
            error('Выберите категорию');
	}
	else if($('.registration_rules_input_on').length === 0) {
            error('Ознакомьтесь с правилами');
	}	
	else {
                    var email = $('#registration_email_input').val();
                    var login = $('#registration_login_input').val();
                    var password = $('#registration_password_input').val();
                    var category = $('#registration_category_input span').attr('class');
                    var rules = 'on';
                    $.post('blocks/prowin/registration.php',
                    {
                        email:email,
                        login:login,
                        password:password,
                        category:category,
                        rules:rules
                    },
                    function(dataRegistration){	
                        if(dataRegistration === 'success') {
                            success('Вы почти зарегистрировались! Проверьте указанную вами почту.');
                        }
                        else {
                            error(dataRegistration);
                        }
                    });
	}
    });
    
    $('.login').click(function(){
        if($('#login').css('display') === 'none') {
            $('#registration').fadeOut(200);
            $(this).children('.l_radial').css('background','#5fc8a7');
            $('.registration').children('.l_radial').css('background','#b1b1b1');
            setTimeout(function(){
                $('#login').fadeIn(200);
            },200);
        }
        else {
            $('#login').fadeOut(200);
            $(this).children('.l_radial').css('background','#b1b1b1');
        }
    });
    $('#login_button').click(function(e){
        e.preventDefault();
        var email = $('#login_email_input').val();
        var password = $('#login_password_input').val();
         if (email === '') {
            error('Введите E-mail');
        }
        else if(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(email) === false) {
             error('E-mail некорректен');
        }
        else if (password === 'Введите пароль') {
            error('Ознакомьтесь с правилами');
        }
        else {
            $.post('blocks/prowin/login.php',
            {
                email:email,
                password:password
            },
            function(dataLogin){
                if(dataLogin === 'success') {
                    location.reload();
                }
                else {
                    error(dataLogin);
                }
            });      
        }
    });
    
    $('#registration_category_input').click(function(){
        $('#registration_category_select').fadeIn(100);
    });
    $('#registration_category_select .registration_category_select').click(function(){
        $('#registration_category_select').fadeOut(100);
        $('#registration_category_input').css('border-radius','3px');
        var category = $(this).children('span').text();
        $('#registration_category_input span').html(category);
        $('#registration_category_input span').attr('class',$(this).children('span').attr('class'));
    });
    $('#registration_rules_input').click(function(){
        if($('.registration_rules_input_on').length === 0) {
            $('#registration_rules_input').html('<div class="registration_rules_input_on" style="width:20px; height: 20px; background: #949494; margin: 8px 0px 0px 7px; position:absolute; z-index: 1; border-radius:3px;"></div>');
        }
        else {
            $('.registration_rules_input_on').remove();
        }	
    });	
});