<?php
    // 現在の日付を取得
    date_default_timezone_set('Asia/Tokyo');    
    $date = date('Y-m-d H:i:s');

//②フォームからのデータを受け取ります
    $my_name = $_POST['my_name'];
    $number = $_POST['number'];

//③受け取った数字に1~6までのランダムな数字を掛け合わせて
    $randomNumber = mt_rand(1, 6);

//変数に入れてください
    $result = $number * $randomNumber;

//④掛け合わせた数字の結果によっておみくじを選び、変数に入れます
    if ($result >= 1 && $result <= 10) {
      $fortune = '凶';
    } elseif ($result >= 11 && $result <= 15) {
      $fortune = '小吉';
    } elseif ($result >= 16 && $result <= 20) {
      $fortune = '中吉';
    } elseif ($result >= 21 && $result <= 25) {
      $fortune = '吉';
    } elseif ($result >= 26 && $result <= 36) {
      $fortune = '大吉';
    } else {
      $fortune = '残念';
    }
?>
<!-- //⑤今日の日付と、名前、番号、おみくじ結果を表示しましょう-->
<p><?php echo $date; ?></p>
<p>名前は<?php echo $my_name; ?>です。</p>
<p>番号は<?php echo  $result; ?>です。</p>
<p>結果は<?php echo  $fortune; ?>です。</p>