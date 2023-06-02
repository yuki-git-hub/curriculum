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
    //[question.php]から送られてきた名前の変数、選択した回答、問題の答えの変数を作成 
    $name = $_POST["name"]; 
    $choice1 = $_POST["ネットワークのポート番号は何番？"]; 
    $choice2 = $_POST["Webページを作成するための言語は？"]; 
    $choice3 = $_POST["MySQLで情報を取得するためのコマンドは？"]; 
    $answer1 = $_POST["q1_answer"]; 
    $answer2 = $_POST["q2_answer"]; 
    $answer3 = $_POST["q3_answer"];

    //選択した回答と正解が一致していれば「正解！」、一致していなければ「残念・・・」と出力される処理を組んだ関数を作成する 
    function check($choice, $answer) { 
      if ($choice == $answer) { echo "正解！"; } 
      else { echo "残念・・・"; }
      } 
    ?> 

        <p><?php echo $name; ?>さんの結果は・・・？</p> 

        <p>①の答え</p> 
        <!--作成した関数を呼び出して結果を表示--> 
        <?php check($choice1, $answer1); ?>

        <p>②の答え</p> 
        <!--作成した関数を呼び出して結果を表示--> 
        <?php check($choice2, $answer2); ?>

        <p>③の答え</p> 
        <!--作成した関数を呼び出して結果を表示--> 
        <?php check($choice3, $answer3); ?>
        
  </div>
  </div>
</body>
</html>