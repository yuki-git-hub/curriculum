<?php

//user_nameが空だった場合、ログインページにリダイレクトする
function check_user_logged_in()
{
    // セッション開始
    session_start();
    // user_nameがなければlogin.phpにリダイレクト
    if (empty($_SESSION["user_name"])) {
        header("Location: login.php");
        exit;
    }
}

function find_post_by_id($id) {
    // PDOのインスタンスを生成
    $pdo = db_connect();
    try {
        // SQL文の準備
        $sql = "SELECT * FROM posts WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // 実行
        $stmt->execute();
        // 結果が1行取得できたら
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // エラー
        throw new Exception('Error: ' . $e->getMessage());
    }
}

//post_idが空の場合、main.phpにリダイレクトさせる
function redirect_main_unless_parameter($post_id)
{
    if (empty($post_id)) {
        header("Location: book_inventory.php");
        exit;
    }
}
