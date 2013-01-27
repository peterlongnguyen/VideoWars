<?php

require_once("config.php");
require_once("db.php");

echo "Home Page<br /><br />";

if (array_key_exists("topic", $_GET) && is_numeric($_GET["topic"])) {
    //Topic id has been set
    $topic_id = $_GET["topic"];
    $topic = db_fetch("SELECT id, name FROM topics WHERE id = ?", array($topic_id), True);

} else {

    //Chose random topic
    $topics = db_fetch("SELECT COUNT(topics.id) AS count, topics.id, topics.name FROM topics JOIN videos ON videos.topic_id = topics.id GROUP BY topics.id");
    foreach ($topics as $key => $topic) {
        if ($topic["count"] <= CONFIG_MIN_VIDEO_COUNT) unset($topics[$key]);
    }
    $topic_key = array_rand($topics);
    $topic = $topics[$topic_key];
}

echo "Topic:";
echo "<pre>"; print_r($topic); echo "</pre>";

$videos = db_fetch("SELECT * FROM videos WHERE topic_id = ?", array($topic["id"]));
$video_keys = array_rand($videos, 2);
$video_1 = $videos[$video_keys[0]];
$video_2 = $videos[$video_keys[1]];

echo "Videos:";
echo "<pre>"; print_r($video_1); echo "</pre>";
echo "<pre>"; print_r($video_2); echo "</pre>";

echo "<a href='vote.php?win=" . $video_1["id"] . "&lose=" . $video_2["id"] . "&topic=" . $topic["id"] . "'>Vote (" . $video_1["name"] . ")</a><br />";
echo "<a href='vote.php?win=" . $video_2["id"] . "&lose=" . $video_1["id"] . "&topic=" . $topic["id"] . "'>Vote (" . $video_2["name"] . ")</a><br />";

if (array_key_exists("topic", $_GET) && is_numeric($_GET["topic"])) {
    $topics = db_fetch("SELECT COUNT(topics.id) AS count, topics.id, topics.name FROM topics JOIN videos ON videos.topic_id = topics.id GROUP BY topics.id");
    foreach ($topics as $key => $topic) {
        if ($topic["count"] <= CONFIG_MIN_VIDEO_COUNT) unset($topics[$key]);
        if ($topic["id"] == $topic_id) unset($topics[$key]);
    }
} else {
    unset($topics[$topic_key]);
}
echo "<br />";
echo "Random Topics:<br />";
foreach ($topics as $topic) {
    echo "<a href='?topic=" . $topic["id"] . "'>" . $topic["name"] . "</a><br />";
}
?>
