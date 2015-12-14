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
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>FRIEND PAGE</title>
	</head>
	<body>
	<?php
		$sql = 'SELECT * FROM `area_table` WHERE `id` = '.$select_id;
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		//var_dump($stmt);

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		echo '<h2>';
		echo $rec['prefecture'];
		echo 'の友達</h2>';

	// INSERT frend =========================


	// frend echo=========================

		$sql2 = 'SELECT * FROM `friend_table` WHERE `prefecture_id` = '.$rec['id'];
		$stmt2 = $dbh->prepare($sql2);
		$stmt2->execute();

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

					echo '<button><a href="edit.php?friend_id='.$rec2["id"].'">編集</a></button>';
					echo '<button><a href="delete.php?friend_id='.$rec2["id"].'">削除<a></button>';
					echo '<br>';
			}

		echo '<button><a href="add.php?prefecture_id='.$rec["id"].'">友達を追加する</a></button><br>';
		echo '<button><a href="area.php">戻る</a></button>';
		$dbh = null;
	?>
	</body>
</html>

