<?php

require_once("config.php");
require_once("db.php");

// @TODO: TOP 10

$top_videos = db_fetch("SELECT COUNT(votes.win_video_id) AS total_votes, votes.win_video_id, videos.name, videos.youtube_id FROM votes JOIN videos ON votes.win_video_id = videos.id GROUP BY votes.win_video_id LIMIT 25");

echo("<b>Leaderboard</b>");
foreach ($top_videos as $key => $value) {
	echo("<br />");
	echo "<pre>"; print_r($top_videos[$key]); echo "<pre>";
	//echo("http://www.youtube.com/watch?v=" . $top_videos[$key]["youtube_id"] . " " . $top_videos[$key]["count"] . " " . $top_videos[$key]["name"]);
}

?>