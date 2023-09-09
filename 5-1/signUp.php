<?php
// データベースに接続するための情報
$host = "localhost";
$user = "root";
$pass = "study";
$dbname = "yigroupblog";

// データベースに接続
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

// フォームから送られてきたデータを受け取る
if (isset($_POST["name"])) { // nameキーが存在する場合
  $name = $_POST["name"];
} else { // nameキーが存在しない場合
  $name = ""; // 空文字を代入
}
if (isset($_POST["password"])) { // passwordキーが存在する場合
  $password = $_POST["password"];
} else { // passwordキーが存在しない場合
  $password = ""; // 空文字を代入
}
// バリデーション（入力チェック）
$error = false; // エラーがあるかどうかのフラグ
if ($name == "") { // 名前が空の場合
  echo "名前を入力してください。<br>";
  $error = true; // エラーがあることを記録
}
if ($password == "") { // パスワードが空の場合
  echo "パスワードを入力してください。<br>";
  $error = true; // エラーがあることを記録
}

// エラーがない場合
if (!$error) {
  // パスワードをハッシュ化する（平文で保存しない）
  $password_hash = password_hash($password, PASSWORD_DEFAULT);

  // データベースにデータを保存するSQL文を準備
  $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";

  // SQL文を実行する準備
  $stmt = $pdo->prepare($sql);

  // パラメータに値を割り当てる
  $stmt->bindValue(":name", $name, PDO::PARAM_STR);
  $stmt->bindValue(":password", $password_hash, PDO::PARAM_STR);

  // SQL文を実行
  $stmt->execute();

  // 登録完了メッセージを表示
  echo "登録が完了しました。";
}
?>

<!DOCTYPE html>
<html>

<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
  <h1>新規登録</h1>
  <form method="POST" action="">
    user:<br>
    <input type="text" name="name" id="name">
    <br>
    password:<br>
    <input type="password" name="password" id="password"><br>
    <input type="submit" value="submit" id="signUp" name="signUp">
  </form>
</body>

</html>