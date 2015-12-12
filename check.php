<?php
	//friend_table sellect
	$dsn = 'mysql:dbname=friends_system;host=localhost';
	$user = 'root';
	// $password = 'mysql';
	$password = '';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES utf8');
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta content-equive="Content-type" content="text/html; charset=UTF-8">
		<title>nexseed-form02</title>
	</head>
	<body>
		<h2>入力内容：</h2>
	<?php
		$firstname  = htmlspecialchars($_POST['firstname']);
		$id         = htmlspecialchars($_POST['prefecture_no']);
		$sex        = htmlspecialchars($_POST['sex']);
		$age        = htmlspecialchars($_POST['age']);

		// 入力値の確認
		if($firstname == '') {
			echo '名前が入力されていません<br>';
		}else{
			echo '名前：　'.$firstname.'<br>';
		}
		if($id == '') {
			echo '出身地が選択されていません<br>';
		}else{
			// echo '出身地：　'.$id.'<br>';
			$sql = 'SELECT * FROM `area_table` WHERE `id` ='.$id;
			$stmt = $dbh->prepare($sql);
			$stmt->execute();

			$rec = $stmt->fetch(PDO::FETCH_ASSOC);

			echo '出身地：　';
			echo $rec['prefecture'].'<br>';
		}
		if($sex == '') {
			echo '性別が選択されていません<br>';
		}else{
			if ($sex == 'F'){
				echo '性別：　女性<br>';
			}else{
				echo '性別：　男性<br>';
			}
		}
		if($age == '') {
			echo '年齢が入力されていません<br>';
		}else{
			echo '年齢：　'.$age.'歳<br>';
		}

		//　入力した値が全て　”true”　の時にだけ　ＯＫボタンを表示
		if ($firstname == '' || $id == '' || $age == ''){
			echo '<form method="post" action="">';
			echo '<input type="button" onclick="history.back()" value="back">';
			echo '</form>';
		}else{
			if (isset($_POST) && !empty($_POST)) {

				echo '<form method="post" action="friend_add.php">';
				echo '<input type="button" onclick="history.back()" value="back">';
				echo '<input type="button" type="submit">';
				echo '</form>';

				$sql_2 = 'INSERT INTO `friends_system`.`friend_table`(`prefecture_id`, `firstname`, `sex`, `age`) VALUES ("'.$id.'","'.$firstname.'","'.$sex .'","'.$age.'")';
				$stmt_2 = $dbh->prepare($sql_2);
			}
		}
	?>

	</body>
<html>
