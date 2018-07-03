<?php
// Copyright (c) 2018 YA-androidapp(https://github.com/YA-androidapp) All rights reserved.
try {
  $db = new SQLite3('places.db');

  $sql = "create table if not exists places (id integer primary key autoincrement, name text, lat real, lng real, type integer)";
  $result = $db->query($sql);
  if (!$result) {
    $db->close();
    die('クエリーが失敗しました。'.$sqliteerror.'\'];');
  }
} catch (Exception $e) {
  print 'DBへの接続でエラーが発生しました。\'];');
  print $e->getTraceAsString();
  $db->close();
  die();
}