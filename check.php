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
		<meta charset="UTF-8">
		<title>nexseed-form02</title>
	</head>
	<body>
		<h2>入力内容：</h2>
	<?php
		$firstname  = htmlspecialchars($_POST['firstname']);
		$id         = htmlspecialchars($_POST['prefecture_no']);
		$sex        = htmlspecialchars($_POST['sex']);
		$age        = htmlspecialchars($_POST['age']);

		$works      = htmlspecialchars($_POST['each_works']);
		if ($works == 'edit'){
			$friend_id = htmlspecialchars($_POST['friend_id']);
		}

		$empty      = $firstname == '' || $id == '' || $age == '';
		// 入力値の確認
		if ($empty){
			echo '<h3 style="color: red;">入力を確認してください。</h3>';
		}else{
			echo '<h3>こちらでお間違いないですか？</h3>';
		}

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
		if ($empty){
			echo '<form method="post" action="">';
			echo '<input type="button" onclick="history.back()" value="back">';
			echo '</form>';
		}else{
			echo '<form method="post" action="thanks.php">';
			echo '<input type="button" onclick="history.back()" value="back">';
			echo '<input type="submit" value="'.$works.'...">';

			// hide values
			echo '<input name="firstname" type="hidden" value="'.$firstname.'">';
			echo '<input name="prefecture_no" type="hidden" value="'.$id.'">';
			echo '<input name="sex" type="hidden" value="'.$sex.'">';
			echo '<input name="age" type="hidden" value="'.$age.'">';
			if ($works == 'edit'){
				echo '<input name="friend_id" type="hidden" value="'.$friend_id.'">';
			}
			echo '<input name="each_works" type="hidden" value="'.$works.'">';

			echo '</form>';
		}
	?>
	</body>
<html>
<?php
	$dbh = null;