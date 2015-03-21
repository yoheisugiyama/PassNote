<?php
require_once('config.php');
require_once('functions.php');

session_start();

// ログインチェック
if (!isset($_SESSION['USER'])) {
	header('Location: '.SITE_URL.'index.php');
	exit;
}

	$pdo = connectDb();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

	// セッションからユーザ情報を取得
	$user = $_SESSION['USER'];

	$user_id = $user['user_id'];
	$name = $user['name'];

	$app_info = array();

	$sql = "select * from id_pass where user_id = :user_id order by created_at desc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(":user_id" => $user_id));
	foreach ($stmt->fetchAll() as $row) {
		array_push($app_info, $row);
	}


	unset($pdo);

}elseif(isset($_POST['modify'])){

	$_SESSION['app_name']=$_POST['modify'];
	header('Location: '.SITE_URL.'save_idpass.php');



}elseif(isset($_POST['delete'])){
	
	$user = $_SESSION['USER'];
	$user_id = $user['user_id'];
	$app_name=$_POST['delete'];

	
	$sql = "delete from id_pass where user_id = :user_id and app_name=:app_name";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(":user_id"=> $user_id, ":app_name" => $app_name));

	unset($pdo);

	header('Location: '.SITE_URL.'list.php');
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
			<li><a href="save_idpass.php">IDパスワード登録</a></li>
			<li><a href="change_status.php">マスター設定</a></li>
			<li><a href="logout.php">ログアウト</a></li>
		</ul>
	</div>

	<div class="main_contents">
		<h1 class="main_signup"><strong><?php echo h($name);?></strong>のマイページ</h1>		
		<h1 class="main_signup">一覧表示画面</h1>

		<br><br>		
	
		<table class="table table-striped">
		  <form method="post">
			<tr>
				<th>アプリ名</th>
				<th>ID</th>
				<th>パスワード</th>
				<th>変更</th>
				<th>削除</th>
			</tr>

		<?php foreach ($app_info as $row): ?>
	        <tr>
	      	  <td><?php echo h($row['app_name']); ?></td>
	      	  <td><?php echo h($row['app_id']); ?></td>
	      	  <td><?php echo h($row['app_password']); ?></td>
	      	  <td><button class="btn btn-default" type="submit" name="modify" value="<?php echo h($row['app_name']); ?>">変更</button></td>
	      	  <td><button class="btn btn-default" type="submit" name="delete" value="<?php echo h($row['app_name']); ?>">削除</button></td>
	        </tr>
	    <?php endforeach; ?>
	   	 </form>
		</table>
		
	</div>
</body>