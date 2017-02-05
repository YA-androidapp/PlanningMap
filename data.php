<?php
// Copyright (c) 2017 YA-androidapp(https://github.com/YA-androidapp) All rights reserved.
header('Content-Type: text/javascript; name="data.js"');
error_reporting(0);
?>
var points = [
<?php
try {
  $db = new SQLite3('places.db');
} catch (Exception $e) {
  print 'DBへの接続でエラーが発生しました。<br>';
  print $e->getTraceAsString();
}

$sql = "create table if not exists places (id int, name text, lat real, lng real, type integer)";
$result = $db->query($sql);
if (!$result) {
  $db->close();
  die('クエリーが失敗しました。'.$sqliteerror);
}

$sql = 'insert into places(name, lat, lng, type) values("東京タワー", 35.658581, 139.745433, 0)';
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
