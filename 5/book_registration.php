<?php
// db_connect.phpをインクルード
include "db_connect.php";

// db_connect関数を呼び出して、$pdoに代入
$pdo = db_connect();

require_once('function.php');
check_user_logged_in();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 値を取得
  $title = $_POST["title"];
  $date = $_POST["date"];
  $stock = $_POST["stock"];

  $stmt = $pdo->prepare("INSERT INTO books (title, date, stock) VALUES (:title, :date, :stock)");

  $stmt->bindParam(":title", $title);
  $stmt->bindParam(":date", $date);
  $stmt->bindParam(":stock", $stock);
  // SQLを実行
  $stmt->execute();

  // メッセージを表示
  echo "<p>本の登録が完了しました。</p>";

  // リダイレクトさせたい
  header("Location: book_inventory.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="jan">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>本登録</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<div class="container w-50">
  <h1 class='text-center display-6 mt-5'>本登録</h1>
  <form method="POST" action="" id="registrationForm">
    <input class="form-control mt-3" type="text" name="title" id="title" placeholder="タイトル">
    <span id="titleError" class="text-danger"></span>
    <input class="form-control mt-3" type="text" name="date" id="date" placeholder="発売日">
    <span id="dateError" class="text-danger"></span>
    <p class='mt-3'>在庫数:</p>
    <select class='form-select' name='stock' id='stock'>
      <option value=''>選択してください</option>
      <?php
      for ($i = 1; $i <= 10; $i++) {
        echo "<option value='$i'>$i</option>";
      }
      ?>
    </select>
    <span id="stockError" class="text-danger"></span>
    <input type="submit" value="登録" class="btn btn-primary form-control mt-3">
  </form>
  <a class="btn btn-primary form-control mt-3" href="book_inventory.php">本の在庫一覧へ戻る</a>
</div>
  <script>
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
      var title = document.getElementById("title").value;
      var date = document.getElementById("date").value;
      var stock = document.getElementById("stock").value;
      var hasError = false;

      // タイトルのバリデーション
      if (title === "" || title.length > 100) {
        document.getElementById("titleError").textContent = "100文字以内で入力してください。";
        hasError = true;
      } else {
        document.getElementById("titleError").textContent = "";
      }

      // 発売日のバリデーション
      var datePattern = /^(?:\d{4}\/\d{2}\/\d{2}|\d{6}|\d{8})$/;
      if (date === "" || !datePattern.test(date)) {
        document.getElementById("dateError").textContent = "発売日を8桁の数字で入力してください。";
        hasError = true;
      } else {
        document.getElementById("dateError").textContent = "";
      }

      // 在庫数のバリデーション
      if (stock === "" || isNaN(stock) || stock <= 0) {
        document.getElementById("stockError").textContent = "冊数を入力してください。";
        hasError = true;
      } else {
        document.getElementById("stockError").textContent = "";
      }

      if (hasError) {
        event.preventDefault(); // フォームの送信を防ぐ
      }
    });
  </script>
</body>

</html>