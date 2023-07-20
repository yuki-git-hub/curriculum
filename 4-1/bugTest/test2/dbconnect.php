<?php
// セッションが開始されていなければ開始する
if (!isset($_SESSION)) {
    session_start();
  }
// DBサーバのURL
$db['host'] = "localhost";
// ユーザー名
$db['user'] = "root";
// ユーザー名のパスワード
$db['pass'] = "study";
// データベース名
$db['dbname'] = "yigroupBlog";
