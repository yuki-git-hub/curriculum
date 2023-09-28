<?php
// データベースに接続するための情報
$host = "localhost";
$user = "root";
$pass = "study";
$dbname = "book_inventory";

// db_connect.php
require_once('db_connect.php');

// データベースに接続
$pdo = db_connect();

// 初期化
$name = "";
$password = "";
$nameError = "";
$passwordError = "";

// フォームから送られてきたデータを受け取る
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // バリデーション
  $error = false; // エラーがあるかどうか

  // ユーザー名のバリデーション
  if (isset($_POST["name"])) { 
    $name = $_POST["name"];
    if ($name == "") { // ユーザー名がない場合
      $nameError = "ユーザー名を入力してください。";
      $error = true; // エラーがあることを保存する
    }
  } else { // nameない場合
    $name = ""; // からの文字を代入
    $nameError = "ユーザー名を入力してください。";
    $error = true; // エラーがあることを保存する
  }

  // パスワードのバリデーション
  if (isset($_POST["password"])) { 
    $password = $_POST["password"];
    if ($password == "") { // パスワードがない場合
      $passwordError = "パスワードを入力してください。";
      $error = true; // エラーがあることを記録
    }
  } else { // パスワードがない場合
    $password = ""; // 空文字を代入
    $passwordError = "パスワードを入力してください。";
    $error = true; // エラーがあることを記録
  }

  // エラーがない場合
  if (!$error) {
    // パスワードをハッシュ化する
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // データベースにデータを保存する
    $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(":name", $name, PDO::PARAM_STR);
    $stmt->bindValue(":password", $password_hash, PDO::PARAM_STR);

    // SQLを実行
    $stmt->execute();

    // 登録完了メッセージ
    echo "登録が完了しました。";

    // リダイレクト
    header("Location: book_inventory.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container w-50">
    <h1 class='text-center display-6 mt-5'>新規ユーザー登録</h1>
    <form method="POST" action="">
      <div class="row mb-3">
        <div class="col">
          <input class="form-control mt-5" type="text" name="name" id="name" placeholder="ユーザー名" value="<?php echo $name; ?>">
          <div class="text-danger"><?php echo $nameError; ?></div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <input class="form-control mt-5" type="password" name="password" id="password" placeholder="パスワード">
          <div class="text-danger"><?php echo $passwordError; ?></div>
        </div>
      </div>
      <input class="btn btn-primary mt-5 form-control" type="submit" value="新規登録" id="signUp" name="signUp">
    </form>
  </div>
</body>

</html>