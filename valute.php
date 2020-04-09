<?php
$result = MySQLi_query($link, "select * from valute;");
$current_valute = MySQLi_fetch_assoc($result);
$usdtoday = round($current_valute['today'], 2);
$eurtoday = round($current_valute['eurtoday'], 2);
$usdyestoday = $current_valute['yestoday'];
$euryestoday = $current_valute['euryestoday'];
$dinamicUSD = round($usdtoday - $usdyestoday, 2);
$dinamicEUR = round($eurtoday - $euryestoday, 2);
if($dinamicUSD > 0 OR $dinamicEUR > 0) {
    $dinamicUSD = "+<span class='font-weight-bold' style='color: #1e7e34;'>{$dinamicUSD}</span>";
    $dinamicEUR = "+<span class='font-weight-bold' style='color: #1e7e34;'>{$dinamicEUR}</span>";
}
elseif($dinamicUSD > 0 OR $dinamicEUR > 0){
    $dinamicUSD = "-<span class='font-weight-bold' style='color: #a71d2a;'>{$dinamicUSD}</span>";
    $dinamicEUR = "-<span class='font-weight-bold' style='color: #a71d2a;'>{$dinamicEUR}</span>";
}

echo "<span><img src=\"/img/dollar.svg\" width='24px'/> Доллар: {$usdtoday} ({$dinamicUSD}) ₽</span></br>";
echo "<span><img src=\"/img/euro.svg\" width='24px'/> Евро: {$eurtoday} ({$dinamicEUR}) ₽</span></br>";
?>