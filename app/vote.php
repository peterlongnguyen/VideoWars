<?php

require_once("config.php");
require_once("db.php");

if (array_key_exists("win", $_GET) && is_numeric($_GET["win"])) {
    $video_id_win = $_GET["win"];
} else {
    die("Invalid winner.");
}

if (array_key_exists("lose", $_GET) && is_numeric($_GET["lose"])) {
    $video_id_lose = $_GET["lose"];
} else {
    die("Invalid loser.");
}

if (array_key_exists("topic", $_GET) && is_numeric($_GET["topic"])) {
    $topic_id = $_GET["topic"];
} else {
    die("Invalid topic id.");
}

db_insert("INSERT INTO votes (win_video_id, lose_video_id) VALUES(?, ?)", array($video_id_win, $video_id_lose));

//echo $video_id_win . $video_id_lose . $topic_id;

header("Location: index.php?topic=" . $topic_id);
?>
