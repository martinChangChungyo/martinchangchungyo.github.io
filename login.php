<?php
    // error_reporting(0);
    global $DBNAME, $DBUSER, $DBPASSWD, $DBHOST, $con;
    $DBNAME = 'test_1';
    $DBUSER = 'root';
    $DBPASSWD = '';
    $DBHOST = 'localhost';

    $con = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD);
    if (empty($con)) {
        echo mysqli_error($con);
        die('無法連結資料庫_1');
        exit;
    }

    if (!mysqli_select_db($con, $DBNAME)) {
        echo mysqli_error($con);
        die('無法選擇資料庫_2');
    }
    mysqli_query($con, "SET NAMES utf8");

    if ($_GET['signUp'] == 'true') {
        $email = $_POST['email'];
        // echo checkAccountExist($email);
        if (checkAccountExist($email) > 0) {
            echo 1;
        } else {
            $pwdArray = generateHashWithSalt($_POST['password']);
            $pwd = $pwdArray[0];
            $salt = $pwdArray[1];
            $name = explode("@", $email)[0];
            createAccount($name, $email, $pwd, $salt);
            echo 0;
        }
    } elseif ($_GET['editInfo'] == 'true') {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $picture = $_POST['picture'];
        updateAccountInfo($email, $name, $picture);
        echo 1;
    } else {
        $email = $_POST['email'];
        if (checkAccountExist($email) > 0) {
          $pwd = $_POST['password'];
          $salt = getAccountSalt($email);

          $sql = "SELECT email, password FROM `test_account` WHERE `email` = ? and `password` = ?";
          $stmt = $con->prepare($sql);
          $stmt->bind_param("ss", $email, $pwd);
          $stmt->execute();
          $result = $stmt->get_result();
          $chcek_account = mysqli_num_rows($result);
          $stmt->close();
        } else {
          echo 0;
        }


        echo $chcek_account;
    }

    mysqli_close($con);

    // function hash($password)
    // {
    //     $salt = md5(mcrypt_create_iv(32));
    //     $b = md5($password).$salt;
    //     $b = md5($b);
    //     return $b;
    // }

    function generateHashWithSalt($password)
    {
        $intermediateSalt = md5(uniqid(rand(), true));
        $salt = substr($intermediateSalt, 0, 6);
        $pwd = hash("sha256", $password . $salt);
        // $pwd = md5($password);
        return array($pwd, $salt);
    }

    function makeRandNum()
    {
        $length = 10;
        $num = '';
        for ($x = 0; $x < $length; $x++) {
            if ($x == 0 || $x == ($length - 1)) {
                $rand = rand(1, 9);
            } else {
                $rand = rand(0, 9);
            }
            $num = $num . $rand;
        }
        return (int)$num;
    }

    function checkAccountExist($email)
    {
        $sql = "SELECT email FROM `test_account` WHERE `email` = ?";
        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $chcek_account = mysqli_num_rows($result);
        $stmt->close();
        return $chcek_account;
    }

    function getAccountSalt($email)
    {
      // "======================= 改到這裡 ========================="
      // "======================= 改到這裡 ========================="
      // "======================= 改到這裡 ========================="
      // "======================= 改到這裡 ========================="
      // "======================= 改到這裡 ========================="
      // "======================= 改到這裡 ========================="
      // "======================= 改到這裡 ========================="
      //   "======================= 改到這裡 ========================="
        $sql = "SELECT email FROM `test_account` WHERE `email` = ?";
        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        mysqli_fetch_field($result);
        var_dump($result);

        // $chcek_account = mysqli_num_rows($result);
        $stmt->close();
        return 0;
        // "======================= 改到這裡 ========================="
        // "======================= 改到這裡 ========================="
        // "======================= 改到這裡 ========================="
        // "======================= 改到這裡 ========================="
        // "======================= 改到這裡 ========================="
        // "======================= 改到這裡 ========================="
        // "======================= 改到這裡 ========================="
        // "======================= 改到這裡 ========================="
    }

    function createAccount($name, $email, $pwd, $salt)
    {
        $sql = 'INSERT INTO `test_account` (name, email, password, salt) VALUES (?, ?, ?, ?)';
        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param('ssss', $name, $email, $pwd, $salt);
        $stmt->execute();
        $stmt->close();
    }

    function updateAccountInfo($email, $name, $picture)
    {
        $sql = "UPDATE `test_account` SET `name` = ?, `picture` = ? WHERE `email` = ?";
        $stmt = $GLOBALS['con']->prepare($sql);
        $stmt->bind_param("sss", $name, $picture, $email);
        $stmt->execute();
        $stmt->close();
    }
