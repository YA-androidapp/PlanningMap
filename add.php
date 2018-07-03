<?php
// Copyright (c) 2018 YA-androidapp(https://github.com/YA-androidapp) All rights reserved.
header('Content-Type: text/javascript; name="add.js"');
error_reporting(0);
$pw = filter_input(INPUT_POST, 'pw');
require('auth.php');
if( !is_string($pw) || (md5($pw) != $PASSWORD) ){
  die('不正な引数です。\'];');
}

$name = filter_input(INPUT_POST, 'name');
$lat  = filter_input(INPUT_POST, 'lat');
$lng = filter_input(INPUT_POST, 'lng');
$type = filter_input(INPUT_POST, 'type');
$type = (is_string($type)&&ctype_digit($type))?$type:0;
if( !is_string($name) || !is_numeric($lat) || !is_numeric($lng) ){
  die('不正な引数です。\'];');
}

$name = mysql_escape_string($name);
?>
<?php
require('db_init.php');

$sql = "insert into places(name, lat, lng, type) values( ? , ? , ? , ? )";
$stmt = $db->prepare($sql);
$stmt->bindValue(1,        $name, SQLITE3_TEXT);
$stmt->bindValue(2, (float)$lat , SQLITE3_FLOAT);
$stmt->bindValue(3, (float)$lng , SQLITE3_FLOAT);
$stmt->bindValue(4, (int)  $type, SQLITE3_INTEGER);
$result = $stmt->execute();
if (!$result) {
  $db->close();
  die('\'クエリーが失敗しました。'.$sqliteerror.'\'];');
} else {
  $sql = "select distinct id from places where name = ? and lat = ? and lng = ? and type= ?";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(1,        $name, SQLITE3_TEXT);
  $stmt->bindValue(2, (float)$lat , SQLITE3_FLOAT);
  $stmt->bindValue(3, (float)$lng , SQLITE3_FLOAT);
  $stmt->bindValue(4, (int)  $type, SQLITE3_INTEGER);
  $result = $stmt->execute();
  $dat = $result->fetchArray();

  $id = $dat[0];
  echo json_encode(
    array(
      $id,
      $name,
      $lat,
      $lng,
      $type
      ),
    JSON_UNESCAPED_UNICODE
    );
}

// 切断
$db->close();
