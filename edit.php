<?php
	// DBに接続
	$dsn = 'mysql:dbname=friends_system;host=localhost';
	$user = 'root';
	// $password = 'mysql';
	$password = '';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES utf8');
	// friend_id の取得
	$friend_id = $_GET['friend_id'];

	$sql_friend = 'SELECT * FROM `friend_table` WHERE `id` ='.$friend_id;
	$stmt_friend = $dbh->prepare($sql_friend);
	$stmt_friend->execute();

	$rec_friend = $stmt_friend->fetch(PDO::FETCH_ASSOC);

	$firstname  = $rec_friend['firstname'];
	$id         = $rec_friend['prefecture_id'];
	$sex        = $rec_friend['sex'];
	$age        = $rec_friend['age'];
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>編集フォーム</title>
		<!-- form style -->
		<style type="text/css">
			*{ margin: 0; padding: 0;}
			p{ padding-top: 16px;}
		</style>
	</head>
	<body>
		<div>
		<h2>友達編集フォーム</h2>
		<form method="post" action="check.php">
			<p>お名前：</p>
			<input name="firstname" placeholder="<?php echo $firstname; ?>">

			<p>出身地：</p>
			<select name="prefecture_no">
				<?php
					//SELECT
					$sql = 'SELECT * FROM `area_table` WHERE 1';
					$stmt = $dbh->prepare($sql);
					$stmt->execute();

					// while
					while(1) {
						$rec = $stmt->fetch(PDO::FETCH_ASSOC);
						if ($rec == false) {
							break;
						}

						if($rec['id'] == $id){
							echo '<option value="'.$rec['id'].'" selected>';
						}else{
							echo '<option value="'.$rec['id'].'">';
						}
						echo $rec['prefecture'];
						echo '</option>';
					}	
				?>
			</select>
			<p>性別：</p>
			<select name="sex">
				<?php
					if ($sex == 'F') {
						echo '<option value="F" selected>女性</option>';
						echo '<option value="M">男性</option>';
					}else{
						echo '<option value="F">女性</option>';
						echo '<option value="M" selected>男性</option>';
					}
				?>				
			</select>
			
			<p>年齢：</p>
			<input name="age" placeholder="<?php echo $age; ?>">
			<br>
			<input name="friend_id" type="hidden" value="<?php echo $friend_id;?>">
			<input name="each_works" type="hidden" value="edit">
			<input type="submit" value="送信">
		</form>

		</div>
	</body>
</html>
<?php
	$dbh = null;
?>