<?php
// db_connect.phpの読み込み
require_once("db_connect.php");

// function.phpの読み込み
require_once("function.php");

// ログインしていなければ、login.phpにリダイレクト
check_user_logged_in();

// 提出ボタンが押された場合
if (isset($_POST["post"])) {
    // titleとcontentの入力チェック
    if (empty($_POST["title"])) {
        echo 'タイトルが未入力です。';
    } elseif (empty($_POST["content"])) {
        echo 'コンテンツが未入力です。';
    } else {
        // 入力したtitleとcontentを格納
        $title = $_POST["title"];
        $content = $_POST["content"];

        // PDOのインスタンスを取得
        $pdo = db_connect();

        try {
            // SQL文の準備
            $sql = "INSERT INTO posts (title, content, time) VALUES (:title, :content, NOW())";

            // プリペアドステートメントの準備
            $stmt = $pdo->prepare($sql);

            // パラメータをバインド
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);

            // 実行
            $stmt->execute();

            // main.phpにリダイレクト
            header("Location: main.php");
            exit();
        } catch (PDOException $e) {
            // エラーメッセージの出力
            echo "エラー: " . $e->getMessage();
            // 終了
            die();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>記事登録</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
    <h1>記事登録</h1>
    <form method="POST" action="">
        title:<br>
        <input type="text" name="title" id="title" style="width:200px;height:50px;">
        <br>
        content:<br>
        <input type="text" name="content" id="content" style="width:200px;height:100px;"><br>
        <input type="submit" value="submit" id="post" name="post">
    </form>
</body>
</html>
