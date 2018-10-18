$(document).ready(function() {
    var defaultNmae;
    // $('[href="#edit_profile_form"]').tab('show');
    $('#login').on('click', function() {
        login();
    });
    $('#email').on('keydown', function(e) {
        if (!$('#email_error').hasClass('hide')) {
            $('#email_error').addClass('hide');
        }
        if (checkEnterKey(e)) {
            login();
        }
    });
    $('#pwd').on('keydown', function(e) {
        if (!$('#pwd_error').hasClass('hide')) {
            $('#pwd_error').addClass('hide');
        }
        if (checkEnterKey(e)) {
            login();
        }
    });

    $('#sign_up_check').on('click', function() {
        signUp();
    });
    $('#sign_up_email').on('keydown', function(e) {
        if (!$('#sign_up_email_error').hasClass('hide')) {
            $('#sign_up_email_error').addClass('hide');
        }
        if (checkEnterKey(e)) {
            signUp();
        }
    });
    $('#sign_up_pwd').on('keydown', function(e) {
        if (!$('#sign_up_pwd_error').hasClass('hide')) {
            $('#sign_up_pwd_error').addClass('hide');
        }
        if (checkEnterKey(e)) {
            signUp();
        }

    });
    $('#sign_up_pwd_2').on('keydown', function(e) {
        if (!$('#sign_up_pwd_error_2').hasClass('hide')) {
            $('#sign_up_pwd_error_2').addClass('hide');
        }
        if (checkEnterKey(e)) {
            signUp();
        }
    });

    $('.picture-group').on('click', '.picture-item', function() {
        var src = $(this).find('img').attr('src');
        $(this).addClass('active').siblings().removeClass('active');
        $('#edit_profile_picture').attr('src', src);
    });

    $('#edit_profile_name').on('keydown', function(e) {
        if (!$('#edit_profile_name_error').hasClass('hide')) {
            $('#edit_profile_name_error').addClass('hide');
        }
        if (checkEnterKey(e)) {
            editInfo();
        }
    });
    $('#edit_profile_confirm').on('click', function() {
        editInfo();
    });
});

doAjax = function(option, callback) {
    var data, status;
    var url = 'login.php?';
    if (typeof(option.data) != 'undefined') {
        data = option.data;
    }
    if (typeof(option.infoType) != 'undefined') {
        if (option.infoType == 'signUp') {
            url += 'signUp=true&';
        } else {
            url += 'signUp=false&';
        }
        if (option.infoType == 'editInfo') {
            url += 'editInfo=true&';
        } else {
            url += 'editInfo=false&';
        }
    } else {
        url += 'signUp=false&';
        url += 'editInfo=false';
    }
    console.log(url);
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            status = 'success';
            if (typeof(callback) != 'undefind') {
                callback(data, status);
            }
        },
        error: function(data) {
            status = 'error';
            if (typeof(callback) != 'undefind') {
                callback(data, status);
            }
        }
    });
};

login = function() {
    $('#loading_page').fadeIn('slow');
    var email = $('#email').val();
    var pwd = $('#pwd').val();
    if (checkEmail(email) && checkPwd(pwd)) {
        var data = {
            email: email,
            password: pwd
        }
        var option = {
            data: data
        }
        doAjax(option, function(data, status) {
            var message;
            if (Number(data) == 1) {
                console.log('success');
            } else if (Number(data) == 0) {
                message = '錯誤的帳號或密碼。';
                $('#modal_message .modal-message').html(message);
                $('#modal_message').modal('show');
            } else {
                message = '連線資料庫錯誤，請重新再試。';
                $('#modal_message .modal-message').html(message);
                $('#modal_message').modal('show');
            }
            $('#loading_page').stop().fadeOut('slow');
        });
    } else {
        $('#loading_page').stop().fadeOut('slow');
    }
};

