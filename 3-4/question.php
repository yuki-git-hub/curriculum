<!DOCTYPE html> 
<html lang="ja"> 
  <head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>2章チェックテスト</title>
    <!-- reset.css modern-css-reset -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/modern-css-reset/dist/reset.min.css"
    />   
    <link rel="stylesheet" href="css/style.css"> 
</head>
 <body>
 <div class="container">
    <div class="container-inner">
  <?php 
    //POST送信で送られてきた名前を受け取って変数を作成
    $name = $_POST["name"];

    //①以下を参考に問題文の選択肢の配列を作成してください。 
    $choices = [ "ネットワークのポート番号は何番？" => ["80", "22", "20", "21"], "Webページを作成するための言語は？" => ["PHP", "Python", "JAVA", "HTML"], "MySQLで情報を取得するためのコマンドは？" => ["Join", "select", "insert", "update"] ];

    //② ①で作成した、配列から正解の選択肢の変数を作成してください 
    $answers = [ "ネットワークのポート番号は何番？" => "80", "Webページを作成するための言語は？" => "HTML", "MySQLで情報を取得するためのコマンドは？" => "select" ]; 
  ?> 
 
  <p>お疲れ様です<?php echo $name; ?>さん</p> 

  <!--フォームの作成 通信はPOST通信で--> 
    <form action="answer.php" method="post">
      
      <h2>①ネットワークのポート番号は何番？</h2> 
      <!--③ 問題のradioボタンを「foreach」を使って作成する--> 
      <?php foreach ($choices["ネットワークのポート番号は何番？"] as $option): ?> 
        <label> <input type="radio" name="ネットワークのポート番号は何番？" value="<?php echo $option; ?>"> <?php echo $option; ?> </label> 
      <?php endforeach; ?>

      <h2>②Webページを作成するための言語は？</h2> 
      <!--③ 問題のradioボタンを「foreach」を使って作成する--> 
      <?php foreach ($choices["Webページを作成するための言語は？"] as $option): ?> 
        <label> <input type="radio" name="Webページを作成するための言語は？" value="<?php echo $option; ?>"> <?php echo $option; ?> </label> 
      <?php endforeach; ?>

      <h2>③MySQLで情報を取得するためのコマンドは？</h2> 
      <!--③ 問題のradioボタンを「foreach」を使って作成する--> 
      <?php foreach ($choices["MySQLで情報を取得するためのコマンドは？"] as $option): ?> 
        <label> <input type="radio" name="MySQLで情報を取得するためのコマンドは？" value="<?php echo $option; ?>"> <?php echo $option; ?> </label>
      <?php endforeach; ?>

      <!--問題の正解の変数と名前の変数を[answer.php]に送る--> 
      <input type="hidden" name="name" value="<?php echo $name; ?>"> 
      <input type="hidden" name="q1_answer" value="<?php echo $answers["ネットワークのポート番号は何番？"]; ?>"> 
      <input type="hidden" name="q2_answer" value="<?php echo $answers["Webページを作成するための言語は？"]; ?>"> 
      <input type="hidden" name="q3_answer" value="<?php echo $answers["MySQLで情報を取得するためのコマンドは？"]; ?>"> 

      <p><input type="submit" value="回答する"></p> 

    </form>
  </div>
  </div>  
</body>
</html>