<?php

header('Content-type: text/html; charset=UTF-8');

require_once('config.php');
require_once('functions.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	// 初めて画面にアクセスした時の処理
	if(isset($_SESSION['USER'])){
		$user_info=$_SESSION['USER'];
	}

} else {
	// フォームからサブミットされた時の処理
	$name = $_POST['name'];
	$user_email = $_POST['user_email'];
	$master_id = $_POST['master_id'];
	$master_password = $_POST['master_password'];
	$mail_announce = $_POST['mail_announce'];

	//データベースに接続する
	$pdo = connectDb();

	// 入力チェックを行う。
	$err = array();

	// [名前]未入力チェック
	if (!$name) {
		$err['name'] = '名前を入力して下さい。';
	}
	// [マスターパスワード]未入力チェック
	if(!$master_id){
		$err['master_id'] = 'パスワードを入力して下さい。';
	}

	// [パスワード]未入力チェック
	if(!$master_password){
		$err['master_password'] = 'パスワードを入力して下さい。';
	}
	if(!$user_email){
		$err['user_email'] = 'e-mailを入力して下さい。';
	}elseif(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
		$err['user_email'] = 'e-mailの形式が正しくありません';
	}elseif(checkEmail($user_email, $pdo)) {
		$err['user_email'] = 'このメールアドレスは既に登録されています。';
	}

	// もし$err配列に何もエラーメッセージが保存されていなかったら
	if (empty($err)) {
		//ユーザー名、パスワード、e-mail初回登録
		$sql = "insert into user_info
          (name, user_email, master_id, master_password, mail_announce,created_at, updated_at)
            values
            (:name,:user_email, :master_id, :master_password, :mail_announce, now(), now())";

		//DB接続、登録
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(':name'=>$name,':user_email'=>$user_email,':master_id'=>$master_id,':master_password'=>$master_password,':mail_announce'=>$mail_announce));

		//登録後自動ログイン
		$sql = "select * from user_info where user_email = :user_email and master_password = :master_password limit 1";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(":user_email" => $user_email, ":master_password" => $master_password));
		$user = $stmt->fetch();

		$_SESSION['USER'] = $user;

		header('Location: '.SITE_URL.'list.php');
		unset($pdo);
		exit;
	}
	unset($pdo);
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PassNote</title>

    <!-- Bootstrap core CSS -->
     <link href="css/bootstrap.css" rel="stylesheet">
	  <link href="css/style.css" rel="stylesheet">

     <!-- <link href="css/carousel.css" rel="stylesheet"> -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
  </head>

<body>

	<div class="sidebar">
		<h1 class="main_signup">PASSNOTE</h1>
		<ul class="sidebar_list list-unstyled nav nav-pills nav-stacked">
			<li><a href="index.php">HOME</a></li>
		</ul>
	</div>

	<div class="main_contents">
		<h1 class="main_signup">初期サインアップ画面</h1>		

		<form method="post" class="form-horizontal" >
		  <div class="form-group form-group-lg">
		    <label class="col-sm-2 control-label" for="formGroupInputLarge">名前</label>
		    <div class="col-sm-6">
		      <input class="form-control" type="text" id="formGroupInputLarge" placeholder="名前" name="name" value="<?php echo($user_info['name']);?>">
		    </div>
		  </div>
		  <div class="form-group form-group-lg">
		    <label class="col-sm-2 control-label" for="formGroupInputLarge">マスターID</label>
		    <div class="col-sm-6">
		      <input class="form-control" type="text" id="formGroupInputLarge" placeholder="マスターID" name="master_id" value="<?php echo($user_info['master_id']);?>">
		    </div>
		  </div>
		  <div class="form-group form-group-lg">
		    <label class="col-sm-2 control-label" for="formGroupInputLarge">e-mailアドレス</label>
		    <div class="col-sm-6">
		      <input class="form-control" type="text" id="formGroupInputLarge" placeholder="e-mailアドレス" name="user_email" value="<?php echo($user_info['user_email']);?>">
		    </div>
		  </div>
		  <div class="form-group form-group-lg">
		    <label class="col-sm-2 control-label" for="formGroupInputLarge">マスターPassword</label>
		    <div class="col-sm-6">
		      <input class="form-control" type="text" id="formGroupInputLarge" placeholder="マスターPassword" name="master_password" value="<?php echo($user_info['master_password']);?>">
		    </div>
		  </div>
		  <div class="form-group form-group-lg">
		    <label class="col-sm-2 control-label" for="formGroupInputLarge">メール通知</label>
		    <div class="col-sm-6">
		      <input class="form-control" type="text" id="formGroupInputLarge" placeholder="メール通知" name="mail_announce" value="<?php echo($user_info['mail_announce']);?>">
		    </div>
		  </div>
<!--			<div class="register">-->
<!--			<p><a class="col-sm-4 btn btn-lg btn-primary" role="button">登録</a></p>-->
<!--			</div>-->


			<div class="form-group col-sm-4 register">
				<input class="btn btn-success btn-block btn-lg" type="submit" value="アカウントを作成">
			</div>
	    </form>

  </div>
  

  <div style="clear:both;"></div>

</body>

