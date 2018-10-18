<?php
/* Smarty version 3.1.33, created on 2018-10-15 03:42:16
  from 'C:\xampp\htdocs\message_board\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5bc3f078bd5ba3_07979537',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5fe8bfac294f02712c3f15d1bf7b702e98624a1f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\message_board\\index.html',
      1 => 1539567633,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bc3f078bd5ba3_07979537 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '4243986005bc3f078b77b85_59585780';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/message_board/images/favicon.png" rel="icon" type="image/png" />

    <title><?php echo $_smarty_tpl->tpl_vars['web_title']->value;?>
</title>

    <meta name="description" content="XAMPP is an easy to install Apache distribution containing MariaDB, PHP and Perl." />
    <meta name="keywords" content="xampp, apache, php, perl, mariadb, open source distribution" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="/message_board/stylesheets/style.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="delete_reply_modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <p><?php echo $_smarty_tpl->tpl_vars['message_delete_help']->value;?>
</p>
                    <button id="delete_reply_btn" type="button" class="btn btn-danger"><?php echo $_smarty_tpl->tpl_vars['sure']->value;?>
</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $_smarty_tpl->tpl_vars['cancle']->value;?>
</button>
                </div>
            </div>

        </div>
    </div>

    <div id="top_bar" class="top-bar">
        <div>
            <span id="user_name" data-account-id></span>
            <img id="user_picture" src class="media-object img-circle">
            <div id="user_dropdown" class="dropdown">
                <span class="caret dropdown-toggle" type="button" data-toggle="dropdown"></span>
                <ul class="dropdown-menu dropdown-menu-right"></ul>
            </div>
        </div>
    </div>

    <div class="container-fluid page">

        <div class="info row">
            <h1><?php echo $_smarty_tpl->tpl_vars['article_title']->value;?>
</h1>
            <blockquote>
                <p><?php echo $_smarty_tpl->tpl_vars['article_body']->value;?>
</p>
                <footer><?php echo $_smarty_tpl->tpl_vars['article_author']->value;?>
</footer>
            </blockquote>
            <div class="horizontal-line"></div>
        </div>

        <div class="message-board row">
            <div class="media-reply-comment">
                <div class="media">
                    <div class="media-left">
                        <img id="reply_user_picture" src class="media-object img-circle">
                        <h4 id="reply_user_name" class="text-center"></h4>
                    </div>
                    <div class="media-body">
                        <div class="form-group">
                            <textarea id="reply_text" class="form-control" rows="5" placeholder="<?php echo $_smarty_tpl->tpl_vars['reply_help']->value;?>
"></textarea>
                        </div>
                        <button id="send_reply" type="button" class="btn btn-default"><?php echo $_smarty_tpl->tpl_vars['send']->value;?>
</button>
                    </div>
                </div>
            </div>

            <div class="media-top-bar">
                <div id="sort_type_dropdown" class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><span id="sort_type_title"></span><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li data-sort-type="hot"><a><?php echo $_smarty_tpl->tpl_vars['hot_reply']->value;?>
</a></li>
                        <li class="active" data-sort-type="time"><a><?php echo $_smarty_tpl->tpl_vars['according_time']->value;?>
</a></li>
                    </ul>
                </div>
            </div>

            <div class="media-middle-body"></div>
        </div>
    </div>
</body>

<!-- JS Libraries -->
<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/message_board/javascripts/config.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/message_board/javascripts/index.js" type="text/javascript"><?php echo '</script'; ?>
>

</html>
<?php }
}
