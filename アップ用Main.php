<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}
?>

<!doctype html>
<html>
    <head>
<link rel="stylesheet" href="Main17.css">
        <meta charset="UTF-8">
        <title>メイン</title>
    </head>
    <body>
<header>
    <h>Machi Neco</h>
</header>
 <br>
 <br>
<ul>
<li class="current"><a href="Main.php">Home</a></li>
<li><a href="newupload_top11.php">Upload</a></li>
<li><a href="#">How to use</a></li>
<li><a href="#">About</a></li>
<li><a href="Logout.php">Logout</a></li>
</ul>


        <h1>Hello<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>!!</h1> 


 <br>

    </body>
</html>

    <?php
    try{
	$dsn = 't';//データソース名またはDSN(mysql:host=[データベースサーバーのホスト名]:dbname=[データベース名]の形式で記述。)
	$user = 'データベース';//データベースのユーザー名
	$password = 'パス';//ユーザーのパスワード
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //DBから取得して表示する．
    $sql = "SELECT * FROM media2 ORDER BY id;";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
    echo $row['id'].', ';
    echo $row['name'].', ';
    echo $row['comment'].', ';
    echo $row['created_time'].'<br>';


        //動画と画像で場合分け
        $target = $row["fname"];
        if($row["extension"] == "mp4"){
            echo ("<video src=\"import1.php?target=$target\" width=\"426\" height=\"240\" controls></video>");
        }
        elseif($row["extension"] == "jpeg" || $row["extension"] == "png" || $row["extension"] == "gif"){
            echo ("<img src='import1.php?target=$target'>");
        }
        echo ("<br/><br/>");
    }
    }
    catch (PDOException $e) {
        echo("<p>500 Inertnal Server Error</p>");
        exit($e->getMessage());
    }

    ?>
