<?php
/* Smarty version 3.1.33, created on 2018-10-18 06:01:31
  from 'C:\xampp\htdocs\git\message_board\martinchangchungyo.github.io\message_media.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5bc8059ba7f7c6_50858662',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42e503d23d89808a13bb428b88319cef7346c1de' => 
    array (
      0 => 'C:\\xampp\\htdocs\\git\\message_board\\martinchangchungyo.github.io\\message_media.html',
      1 => 1539834704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bc8059ba7f7c6_50858662 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\git\\message_board\\martinchangchungyo.github.io\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
ob_start();
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['json']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>

<div class="media" data-id="<?php ob_start();
echo $_smarty_tpl->tpl_vars['json']->value[$_smarty_tpl->tpl_vars['k']->value]['id'];
$_prefixVariable2 = ob_get_clean();
echo $_prefixVariable2;?>
">
    <div class="media-left"><img src="img/<?php ob_start();
echo $_smarty_tpl->tpl_vars['json']->value[$_smarty_tpl->tpl_vars['k']->value]['picture'];
$_prefixVariable3 = ob_get_clean();
echo $_prefixVariable3;?>
" class="media-object"></div>
    <div class="media-body">
        <h4 class="media-heading"><?php ob_start();
echo $_smarty_tpl->tpl_vars['json']->value[$_smarty_tpl->tpl_vars['k']->value]['name'];
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>
 <small><i><?php ob_start();
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['json']->value[$_smarty_tpl->tpl_vars['k']->value]['timestamp']);
$_prefixVariable5 = ob_get_clean();
echo $_prefixVariable5;?>
</i></small></h4>
        <p class="media-text"><?php ob_start();
echo $_smarty_tpl->tpl_vars['json']->value[$_smarty_tpl->tpl_vars['k']->value]['text'];
$_prefixVariable6 = ob_get_clean();
echo $_prefixVariable6;?>
</p>
        <div class="media-bottom-group">
            <?php ob_start();
if ($_smarty_tpl->tpl_vars['json']->value[$_smarty_tpl->tpl_vars['k']->value]['has_like'] == true) {
$_prefixVariable7 = ob_get_clean();
echo $_prefixVariable7;?>

            <a class="media-bottom-item media-like" data-like-type="minus"><?php ob_start();
echo $_smarty_tpl->tpl_vars['like_back']->value;
$_prefixVariable8 = ob_get_clean();
echo $_prefixVariable8;?>
 (<?php ob_start();
echo $_smarty_tpl->tpl_vars['json']->value[$_smarty_tpl->tpl_vars['k']->value]['like_count'];
$_prefixVariable9 = ob_get_clean();
echo $_prefixVariable9;?>
)</a>
            <?php ob_start();
} else {
$_prefixVariable10 = ob_get_clean();
echo $_prefixVariable10;?>

            <a class="media-bottom-item media-like" data-like-type="plus"><?php ob_start();
echo $_smarty_tpl->tpl_vars['like']->value;
$_prefixVariable11 = ob_get_clean();
echo $_prefixVariable11;?>
 (<?php ob_start();
echo $_smarty_tpl->tpl_vars['json']->value[$_smarty_tpl->tpl_vars['k']->value]['like_count'];
$_prefixVariable12 = ob_get_clean();
echo $_prefixVariable12;?>
)</a>
            <?php ob_start();
}
$_prefixVariable13 = ob_get_clean();
echo $_prefixVariable13;?>

            <?php ob_start();
if ($_smarty_tpl->tpl_vars['json']->value[$_smarty_tpl->tpl_vars['k']->value]['account_id'] == $_smarty_tpl->tpl_vars['data_account_id']->value || $_smarty_tpl->tpl_vars['data_account_id']->value == 4) {
$_prefixVariable14 = ob_get_clean();
echo $_prefixVariable14;?>

            <a class="media-bottom-item media-delete">刪除</a>
            <?php ob_start();
}
$_prefixVariable15 = ob_get_clean();
echo $_prefixVariable15;?>

        </div>
    </div>
</div>
<?php ob_start();
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_prefixVariable16 = ob_get_clean();
echo $_prefixVariable16;?>

<?php }
}
