<?php

require_once("config.php");
require_once("db.php");

$video_id = $_GET["video_id"];

$incr_views = db_insert("UPDATE videos SET views = views + 1 WHERE id = ?", array($video_id));

?>