signUp = function() {
    $('#loading_page').fadeIn('slow');
    var email = $('#sign_up_email').val();
    var pwd = $('#sign_up_pwd').val();
    var pwd_2 = $('#sign_up_pwd_2').val();
    if (checkEmail(email) && checkPwd(pwd) && checkPwd(pwd_2) && pwd === pwd_2) {
        var data = {
            email: email,
            password: pwd
        }
        var option = {
            data: data,
            infoType: 'signUp'
        }
        doAjax(option, function(data, status) {
            var message;
            console.log(data);
            if (Number(data) == 1) {
                message = '此信箱已存在。';
                $('#modal_message .modal-message').html(message);
                $('#modal_message').modal('show');
            } else if (Number(data) == 0) {
                setProfileInfo();
                $('[href="#edit_profile_form"]').tab('show');
            } else {
                message = '連線資料庫錯誤，請重新再試。';
                $('#modal_message .modal-message').html(message);
                $('#modal_message').modal('show');
            }
            $('#loading_page').stop().fadeOut('slow');
        });
    } else {
        $('#loading_page').stop().fadeOut('slow');
    }
};

editInfo = function() {
    $('#loading_page').fadeIn('slow');
    var name = String($('#edit_profile_name').val()).replace(/(^\s*)|(\s*$)/g,"");
    var src = $('#edit_profile_picture').attr('src').split('/');
    var num = src.length - 1;
    var picture = String(src[num]);
    $('#edit_profile_name').val(name);
    if (checkName(name)) {
        if (name == defaultNmae) {
            backToLogin();
        } else {
            var email = String($('#edit_profile_email').html());
            var data = {
                email: email,
                name: name,
                picture: picture
            }
            var option = {
                data: data,
                infoType: 'editInfo'
            }
            doAjax(option, function(data, status) {
                var message;
                console.log(data);
                if (Number(data) == 1) {
                    backToLogin();
                } else {
                    message = '連線資料庫錯誤，請重新再試。';
                    $('#modal_message .modal-message').html(message);
                    $('#modal_message').modal('show');
                }
                $('#loading_page').stop().fadeOut('slow');
            });
        }
    } else {
        $('#edit_profile_name_error').removeClass('hide');
        $('#loading_page').stop().fadeOut('slow');
    }
};

setProfileInfo = function() {
    defaultNmae = $('#sign_up_email').val().split('@')[0];
    var email = $('#sign_up_email').val();
    $('#edit_profile_picture').attr('src', 'img/blank-avatar.png');
    $('#edit_profile_name').val(defaultNmae);
    $('#edit_profile_email').html(email);
};

backToLogin = function() {
    var message = '註冊成功，返回登入。';
    $('#modal_message .modal-message').html(message);
    $('#modal_message').modal('show');

    var email = $('#edit_profile_email').html();
    $('#email').val(email);
    $('#pwd').val('');

    $('[href="#login_form"]').tab('show');
    $('#loading_page').stop().fadeOut('slow');
};

checkLoginInfo = function() {
    var email = $('#email').val();
    var pwd = $('#pwd').val();
    var emailRule = /^\w+\@[A-Za-z0-9]+((\.)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
    var pwdRul = /^[a-zA-Z0-9]{6,26}$/;
    if (email.search(emailRule) == -1) {
        $('#email_error').removeClass('hide');
    }
    if (pwd.search(pwdRul) == -1) {
        $('#pwd_error').removeClass('hide');
    }
    if (email.search(emailRule) != -1 && pwd.search(pwdRul) != -1) {
        return true;
    } else {
        return false;
    }
};

checkEmail = function(email) {
    var emailRule = /^\w+\@[A-Za-z0-9]+((\.)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
    if (email.search(emailRule) == -1) {
        return false;
    } else {
        return true;
    }
};

checkPwd = function(pwd) {
    var pwd = $('#pwd').val();
    var pwdRul = /^[a-zA-Z0-9]{6,26}$/;
    if (pwd.search(pwdRul) == -1) {
        return false;
    } else {
        return true;
    }
};

checkName = function(name) {
    var nameRul = /^[a-zA-Z0-9^\s]{3,26}$/;
    if (name.search(nameRul) == -1) {
        return false;
    } else {
        return true;
    }
};

checkEnterKey = function(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {
        return true;
    } else {
        return false;
    }
};
