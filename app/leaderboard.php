<?php

require_once("config.php");
require_once("db.php");

// @TODO: TOP 10

$topic_id = $_GET["topic"];

$topic = db_fetch("SELECT name FROM topics WHERE id = ?", array($topic_id), True);
echo "Topic Name: " . $topic["name"] . "<br /><br />";

$top_videos = db_fetch("SELECT * FROM videos WHERE topic_id = ? ORDER BY votes DESC LIMIT 25", array($topic_id));

echo("<b>Leaderboard</b>");
foreach ($top_videos as $key => $video) {
	echo("<br />");
	echo "<pre>"; print_r($video); echo "<pre>";
	//echo("http://www.youtube.com/watch?v=" . $top_videos[$key]["youtube_id"] . " " . $top_videos[$key]["count"] . " " . $top_videos[$key]["name"]);
}

?>
