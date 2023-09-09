<?php
// function.php

/**
 * $_SESSION["user_name"]が空だった場合、ログインページにリダイレクトする
 * @return void
 */
function check_user_logged_in()
{
    // セッション開始
    session_start();
    // セッションにuser_nameの値がなければlogin.phpにリダイレクト
    if (empty($_SESSION["user_name"])) {
        header("Location: login.php");
        exit;
    }
}

/**
 * 引数で与えられたidでpostsテーブルを検索する
 * もし対象のレコードがなければnullを返す
 * @param integer $id
 * @return array|null
 */
function find_post_by_id($id) {
    // PDOのインスタンスを生成
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
        // 結果が1行取得できたら
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // エラーを投げる
        throw new Exception('Error: ' . $e->getMessage());
    }
}
/**
 * post_idが空の場合、main.phpにリダイレクトする
 * @param int $post_id
 * @return void
 */
function redirect_main_unless_parameter($post_id)
{
    if (empty($post_id)) {
        header("Location: main.php");
        exit;
    }
}
