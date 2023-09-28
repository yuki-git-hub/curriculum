<?php

require_once('function.php');
check_user_logged_in();
require_once('db_connect.php');

// データベースから情報を取得
try {
    $pdo = db_connect();
    
    // books テーブルから取得する
    $sql = "SELECT * FROM books";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // 結果を取得する
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="jan">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>在庫一覧</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container w-50">    
    <h1 class='text-center display-6 mt-5'>本の在庫一覧</h1>
    <p class="text-center"><a class="btn btn-primary mt-5 me-5" href="book_registration.php">新規登録</a><a class="btn btn-secondary mt-5" href="logout.php">ログアウト</a> </p>      
    <?php
    $stmt = $pdo->query("SELECT * FROM books");
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($books) > 0) {
        echo "<table class='w-100 table'>";
        echo "<tr class='table-secondary'><th class='text-center'>タイトル</th><th class='text-center'>発売日</th><th class='text-center'>在庫数</th><th class='text-center'>操作</th></tr>";
        foreach ($books as $book) {
            echo "<tr class='border-top'>";
            echo "<td class='text-center align-middle'>" . htmlspecialchars($book['title']) . "</td>";
            echo "<td class='text-center align-middle'>" . htmlspecialchars($book['date']) . "</td>";
            echo "<td class='text-center align-middle'>" . htmlspecialchars($book['stock']) . "</td>";
            echo "<td class='text-center p-3'><form method='POST' action='delete_book.php'><input type='hidden' name='book_id' value='" . $book['id'] . "'><input class='btn btn-danger' type='submit' value='削除'></form></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "在庫がありません。";
    }
    ?>
    

</div>
</body>
</html>
