<?php
//データベース接続
$posted_at = date('Y/m/d H:i:s');
try{
// ドライバ呼び出しを使用して MySQL データベースに接続します
	$dsn = 't';//データソース名またはDSN(mysql:host=[データベースサーバーのホスト名]:dbname=[データベース名]の形式で記述。)
	$user = 'ゆ';//データベースのユーザー名
	$password = 'ぱ';//ユーザーのパスワード
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
}

catch(PDOException $e){
 echo "Error:{$e->getMessage()}";
 die();
}
$name = filter_input(INPUT_POST, 'name');//入力したnameが妥当であるか調べる（エラー回避）。  
$comment = filter_input(INPUT_POST, 'comment');//（エラー回避）  
$editNO = filter_input(INPUT_POST, 'editNO');//（エラー回避）
$edit =filter_input(INPUT_POST, 'edit');//（エラー回避）
$id = filter_input(INPUT_POST, 'id');

//編集
if (isset($name)&&isset($comment)) {//nameもcommentもかきこまれたら 
	if(!empty($editNO)){
	$id = filter_input(INPUT_POST, 'id');
	$id = $editNO; //変更する投稿番号
	$sql = "UPDATE media2 SET fname = :fname,extension = :extension,raw_data = :raw_data,created_time = :created_time,password = :password WHERE id = :id ";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':password', $password, PDO::PARAM_STR);
	$stmt->bindParam(":fname", $name, PDO::PARAM_STR);
	$stmt->bindParam(":extension", $comment, PDO::PARAM_STR);
	$stmt->bindParam(":raw_data", $password, PDO::PARAM_STR);
	$stmt->bindParam(':created_time', $password, PDO::PARAM_STR);
	$name = $_POST['input_name'];
	$comment = $_POST['input_comment'];
	$pass = $_POST['input_pass'];
            $stmt -> execute();
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	}//if
}//if

//削除
$delno = filter_input(INPUT_POST, 'deleteNo');//入力したdeleteoNoが妥当であるか調べる（エラー回避） 
$sakuzyo=filter_input(INPUT_POST, 'delete');//（エラー回避）
$id = $delno;
if (!empty($delno)&&isset($sakuzyo)) {//もし削除番号が入力されて削除ボタンが押されたら 


$sql = 'SELECT * FROM media2';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
		foreach ($results as $row){		
			echo "削除しました";
			$sql = 'delete from media2 where id=:id';
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
 		}//forezch
}//if	

?>
<!DOCTYPE html> 
<html lang="ja"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>掲示板</title> 
</head> 
<body> 
<form action="kannri.php" method="post"> 
<input type="text" name="name" placeholder="名前" value="<?php if(isset($editname)) {echo $editname;} ?>"><br> 
<input type="text" name="comment" placeholder="コメント" value="<?php if(isset($editcomment)) {echo $editcomment;} ?>"><br> 
<input type="hidden" name="editNO" value="<?php if(isset($editnumber)) {echo $editnumber;} ?>"> 
<input type="submit" name="submit" value="送信"> 
</form> 
<br /> 
<form action="kannri.php" method="POST"> 
<input type="text" name="deleteNo"placeholder="削除対象番号" size="10"> <br>
<input type="submit" name="delete" value="削除"> 
</form> 
<br /> 
<form action="kannri.php" method="POST"><br /> 
<input type="text" name="edit"placeholder="編集対象番号"size="10" > <br>
<input type="submit"  name="s_edit"value="編集"> 
</form> 
<br /> 
</body>
</html>
<!DOCTYPE HTML>

<html lang="ja">
<head>
    <meta charset="utf-8">

        <title>Upload</title>
    </head>

    <body>
<h1>Upload</h1>
<p><form action="kannri.php" method="post" enctype="multipart/form-data">
        <table border=0>
            <tr>
                <td>name：</td>
                <td><input type="text" name="input_name"></td>
            </tr>
            <tr>
                <td>comment：</td>
                <td><textarea class="textbox_comment", name="input_comment", cols="30", rows="5"></textarea></td>
            </tr>
            <tr>
                <td>pass：</td>
                <td><input type="password" name="input_pass"></td>
            </tr>
            <tr>
                <td>photo:</td>
                <td><input type="file" name="upfile"></td>
 <br>

            </tr>
            <tr>
                <td>削除：</td>
                <td><input type="text" name="deleteNo"placeholder="削除対象番号" size="10"> <br></td>
		<td><input type="submit" name="delete" value="削除"> </td>

            </tr>
            <tr>
                <td>編集：</td>
                <td><input type="text" name="edit"placeholder="編集対象番号"size="10" ></td>
		<td><input type="submit"  name="s_edit"value="編集"> </td>
            </tr>

        </table>

        <br>
        <button name="action" value="click_user_regisration">Done</button>
<a href="Main.php">back</a>
    </form>


    </form>



</body>
</html>