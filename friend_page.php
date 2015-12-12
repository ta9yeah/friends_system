<?php
	//var_dump($_GET['area_id']);

	$select_id = $_GET['area_id'];

	// DB 接続
	$dsn = 'mysql:dbname=friends_system;host=localhost';
	$user = 'root';
	// $password = 'mysql';
	$password = '';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES utf8');

	$sql = 'SELECT * FROM `area_table` WHERE `id` = '.$select_id;
	$stmt = $dbh->prepare($sql);
	$stmt->execute();

	//var_dump($stmt);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);

	echo $rec['prefecture'];
	echo 'の友達';
	echo '<br>';

// INSERT frend =========================


// frend echo=========================

	$sql2 = 'SELECT * FROM `friend_table` WHERE `prefecture_id` = '.$rec['id'];
	$stmt2 = $dbh->prepare($sql2);
	$stmt2->execute();

	// var_dump($test1);
	if($rec2 = false) {
		echo '<p>友達はまだいません。</p>';
	}else{
		while(1){
			$rec2 = $stmt2->fetch(PDO::FETCH_ASSOC);
			if($rec2 == false) {
				break;
			}
			echo $rec2['firstname'];
			if ($rec2['sex'] == 'F'){
				echo ' 女性 ';
			}else{
				echo ' 男性 ';
			}
			echo ' 年齢 : '.$rec2['age'].' 歳';
			echo '<br>';
		}
	}
	echo '<button><a href="friend_add.php">友達を追加する</a></button><br>';
	echo '<button><a href="area.php">戻る</a></button>';
	$dbh = null;
?>