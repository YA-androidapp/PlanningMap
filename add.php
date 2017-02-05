<?php
// Copyright (c) 2017 YA-androidapp(https://github.com/YA-androidapp) All rights reserved.
header('Content-Type: text/javascript; name="add.js"');

$pw = filter_input(INPUT_POST, 'pw');
require('auth.php');
if( !is_string($pw) || ($pw != $PASSWORD) ){
  die('不正な引数です。');
}

$name = filter_input(INPUT_POST, 'name');
$lat  = filter_input(INPUT_POST, 'lat');
$lng = filter_input(INPUT_POST, 'lng');
$type = filter_input(INPUT_POST, 'type');
$type = (is_string($type)&&ctype_digit($type))?$type:0;
/*
echo $name;
echo $lat;
echo $lng;
echo $type;
*/

if( !is_string($name) || !is_numeric($lat) || !is_numeric($lng) ){
  die('不正な引数です。');
}
?>
var points = [
<?php
try {
  $db = new SQLite3('places.db');
} catch (Exception $e) {
  print 'DBへの接続でエラーが発生しました。<br>';
  print $e->getTraceAsString();
  $db->close();
  die();
}

$sql = "create table if not exists places (id int, name text, lat real, lng real, type integer)";
$result = $db->query($sql);
if (!$result) {
  $db->close();
  die('クエリーが失敗しました。'.$sqliteerror);
}

$sql = 'insert into places(name, lat, lng, type) values("'.$name.'", '.$lat.', '.$lng.', '.$type.')';
$result = $db->query($sql);
if (!$result) {
  $db->close();
  die('クエリーが失敗しました。'.$sqliteerror);
}

$sql = "SELECT * FROM places";
$results = $db->query($sql);
if (!$results) {
  $db->close();
  die('クエリーが失敗しました。'.$sqliteerror);
}
while ($row = $results->fetchArray()) {
  echo ' ["'.$row['name'].'",'.$row['lat'].', '.$row['lng'].',0],';
}

// 切断
$db->close();
?>
];
