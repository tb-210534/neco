<?php
// ドライバ呼び出しを使用して MySQL データベースに接続します
	$dsn = 't';//データソース名またはDSN(mysql:host=[データベースサーバーのホスト名]:dbname=[データベース名]の形式で記述。)
	$user = 'データベース';//データベースのユーザー名
	$password = 'ぱすわーど';//ユーザーのパスワード
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = "CREATE TABLE IF NOT EXISTS media1"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "fname TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , "
	. "extension TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ," 
	. "raw_data LONGBLOB NOT NULL "
	.");";
	$stmt = $pdo->query($sql);


 $sql ='SHOW CREATE TABLE media1';
 $result = $pdo -> query($sql);
 foreach ($result as $row){
  echo $row[1];
 }
 echo "<hr>";


?>

