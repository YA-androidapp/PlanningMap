<?php
// Copyright (c) 2018 YA-androidapp(https://github.com/YA-androidapp) All rights reserved.
header('Content-Type: text/javascript; name="remove.js"');
error_reporting(0);
$pw = filter_input(INPUT_POST, 'pw');
require('auth.php');
if( !is_string($pw) || (md5($pw) != $PASSWORD) ){
  die('不正な引数です。\'];');
}

$id = filter_input(INPUT_POST, 'id');
if( !is_numeric($id) ){
  die('不正な引数です。\'];');
}
?>
var points = [
<?php
require('db_init.php');

$sql = "delete from places where id = ?";
$stmt = $db->prepare($sql);
$stmt->bindValue(1, (int)  $id, SQLITE3_INTEGER);
$result = $stmt->execute();
if (!$result) {
  $db->close();
  die('\'クエリーが失敗しました。'.$sqliteerror.'\'];');
} else {
  echo json_encode(
    array(
      $id
      ),
    JSON_UNESCAPED_UNICODE
    ).",\n";
}

// 切断
$db->close();
?>
];
