<?php

header('Content-type: text/html; charset=UTF-8');

require_once('config.php');
require_once('functions.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	// 初めて画面にアクセスした時の処理

	//list.php（一覧表示画面）で変更ボタンが押された場合の処理
	if(isset($_SESSION['app_name'])){


	
	$user = $_SESSION['USER'];
	$user_id=$user['user_id'];

	$app_name=$_SESSION['app_name'];

	//データベースに接続する
	$pdo = connectDb();
	$sql="select * from id_pass where user_id=:user_id and app_name=:app_name";
	
	$stmt = $pdo->prepare($sql);

	$stmt->execute(array(':user_id'=>$user_id, ':app_name'=>$app_name));

	//変更対象となるapp_infoをDBから取得
	$app_info=$stmt->fetch();
	}

} else {
	// フォームからサブミットされた時の処理

	// セッションからユーザ情報を取得
	$user = $_SESSION['USER'];
	$user_id=$user['user_id'];

	$app_name = $_POST['app_name'];
	$app_id = $_POST['app_id'];
	$app_password = $_POST['app_password'];

	//データベースに接続する
	$pdo = connectDb();

	// 入力チェックを行う。
	$err = array();

	// [名前]未入力チェック
	if (!$app_name) {
		$err['app_name'] = '名前を入力して下さい。';
	}

	// [マスターパスワード]未入力チェック
	if(!$app_id){
		$err['app_id'] = 'IDを入力して下さい。';
	}

	// [パスワード]未入力チェック
	if(!$app_password){
		$err['app_password'] = 'パスワードを入力して下さい。';
	}

	if(!$app_name){
		$err['app_name'] = 'アプリケーション名を入力して下さい。';
	}elseif(checkAppName($app_name, $user_id, $pdo)) {
		$sql="update id_pass set app_id=:app_id, app_password=:app_password where user_id=:user_id and app_name=:app_name";

		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(":app_id"=>$app_id, ":app_password"=>$app_password, ":user_id"=>$user_id, ":app_name"=>$app_name));

		unset($_SESSION['app_name']);

		header('Location: '.SITE_URL.'list.php');
		exit;
	}



	// もし$err配列に何もエラーメッセージが保存されていなかったら
	if (empty($err)) {
		//アプリケーション名、APP ID、APP Password初回登録

		$sql="select * from id_pass where user_id=:user_id";
		$user_id=$user['user_id'];

		$stmt = $pdo->prepare($sql);

		$stmt->bindValue(':user_id', $user_id);
		$stmt->execute();
		$result=$stmt->rowCount();

		$app_number=$result+1;

		$sql = "insert into id_pass
          (user_id, app_number, app_name, app_id, app_password,created_at, updated_at)
            values
            (:user_id,:app_number, :app_name, :app_id, :app_password, now(), now())";

		$stmt = $pdo->prepare($sql);
		
		$stmt->execute(array(':user_id'=>$user_id,':app_number'=>$app_number,':app_name'=>$app_name,':app_id'=>$app_id,':app_password'=>$app_password));

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

     <script type="text/javascript">
		function RunConfirm( ) {
			if ( confirm("実行しますか？") ) {
			location.href='http://localhost/PassNote/save_idpass.php';
			return true;
			}
			else {
			return false;
			}
		}
	</script>
  </head>

<body>
	<div class="sidebar">
		<h1 class="main_signup">PASSNOTE</h1>
		<ul class="sidebar_list list-unstyled nav nav-pills nav-stacked">
			<li><a href="list.php">IDパスワード一覧</a></li>
			<li><a href="change_status.php">マスター設定</a></li>
			<li><a href="logout.php">ログアウト</a></li>
		</ul>
	</div>

	<div class="main_contents">
		<h1 class="main_signup">IDパスワード登録画面</h1>
		<form method="post" class="form-horizontal" onSubmit="return RunConfirm();">
			<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label" for="formGroupInputLarge">アプリケーション名</label>
				<div class="col-sm-6">
					<input class="form-control" type="text" id="formGroupInputLarge" placeholder="アプリケーション名" name="app_name" value="<?php echo($app_info['app_name']);?>">
				</div>
			</div>
			<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label" for="formGroupInputLarge">アプリケーションID</label>
				<div class="col-sm-6">
					<input class="form-control" type="text" id="formGroupInputLarge" placeholder="アプリケーションID" name="app_id" value="<?php echo($app_info['app_id']);?>">
				</div>
			</div>
			<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label" for="formGroupInputLarge">アプリケーションパスワード</label>
				<div class="col-sm-6">
					<input class="form-control" type="text" id="formGroupInputLarge" placeholder="アプリケーションパスワード" name="app_password" value="<?php echo($app_info['app_password']);?>">
				</div>
			</div>
			<div class="form-group col-sm-6 register">
				<input class="btn btn-success btn-block btn-lg" type="submit" value="アプリケーションIDパスワード登録">
			</div>
		</form>
	</div>

</body>