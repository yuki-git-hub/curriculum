<?php
// 商品の税込価格を計算しましょう
// 税率を定数TAXで作成しましょう。消費税は10%とします。
define("TAX",0.1);
// 商品の情報を連想配列に入れましょう。
$products = [
    "鉛筆" => 100,
    "消しゴム" => 150,
    "物差し" => 500
];
// 税込価格を計算する関数を用意します。
// 引数には値段を受け取り、税込価格を返却します。
function calculateTax($price){
    $taxPrice = $price +($price * TAX);
    return $taxPrice;    
}
// 繰り返し文を使って商品ごとの税込価格を表示しましょう！
foreach($products as $productName => $price){
    $taxPrice = calculateTax($price);
    echo "{$productName}の税込み価格は{$taxPrice}円です。<br>";
}
?>