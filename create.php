<?php

// POSTの場合も必ず最初にチェック！！
// var_dump($_POST);
// exit();

// キー名に送信元ファイルのname属性を指定する．

$bookTitle = $_POST['bookTitle'];

$label01 = $_POST['label01'];
$label01_point = $_POST['label01_point'];

$label02 = $_POST['label02'];
$label02_point = $_POST['label02_point'];

$label03 = $_POST['label03'];
$label03_point = $_POST['label03_point'];

$label04 = $_POST['label04'];
$label04_point = $_POST['label04_point'];

$label05 = $_POST['label05'];
$label05_point = $_POST['label05_point'];


$write_data = "{$bookTitle} {$label01} {$label01_point} {$label02} {$label02_point} {$label03} {$label03_point} {$label04} {$label04_point} {$label05} {$label05_point}\n";


$file = fopen('data/data.csv', 'a');
flock($file, LOCK_EX);
fwrite($file,$write_data);
flock($file, LOCK_UN);
fclose($file);

header("Location:read.php");
exit();

?>
