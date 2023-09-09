<?php
// main.php

// function.php ファイルを読み込む
require_once("function.php");

// db_connect.php ファイルを読み込む
require_once("db_connect.php");

// セッションをチェックする関数を呼び出す
check_user_logged_in();

// データベース接続
$pdo = db_connect();

try {
    // SQL文の準備
    $sql = "SELECT * FROM posts ORDER BY id DESC";

    // プリペアドステートメントの作成
    $stmt = $pdo->prepare($sql);

    // 実行
    $stmt->execute();

    // データの取得
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // エラーメッセージの出力
    echo "エラー: " . $e->getMessage();
    // 終了
    die();
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>メイン</title>
</head>

<body>
    <h1>メインページ</h1>
    <p>ようこそ<?php echo $_SESSION["user_name"]; ?>さん</p>
    <a href="logout.php">ログアウト</a><br />
    <a href="create_post.php">記事投稿！</a><br />
    <h2>投稿一覧</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>タイトル</th>
            <th>本文</th>
            <th>投稿日</th>
            <th></th>
            <th></th>
            <th></th>            
            <!-- 他のカラムのヘッダーを追加 -->
        </tr>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <td><?php echo $post["id"]; ?></td>
                <td><?php echo $post["title"]; ?></td>
                <td><?php echo $post["content"]; ?></td>
                <td><?php echo $post["time"]; ?></td>
                <td><a href="detail_post.php?id=<?php echo $post['id']; ?>">詳細</a></td>
                <td><a href="edit_post.php?id=<?php echo $post['id']; ?>">編集</a></td>
                <td><a href="delete_post.php?id=<?php echo $post['id']; ?>">削除</a></td>                             
                <!-- 他のカラムの表示を追加 -->
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>