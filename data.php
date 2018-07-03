<?php
// Copyright (c) 2018 YA-androidapp(https://github.com/YA-androidapp) All rights reserved.
header('Content-Type: text/javascript; name="data.js"');
error_reporting(0);
?>
var points = [
<?php
require('db_init.php');

$sql = "SELECT * FROM places";
$results = $db->query($sql);
if (!$results) {
  $db->close();
  die('\'クエリーが失敗しました。'.$sqliteerror.'\'];');
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
