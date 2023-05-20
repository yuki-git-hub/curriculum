<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FizzBuzz問題</title>
</head>
<body>
    <?php
for ($i = 1; $i <= 100; $i++) {
  if ($i % 3 === 0 && $i % 5 === 0) {
    echo "FizzBuzz!! ";
    echo '<br>';
  } elseif ($i % 3 === 0) {
    echo "Fizz! ";
    echo '<br>';
  } elseif ($i % 5 === 0) {
    echo "Buzz! ";
    echo '<br>';
  } else {
    echo $i . " ";
    echo '<br>';

  }
}
?>
</body>
</html>