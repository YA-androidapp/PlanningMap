<?php
// Copyright (c) 2017 YA-androidapp(https://github.com/YA-androidapp) All rights reserved.
header('Content-Type: text/javascript; name="data.js"');
//error_reporting(0);
?>
var points = [
<?php
try {
  $db = new SQLite3('places.db');
} catch (Exception $e) {
  print 'DBへの接続でエラーが発生しました。<br>';
  print $e->getTraceAsString();
}

$sql = "create table if not exists places (id integer primary key autoincrement, name text, lat real, lng real, type integer)";
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
  echo json_encode(
    array(
      $row['id'],
      $row['name'],
      $row['lat'],
      $row['lng'],
      $row['type']
      ),
    JSON_UNESCAPED_UNICODE
    ).",\n";
}

// 切断
$db->close();
?>
];
