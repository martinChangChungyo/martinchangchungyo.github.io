$(document).ready(function() {
    inputUserInfo();

    var type = $('#sort_type_dropdown li.active > a').html();
    $('#sort_type_title').html(type);

    // 切換使用者
    $('#user_dropdown .dropdown-menu').on('click', 'a', function() {
        $('#user_dropdown .dropdown-menu li').removeClass('active');
        $(this).parent().addClass('active');
        var account_id = $(this).find('[data-account-id]').attr('data-account-id');
        var name = $(this).find('.user-name').html();
        var src = $(this).find('.user-picture').attr('src');
        $('#user_name').html(name).attr('data-account-id', account_id);
        $('#reply_user_name').html(name);
        $('#user_picture').attr('src', src);
        $('#reply_user_picture').attr('src', src);
        refreshMediaData();
    });

    // 切換回覆排序
    $('#sort_type_dropdown .dropdown-menu').on('click', 'a', function() {
        $('#sort_type_dropdown .dropdown-menu li').removeClass('active');
        $(this).parent().addClass('active');
        var name = $(this).html();
        $('#sort_type_dropdown > [data-toggle="dropdown"] > span:first-child').html(name);
        refreshMediaData();
    });

    // 發表新回覆
    $('#send_reply').on('click', function() {
        var account_id = Number($('#user_name').attr('data-account-id'));
        var timestamp = new Date().getTime() / 1000;
        var name = $('#reply_user_name').html();
        var src = $('#reply_user_picture').attr('src').split('/');
        var num = src.length - 1;
        var picture = src[num];
        var text = $('#reply_text').val();
        var like_count = 0;
        var data = {
            account_id: account_id,
            timestamp: timestamp,
            name: name,
            picture: picture,
            text: text,
            like_count: like_count
        }
        var type = $('#sort_type_dropdown li.active').attr('data-sort-type');
        var option = {
            url: DATA_URL,
            type: type,
            data: data,
            infoType: 'AddInfo'
        }
        doAjax(option, function(data) {
            doMessageList(data);
        });
        $('#reply_text').val('');
    });

    // 刪除回覆
    $('#delete_reply_btn').on('click', function() {
        $('#delete_reply_modal').modal('hide');
        var id = Number($('#delete_reply_btn').attr('data-delete-id'));
        var account_id = Number($('#user_name').attr('data-account-id'));
        var data = {
            id: id,
            account_id: account_id
        }
        var type = $('#sort_type_dropdown li.active').attr('data-sort-type');
        var option = {
            url: DATA_URL,
            type: type,
            data: data,
            infoType: 'DeleteInfo'
        }
        doAjax(option, function(data) {
            doMessageList(data);
        });
    });
});

doAjax = function(option, callback) {
    if (typeof(option.url) == 'undefined') {
        return;
    }
    var data;
    var url = option.url + '?Type=' + option.type;
    if (typeof(option.data) != 'undefined') {
        data = option.data;
    }
    if (typeof(option.infoType) != 'undefined') {
        if (option.infoType == 'AddInfo') {
            url += '&AddInfo=true';
        } else {
            url += '&AddInfo=false';
        }
        if (option.infoType == 'EditInfo') {
            url += '&EditInfo=true';
        } else {
            url += '&EditInfo=false';
        }
        if (option.infoType == 'DeleteInfo') {
            url += '&DeleteInfo=true';
        } else {
            url += '&DeleteInfo=false';
        }
        if (option.infoType == 'GetUserInfo') {
            url += '&GetUserInfo=true';
        } else {
            url += '&GetUserInfo=false';
        }
    } else {
        url += '&AddInfo=false';
        url += '&EditInfo=false';
        url += '&DeleteInfo=false';
        url += '&GetUserInfo=false';
    }
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(data) {
            // if (typeof(data) == 'string') {
            //     data = JSON.parse(data);
            // }
            // console.warn('success = > ' + url);
            // console.log(data);
            if (typeof(callback) != 'undefind') {
                callback(data);
            }
        }
    });
};

inputUserInfo = function() {
    var type = $('#sort_type_dropdown li.active').attr('data-sort-type');
    var option = {
        url: 'data.php',
        type: type,
        infoType: 'GetUserInfo'
    }
    doAjax(option, function(data) {
        data = JSON.parse(data);
        doUserFunctions(data);
        refreshMediaData();
    });
};

doUserFunctions = function(data) {
    doDefaultUser(data);
    doUserList(data);
    setMediaFunctions();
};

