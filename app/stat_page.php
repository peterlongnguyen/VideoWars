<?php

require_once("config.php");
require_once("db.php");

//$video_id = $_GET["video_id"];
$video_id = 1;

// video stat page
$wins = db_fetch("SELECT COUNT(votes.win_video_id) AS wins, votes.win_video_id, videos.name, videos.youtube_id FROM votes JOIN videos ON votes.win_video_id = videos.id JOIN views ON votes.win_video_id = views.video_id WHERE views.video_id = ?", array($video_id));
$losses = db_fetch("SELECT COUNT(votes.lose_video_id) AS losses, votes.lose_video_id, videos.name, videos.youtube_id FROM votes JOIN videos ON votes.lose_video_id = videos.id JOIN views ON votes.lose_video_id = views.video_id WHERE views.video_id = ?", array($video_id));


echo("<b>Video Stat Page for video: </b>" . $video_id);
echo("<br />");
echo("<br />");

echo("<b>Wins for: </b>" . $video_id);
foreach ($wins as $key => $value) {
	echo("<br />");
	echo "<pre>"; print_r($wins[$key]); echo "<pre>";
}

echo("<b>Losses for: </b>" . $video_id);
foreach ($losses as $key => $value) {
	echo("<br />");
	echo "<pre>"; print_r($losses[$key]); echo "<pre>";
}

// video battle history
$wins = db_fetch("SELECT votes.win_video_id, votes.lose_video_id, votes.timestamp, videos.youtube_id FROM votes JOIN videos ON votes.lose_video_id = videos.id  WHERE votes.win_video_id = ?", array($video_id));
$losses = db_fetch("SELECT votes.win_video_id, votes.lose_video_id, votes.timestamp, videos.youtube_id FROM votes JOIN videos ON votes.win_video_id = videos.id  WHERE votes.lose_video_id = ?", array($video_id));
$merged = array_merge($wins, $losses);

$sorted = array();
foreach ($merged as $key => $value) {
    $sorted[$key] = $value['timestamp'];
}
array_multisort($sorted, SORT_DESC, $merged);

echo("<b>Battle Wins for video: </b>" . $video_id);
foreach ($merged as $key => $value) {
	echo("<br />");
	echo "<pre>"; print_r($merged[$key]); echo "<pre>";
}

?>