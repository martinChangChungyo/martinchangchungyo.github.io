<?php
    // 是否顯示 error訊息
    // error_reporting(0);

    // 設定 DB資訊
    global $DBNAME, $DBUSER, $DBPASSWD, $DBHOST, $con, $smarty;
    $DBNAME = 'test_1';
    $DBUSER = 'root';
    $DBPASSWD = '';
    $DBHOST = 'localhost';

    $con = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD);
    if (empty($con)) {
        echo mysqli_error($con);
        die('無法連結資料庫');
        exit;
    }

    if (!mysqli_select_db($con, $DBNAME)) {
        echo mysqli_error($con);
        die('無法選擇資料庫');
    }
    mysqli_query($con, "SET NAMES utf8");

    // 導入 Smarty
    require './libs/Smarty.class.php';
    $smarty = new Smarty;
    $smarty->assign("like", "讚");
    $smarty->assign("like_back", "收回讚");
    $smarty->assign("data_account_id", (int)$_POST['account_id']);

    // 重新整理讚數統計
    refleshLikeCount();

    if ($_GET['GetUserInfo'] == 'true') {
        $sql = 'SELECT account_id, name, picture FROM `test_account` ORDER BY `test_account`.`account_id` ASC';
        $result = mysqli_query($con, $sql);

        // 刷新回覆資料並回傳 js處理
        $json = array();
        while ($obj = mysqli_fetch_object($result)) {
            $this_json = array(
                'account_id' => (int)$obj->account_id,
                'name' => $obj->name,
                'picture' => $obj->picture
              );
            array_push($json, $this_json);
        }
        mysqli_close($con);
        echo json_encode($json);
    } else {
          // 資料的排序類型 (hot 依讚數, time 發表時間)
        if ('hot' == $_GET['Type']) {
            $sql = 'SELECT * FROM `test_table` ORDER BY `test_table`.`like_count` DESC';
        } else {
            $sql = 'SELECT * FROM `test_table` ORDER BY `test_table`.`timestamp` DESC';
        }
        global $result;
        $result = mysqli_query($con, $sql);

        // 如果有新增回覆, 編輯(讚數改變), 刪除回覆
        if ($_GET['AddInfo'] == 'true') {
            // $id = mysqli_num_rows($result) + 1;
            $account_id = (int)$_POST['account_id'];
            $timestamp = (int)$_POST['timestamp'];
            $name = $_POST['name'];
            $picture = $_POST['picture'];
            $text = $_POST['text'];
            $like_count = (int)$_POST['like_count'];

            createMessageData($account_id, $timestamp, $name, $picture, $text, $like_count);
            $result = mysqli_query($con, $sql);
        } elseif ($_GET['EditInfo'] == 'true') {
            $message_id = (int)$_POST['id'];
            $account_id = (int)$_POST['account_id'];

            // 增加或減少讚數 (plus 增加, minus 減少)
            if ($_POST['likeType'] == 'plus') {
                $timestamp = (int)$_POST['timestamp'];
                createLikeCountData($message_id, $account_id, $timestamp);
            } else {
                deleteLikeCountData($message_id, $account_id);
            }
            // 重新整理讚數統計
            refleshLikeCount();
            $result = mysqli_query($con, $sql);
        } elseif ($_GET['DeleteInfo'] == 'true') {
            $id = (int)$_POST['id'];
            deleteMessageData($id);
            $result = mysqli_query($con, $sql);
        }

        // 刷新回覆資料並回傳 js處理
        $user_id = (int)$_POST['account_id'];
        $json = array();
        while ($obj = mysqli_fetch_object($result)) {
            $id = (int)$obj->id;
            $sql_like = "SELECT message_id, account_id FROM `test_like_count`
                  WHERE `message_id` = ? and `account_id` = ?";
            $stmt = $GLOBALS['con']->prepare($sql_like);
            $stmt->bind_param("ii", $id, $user_id);
            $stmt->execute();
            $result_like = $stmt->get_result();
            $has_like = mysqli_num_rows($result_like);
            $stmt->close();

            $this_json = array(
                'id' => $id,
                'account_id' => (int)$obj->account_id,
                'timestamp' => (int)$obj->timestamp,
                'name' => $obj->name,
                'picture' => $obj->picture,
                'text' => $obj->text,
                'like_count' => (int)$obj->like_count,
                'has_like' => $has_like
            );
            array_push($json, $this_json);
        }
        mysqli_close($con);
        // echo json_encode($json);
        $smarty->assign('json', $json);
        $smarty->display('message_media.html');
    }

function createMessageData($account_id, $timestamp, $name, $picture, $text, $like_count)
{
    $sql = 'INSERT INTO `test_table` (account_id, timestamp, name, picture,
        text, like_count) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('iisssi', $account_id, $timestamp, $name, $picture, $text, $like_count);
    $stmt->execute();
    $stmt->close();
}

function createLikeCountData($message_id, $account_id, $timestamp)
{
    $sql = 'INSERT INTO `test_like_count` (message_id, account_id, timestamp) VALUES (?, ?, ?)';
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param('iii', $message_id, $account_id, $timestamp);
    $stmt->execute();
    $stmt->close();
}

function deleteLikeCountData($message_id, $account_id)
{
    $sql = "DELETE FROM `test_like_count` WHERE `message_id` = ? and `account_id` = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param("ii", $message_id, $account_id);
    $stmt->execute();
    $stmt->close();
}

function updateMessageData($id, $like_count)
{
    $sql = "UPDATE `test_table` SET `like_count` = ? WHERE `id` = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param("ii", $like_count, $id);
    $stmt->execute();
    $stmt->close();
}

function deleteMessageData($id)
{
    $sql = "DELETE FROM `test_table` WHERE `id` = ?";
    $stmt = $GLOBALS['con']->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    $sql_like = "DELETE FROM `test_like_count` WHERE `message_id` = ?";
    $stmt = $GLOBALS['con']->prepare($sql_like);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function refleshLikeCount()
{
    $sql = "UPDATE `test_table` SET `like_count` = 0";
    $result = mysqli_query($GLOBALS['con'], $sql);
    $sql_like = "SELECT message_id,count(1) AS count FROM `test_like_count`
        GROUP BY message_id ORDER BY `test_like_count`.`message_id` ASC";
    $result_like = mysqli_query($GLOBALS['con'], $sql_like);
    $sql = 'SELECT * FROM `test_table`';
    $result = mysqli_query($GLOBALS['con'], $sql);
    while ($obj = mysqli_fetch_object($result_like)) {
        $message_id = (int)$obj->message_id;
        $like_count = ((int)$obj->count != 0) ? (int)$obj->count : 0;
        $sql = "UPDATE `test_table` SET `like_count` = ? WHERE `id` = ?";
        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param("ii", $like_count, $message_id);
        $stmt->execute();
        $stmt->close();
    }
}
