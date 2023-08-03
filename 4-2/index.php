<?php

// pdo.phpを読み込む
require_once("pdo.php");

// getData.phpを読み込む
require_once("getData.php");

// getDataクラスのインスタンスを作成
$getData = new getData();

// ユーザ情報と記事情報を取得
$user_data = $getData->getUserData();
$post_data = $getData->getPostData();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>記事一覧ページ</title>
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>
<main>    
<header class="header">
    <h1 class="header__logo">
      <img src="images/1599315827_logo.png" alt="Y&I group.inc" class="header__logo-image">
    </h1>
    <div class="header__user">
      <p class="header__user-name">ようこそ<?php echo $user_data['first_name'] . ' ' . $user_data['last_name']; ?>さん。</p>
      <p class="header__last-login">最終ログイン日:<?php echo $user_data['last_login']; ?></p>
    </div>
  </header>
  
  <section class="section1">
    <table width="100%" bgcolor="e0ffff">
        <tr>
            <th bgcolor="#87ceeb">記事ID</th>
            <th bgcolor="#87ceeb">タイトル</th>
            <th bgcolor="#87ceeb">カテゴリ</th>
            <th bgcolor="#87ceeb">本文</th>
            <th bgcolor="#87ceeb">投稿日</th>
        </tr>

        <?php
        // 記事情報をループで表示
        foreach ($post_data as $post) {
            echo '<tr>';
            echo '<td>' . $post['id'] . '</td>';
            echo '<td>' . $post['title'] . '</td>';
            echo '<td>' . $post['category'] . '</td>';
            echo '<td>' . $post['comment'] . '</td>';
            echo '<td>' . $post['created'] . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
  </section>
  
  <footer class="footer">
    <p>Y&I group.inc</p>
  </footer>
    </main>  
</body>

</html>