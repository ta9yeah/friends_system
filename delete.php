<?php
	//friend_table sellect 接続
 	$dsn = 'mysql:dbname=friends_system;host=localhost';
	$user = 'root';
	// $password = 'mysql';
	$password = '';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES utf8');

	$friend_id = $_GET['friend_id'];
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>友達削除</title>
		<!-- form style -->
		<style type="text/css">
			*{ margin: 0; padding: 0;}
			p{ padding-top: 16px;}
		</style>
	</head>
	<body>
		<h2>本当に削除しますか？</h2>
		<?php
			$sql2 = 'SELECT * FROM `friend_table` WHERE `id` = '.$friend_id ;
			$stmt2 = $dbh->prepare($sql2);
			$stmt2->execute();

				while(1){
					$rec2 = $stmt2->fetch(PDO::FETCH_ASSOC);

					if($rec2 == false) {
						break;
					}
						$sql = 'SELECT * FROM `area_table` WHERE `id` = '.$rec2['prefecture_id'] ;
						$stmt = $dbh->prepare($sql);
						$stmt->execute();

						$rec = $stmt->fetch(PDO::FETCH_ASSOC);

						echo '<h3>'.$rec['prefecture'].'の友達</h3>';

						echo $rec2['firstname'];

						if ($rec2['sex'] == 'F'){
							echo ' 女性 ';
						}else{
							echo ' 男性 ';
						}
						echo ' 年齢 : '.$rec2['age'].' 歳';
						echo '<br>';

						echo '<form method="post" action="thanks.php">';

						echo '<input type="button" onclick="history.back()" value="戻る">';
						echo '<input type="submit" value="削除">';

						echo '<input name="friend_id" type="hidden" value="'.$friend_id.'">';
						echo '<input name="firstname" type="hidden" value="'.$rec2['firstname'].'">';
						echo '<input name="prefecture_no" type="hidden" value="'.$rec2['prefecture_id'].'">';
						echo '<input name="sex" type="hidden" value="'.$rec2['sex'].'">';
						echo '<input name="age" type="hidden" value="'.$rec2['age'].'">';


						echo '<input name="each_works" type="hidden" value="delete">';
						
						echo '</form>';
				}				
		?>
	</body>
</html>
<?php
	$dbh = null;