doDefaultUser = function(data) {
    var defaultUser = getIndexOfAccount(data, DEFAULT_USER_ID);
    var picture = setUserPicture(data[defaultUser].picture);
    $('#user_name').attr('data-account-id', data[defaultUser].account_id).html(data[defaultUser].name);
    $('#user_picture').attr('src', 'img/' + picture);
    $('#reply_user_name').html(data[defaultUser].name);
    $('#reply_user_picture').attr('src', 'img/' + picture);
};

doUserList = function(data) {
    var elAll = '';
    var defaultUser = getIndexOfAccount(data, DEFAULT_USER_ID);
    for (var i = 0; i < data.length; i++) {
        var active = '';
        var picture = setUserPicture(data[i].picture);
        if (i == defaultUser) {
            active = 'class="active"';
        }
        var el =
            '<li ' + active + '>' +
            '<a class="text-right">' +
            '<span class="user-name" data-account-id="' + data[i].account_id + '">' + data[i].name + '</span>' +
            '<img class="media-object img-circle user-picture" src="img/' + picture + '">' +
            '</a>' +
            '</li>';
        elAll += el;
    }
    $('#user_dropdown .dropdown-menu').append(elAll);
};

doMessageList = function(data) {
    // var account_id = Number($('#user_name').attr('data-account-id'));
    // var elAll = '';
    // for (var i = 0; i < data.length; i++) {
    //     var NowDate = new Date(data[i].timestamp * 1000).toDateString();
    //     var el =
    //         '<div class="media" data-id="' + data[i].id + '">' +
    //         '<div class="media-left">' +
    //         '<img src="img/' + data[i].picture + '" class="media-object">' +
    //         '</div>' +
    //         '<div class="media-body">' +
    //         '<h4 class="media-heading">' + data[i].name + ' <small><i>' + NowDate + '</i></small></h4>' +
    //         '<p class="media-text">' + data[i].text + '</p>' +
    //         '<div class="media-bottom-group">';
    //     if (data[i].has_like == true) {
    //         el += '<a class="media-bottom-item media-like" data-like-type="minus">收回讚 (' + data[i].like_count + ')</a>';
    //     } else {
    //         el += '<a class="media-bottom-item media-like" data-like-type="plus">讚 (' + data[i].like_count + ')</a>';
    //     }
    //     if (account_id == data[i].account_id || account_id == 4) {
    //         el += '<a class="media-bottom-item media-delete">刪除</a>';
    //     }
    //     el += '</div>' +
    //         '</div>' +
    //         '</div>';
    //     elAll += el;
    // }
    // $('.message-board .media-middle-body').empty().append(elAll);
    $('.message-board .media-middle-body').empty().append(data);
    setMediaFunctions();
};

refreshMediaData = function() {
    var account_id = Number($('#user_name').attr('data-account-id'));
    var type = $('#sort_type_dropdown li.active').attr('data-sort-type');
    var data = {
        account_id: account_id
    }
    var option = {
        url: DATA_URL,
        type: type,
        data: data
    }
    doAjax(option, function(data) {
        doMessageList(data);
    });
};

setMediaFunctions = function() {
    setMediaLikeEvent();
    setMediaDeleteEvent();
};

setMediaLikeEvent = function() {
    $('.media-like').on('click', function() {
        var id = Number($(this).parents('.media').attr('data-id'));
        var account_id = Number($('#user_name').attr('data-account-id'));
        var timestamp = new Date().getTime() / 1000;
        var name = $('#reply_user_name').html();
        var likeType = $(this).attr('data-like-type');
        var data = {
            id: id,
            account_id: account_id,
            timestamp: timestamp,
            name: name,
            likeType: likeType
        }
        var type = $('#sort_type_dropdown li.active').attr('data-sort-type');
        var option = {
            url: DATA_URL,
            type: type,
            data: data,
            infoType: 'EditInfo'
        }
        doAjax(option, function(data) {
            doMessageList(data);
        });
    });
};

setMediaDeleteEvent = function() {
    $('.media-delete').on('click', function() {
        var id = Number($(this).parents('.media').attr('data-id'));
        $('#delete_reply_modal').modal('show');
        $('#delete_reply_btn').attr('data-delete-id', id);;
    });
};

setUserPicture = function(url) {
    if (url != 'undefined') {
        if (url != null) {
            return url;
        } else {
            return DEFAULT_PICTURE;
        }
    } else {
        return DEFAULT_PICTURE;
    }
};

getIndexOfAccount = function(data, id) {
    var num = $.map(data, function(item, index) {
        return item.account_id
    }).indexOf(id);
    if (num == -1) {
        num = 0;
    }
    return num;
};
