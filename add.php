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
		<title>友達入力フォーム</title>
		<!-- form style -->
		<style type="text/css">
			*{ margin: 0; padding: 0;}
			p{ padding-top: 16px;}
		</style>
	</head>
	<body>
		<div>
			<h2>友達入力フォーム</h2>
			<form method="post" action="check.php">
				<p>お名前：</p>
				<input name="firstname" type="text" style="width: 100px;">
				<p>出身地：</p>
				<select name="prefecture_no">
					<option value="">-</option>
					<?php
						//SELECT
						$sql = 'SELECT * FROM `area_table` WHERE 1';
						$stmt = $dbh->prepare($sql);
						$stmt->execute();

						$prefecture_no = $_GET['prefecture_id'];

						// while
						while(1) {
							$rec = $stmt->fetch(PDO::FETCH_ASSOC);
							if ($rec == false) {
								break;
							}
							if($rec['id'] == $prefecture_no){
								echo '<option value="'.$rec['id'].'" selected>';
							}else{
								echo '<option value="'.$rec['id'].'">';
							}
							echo $rec['prefecture'];
							echo '</option>'; 
							// !!!!! Fetch する事で　id も同時に引っ張れる !!!!!
						}
					?>
				</select>
				<!-- '<input name="nickname" type="hidden" value="'.$nickName.'">' -->
				<p>性別：</p>
				<select name="sex">
					<option value="F">女性</option>
					<option value="M">男性</option>
				</select>
				<p>年齢：</p>
				<input name="age" type="text" style="width: 100px;"><br>
				<input name="each_works" type="hidden" value="add">
				<input type="submit" value="送信">
				
			</form>
 		</div>
	</body>
</html>
<?php
	$dbh = null;
?>