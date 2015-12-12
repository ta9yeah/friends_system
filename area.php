<?php
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
		<title>FRIEND SYSTEM</title>
	</head>
	<body>
		<table>
			<tr><td>ID</td><td>PREFECTURE</td></tr>
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
				//var_dump($rec);
				echo '<tr><td>'.$rec['id'].'</td>';
				echo '<td><a href="friend_page.php?area_id='.$rec["id"].'">'.$rec['prefecture'].'</a></td></tr>';
			}
			$dbh = null;
		?>
		</table>
	</body>

</html>







