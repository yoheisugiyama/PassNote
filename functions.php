<?php

require_once('config.php');

// データベースに接続する
function connectDb() {

  // $host = "localhost";   //ホスト名またはIPアドレス（ここではホスト名を使用）
  // $user = "root";     //ユーザーID
  // $pass = "root";    //パスワード
  // $db = "mykakugen";     //データベース
  $param = "mysql:dbname=".DB_NAME.";host=".DB_HOST;

    try {
        $pdo = new PDO($param, DB_USER, DB_PASSWORD);
        $pdo->query('SET NAMES utf8;');
        return $pdo;
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }


}

// メールアドレスの存在チェック
function checkEmail($user_email, $pdo) {

	$sql = "select * from user_info where user_email = :user_email limit 1";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(":user_email" => $user_email));
	$user = $stmt->fetch();
	
  return $user ? true : false;
}

// アプリケーションの存在チェック
function checkAppName($app_name, $user_id, $pdo) {

    $sql = "select * from id_pass where app_name = :app_name and user_id=:user_id limit 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":app_name" => $app_name, ":user_id"=> $user_id));
    $user = $stmt->fetch();

    return $user ? true : false;
}


// メールアドレスとパスワードからuserを検索する
function getUser($user_email, $master_password, $pdo) {

    $sql = "select * from user_info where user_email = :user_email and master_password = :master_password limit 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":user_email" => $user_email, ":master_password" => $master_password));
    $user = $stmt->fetch();

  return $user ? $user : false;
}


//XSS（クロスサイトスクリプティング）対策。htmlspecialcharacters化して
function h($original_str) {
        return htmlspecialchars($original_str, ENT_QUOTES, "UTF-8");
}

// トークンを発行する処理
function setToken() {
        $token = sha1(uniqid(mt_rand(), true));
        $_SESSION['sstoken'] = $token;
}

// トークンをチェックする処理
function checkToken() {
        if (empty($_SESSION['sstoken']) || ($_SESSION['sstoken'] != $_POST['token'])) {
                echo '<html><head><meta charset="utf-8"></head><body>不正なアクセスです。</body></html>';
                exit;
        }
}
