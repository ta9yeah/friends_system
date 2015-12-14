<?php
	//friend_table sellect 接続
 	$dsn = 'mysql:dbname=friends_system;host=localhost';
	$user = 'root';
	// $password = 'mysql';
	$password = '';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES utf8');
?>

<!DOCTYPE html>
<html lang='ja'>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
	<?php
		// $id            = htmlspecialchars($_POST['id']);
		$firstname     = htmlspecialchars($_POST['firstname']);
		$prefecture_no = htmlspecialchars($_POST['prefecture_no']);
		$sex           = htmlspecialchars($_POST['sex']);
		$age           = htmlspecialchars($_POST['age']);

		$works         = htmlspecialchars($_POST['each_works']);

		if($works == 'add') {
			$sql = 'INSERT INTO `friend_table`(`prefecture_id`, `firstname`, `sex`, `age`) VALUES ("'.$prefecture_no.'","'.$firstname.'","'.$sex.'","'.$age.'")'; // [ `` ]で囲む
			// var_dump($sql);
			$stmt = $dbh->prepare($sql);
			// INSERT文の実行
			$stmt->execute();
			echo '<p>追加されました。</p>';
			echo '<button><a href="friend_page.php?area_id='.$prefecture_no.'">back</a></button>';

		}elseif($works == 'delete') {
			$friend_id = htmlspecialchars($_POST['friend_id']);
			$sql = 'DELETE FROM `friend_table` WHERE id ='.$friend_id;
			$stmt = $dbh->prepare($sql);
			// INSERT文の実行
			$stmt->execute();
			echo '<p>削除されました。</p>';
			echo '<button><a href="friend_page.php?area_id='.$prefecture_no.'">back</a></button>';

		}elseif($works == 'edit') {
			$friend_id  = htmlspecialchars($_POST['friend_id']);
			$sql = 'UPDATE `friends_system`.`friend_table` SET `prefecture_id` = "'.$prefecture_no.'", `firstname` = "'.$firstname.'", `sex` = "'.$sex .'", `age` = "'.$age .'" WHERE `friend_table`.`id` ='.$friend_id;

			$stmt = $dbh->prepare($sql);
			// INSERT文の実行
			$stmt->execute();
			echo '<p>編集されました。</p>';
			echo '<button><a href="friend_page.php?area_id='.$prefecture_no.'">back</a></button>';

		}else{
			echo '<p>作業に失敗しました</p>';
			echo '<a href="area.php">都道府県に戻る</a>';
		}
	?>
	</body>
</html>
<?php
// データベースからの切断
$dbh = null;