<?php
// db_connect.phpの読み込み
require_once("db_connect.php");

// function.phpの読み込み
require_once("function.php");

// ログインしていなければ、login.phpにリダイレクト
check_user_logged_in();

// URLの?以降で渡されるIDをキャッチ
$id = $_GET['id'];

redirect_main_unless_parameter($id);

// PDOのインスタンスを取得
$pdo = db_connect();

try {
    // SQL文の準備
    $sql = "SELECT * FROM posts WHERE id = :id";

    // プリペアドステートメントの作成
    $stmt = $pdo->prepare($sql);

    // idのバインド
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // 実行
    $stmt->execute();

    // データの取得
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // 結果が1行取得できたら
    if ($row) {
        $id = $row['id'];
        $title = $row['title'];
        $content = $row['content'];
    } else {
        // 対象のidでレコードがない => 不正な画面遷移
        echo "対象のデータがありません。";
        exit; // 処理を中断
    }

    // コメント一覧の取得
    $sql_comments = "SELECT * FROM comments WHERE post_id = :post_id";
    $stmt_comments = $pdo->prepare($sql_comments);
    $stmt_comments->bindParam(':post_id', $id, PDO::PARAM_INT);
    $stmt_comments->execute();
    $comments = $stmt_comments->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // エラーメッセージの出力
    echo 'Error: ' . $e->getMessage();
    // 終了
    die();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>記事詳細</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <table>
        <tr>
            <td>ID</td>
            <td><?php echo $id; ?></td>
        </tr>
        <tr>
            <td>タイトル</td>
            <td><?php echo $title; ?></td>
        </tr>
        <tr>
            <td>本文</td>
            <td><?php echo $content; ?></td>
        </tr>
    </table>
    <a href="create_comment.php?post_id=<?php echo $id ?>">この記事にコメントする</a><br />
    <a href="main.php">メインページに戻る</a>
    <h2>コメント一覧</h2>
    <?php foreach ($comments as $comment) : ?>
        <div>
            <hr>
            <strong><?php echo $comment['name']; ?>:</strong>
            <?php echo $comment['content']; ?>
        </div>
    <?php endforeach; ?>

</body>

</html>