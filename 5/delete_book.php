<?php
// db_connect.phpをインクルード
include "db_connect.php";

// db_connect関数を呼び出して、$pdoに代入
$pdo = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたIDを取得
    $bookId = $_POST["book_id"];

    // 削除のSQLを実行
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id");
    $stmt->bindParam(":id", $bookId, PDO::PARAM_INT);
    $stmt->execute();

    // 削除したら、一覧ページにリダイレクト
    header("Location: book_inventory.php");
    exit;
}
?>