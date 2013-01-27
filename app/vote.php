<?php

if (array_key_exists("win", $_GET) && is_numeric($_GET["win"])) {
    $video_id_win = $_GET["win"];
} else {
    die("Invalid winner.");
}

if (array_key_exists("lose", $_GET) && is_numeric($_GET["lose"])) {
    $video_id_win = $_GET["lose"];
} else {
    die("Invalid loser.");
}

if (array_key_exists("topic", $_GET) && is_numeric($_GET["topic"])) {
    $video_id_win = $_GET["topic"];
} else {
    die("Invalid topic id.");
}

?>
