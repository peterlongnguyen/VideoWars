<?php

require_once("config.php");
require_once("db.php");

$video_id = $_GET["video_id"];
//$video_id = 1;

// video stat page
$video = db_fetch("SELECT * FROM videos WHERE id = ?", array($video_id), True);
echo "<pre>"; print_r($video); echo "<pre>";

$wins = db_fetch("SELECT COUNT(*) AS wins FROM votes WHERE win_video_id = ?", array($video_id), True);
$losses = db_fetch("SELECT COUNT(*) AS losses FROM votes WHERE lose_video_id = ?", array($video_id), True);


echo("<b>Video Stat Page for video: </b>" . $video_id);
echo("<br />");
echo("<br />");

echo "Wins: " . $wins["wins"];
echo "<br />";

echo "Losses: " . $losses["losses"];
echo "<br />";

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
