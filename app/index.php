<?php

require_once("config.php");
require_once("db.php");

echo "Home Page<br /><br />";
    
$topics = db_fetch("SELECT COUNT(topics.id) AS count, topics.id, topics.name FROM topics JOIN videos ON videos.topic_id = topics.id GROUP BY topics.id");
foreach ($topics as $key => $topic) {
    if ($topic["count"] <= CONFIG_MIN_VIDEO_COUNT) unset($topics[$key]);
}
$topic_key = array_rand($topics);
$random_topic = $topics[$topic_key];
$topic_id = $random_topic["id"];

echo "Topic:";
echo "<pre>"; print_r($random_topic); echo "</pre>";

$videos = db_fetch("SELECT * FROM videos WHERE topic_id = ?", array($topic_id));
$video_keys = array_rand($videos, 2);
$video_id_1 = $videos[$video_keys[0]];
$video_id_2 = $videos[$video_keys[1]];

echo "Videos:";
echo "<pre>"; print_r($video_id_1); echo "</pre>";
echo "<pre>"; print_r($video_id_2); echo "</pre>";


?>
