<?php
/**
 * Example Application
 *
 * @package Example-application
 */
require './libs/Smarty.class.php';
$smarty = new Smarty;
//$smarty->force_compile = true;
// $smarty->debugging = true;
$smarty->caching = true;
$smarty->left_delimiter = "{{";
$smarty->right_delimiter = "}}";
// $smarty->cache_lifetime = 120;

$smarty->assign("web_title", "Message board for week 1");
$smarty->assign("message_delete_help", "確定要刪除此訊息？");
$smarty->assign("sure", "確定");
$smarty->assign("cancle", "取消");
$smarty->assign("article_title", "Title");
$smarty->assign("article_body", "This is an article that looks like it is very powerful.");
$smarty->assign("article_author", "From Martin Chang");
$smarty->assign("reply_help", "發表你的想法");
$smarty->assign("send", "送出");
$smarty->assign("hot_reply", "熱門留言");
$smarty->assign("according_time", "依時間");
$smarty->assign("connect_db_error", "無法連結資料庫");
$smarty->assign("like", "讚");
$smarty->assign("___________", "________________");
$smarty->assign("___________", "________________");
$smarty->assign("___________", "________________");
$smarty->assign("___________", "________________");

$smarty->display('index.html');
