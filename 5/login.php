<?php
require_once('db_connect.php');
// セッション開始
session_start();

// 初期化
$nameError = $passError = "";

// $_POSTが空ではない場合
if (!empty($_POST)) {
    // ログイン名が入力されていない場合
    if (empty($_POST["name"])) {
        $nameError = "名前が未入力です。";
    }
    // パスワードが入力されていない場合
    if (empty($_POST["pass"])) {
        $passError = "パスワードが未入力です。";
    }

    // 両方共入力されている場合
    if (!empty($_POST["name"]) && !empty($_POST["pass"])) {
        //ログイン名とパスワード
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
        $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES);
        // ログイン開始
        $pdo = db_connect();
        try {
            //ログイン名があるか
            $sql = "SELECT * FROM users WHERE name = :name";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            die();
        }

        // 結果が1行取得できたら
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // ハッシュ化
            // 入力された値と引っ張ってきた値が同じか
            if (password_verify($pass, $row['password'])) {

                $_SESSION["user_id"] = $row['id'];
                $_SESSION["user_name"] = $row['name'];
                // main.phpにリダイレクト
                header("Location: book_inventory.php");
                exit;
            } else {
                // パスワードが違ってた時
                $passError = "パスワードに誤りがあります。";
            }
        } else {
            //ログイン名がなかった時
            $nameError = "ユーザー名かパスワードに誤りがあります。";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="jan">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<div class="container w-50">
    <h1 class='text-center display-6 mt-5'>ログイン画面</h1>
    <form method="post" action="">
        <div class="row mb-3">
            <a class="btn btn-success" href="signUp.php">新規ユーザー登録</a>
            
            <p><input class="form-control mt-3" placeholder="名前" type="text" name="name" size="15"></p>
            <?php
            // エラーメッセージ
            if (!empty($nameError)) {
                echo "<div class='text-danger'>$nameError</div>";
            }
            ?>
            
            <p><input class="form-control mt-3" placeholder="パスワード" type="password" name="pass" size="15"></p>
            <?php
            // エラーメッセージ
            if (!empty($passError)) {
                echo "<div class='text-danger'>$passError</div>";
            }
            ?>

            <p><input class="btn btn-primary mt-3 form-control" type="submit" value="ログイン"></p>
        </div>
    </form>
</div>
</body>

</html>