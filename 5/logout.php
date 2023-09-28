<?php
// セッション開始
session_start();
// セッション変数のクリアする
$_SESSION = array();
// セッションクリアする
session_destroy();
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<div class="container w-50">    
    <h1 class='text-center display-6 mt-5'>ログアウト画面</h1>
<div class="row mt-3">
    <p class='text-center p-5'>ログアウトしました</p>
    <a class="btn btn-primary mx-auto" href="login.php">ログイン画面に戻る</a>
</div>
</div>    
</body>

</html>