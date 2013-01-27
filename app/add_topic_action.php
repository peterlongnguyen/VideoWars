<?php

require_once("config.php");
require_once("db.php");

$keyword = $_GET["keyword"];
//echo "Keywords: " . $keyword;
//echo "<br /><br />";

$url = "https://www.googleapis.com/youtube/v3/search?part=id%2Csnippet&maxResults=50&q=" . urlencode($keyword) . "&key=" . API_KEY;
//echo $url;
//echo "<br /><br />";

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$results = curl_exec($ch); 
curl_close($ch); 

$category_id = 0;
$allow_skips = 1;
$allow_additions = 1;
$allow_leaderboard = 1;
$visibility = 1;

$topic_args = array($keyword, $category_id, $allow_skips, $allow_additions, $allow_leaderboard, $visibility);
db_insert("INSERT INTO topics (name, category_id, allow_skips, allow_additions, allow_leaderboard, visibility) VALUES (?, ?, ?, ?, ?, ?)", $topic_args, True);
$new_topic = db_fetch("SELECT id FROM topics WHERE name = ? ORDER BY created DESC LIMIT 1", array($keyword), True);

if ($results) {
    $videos = json_decode($results);
    foreach ($videos->items as $video) {
        $db_args = array($video->id->videoId, $new_topic["id"], $video->snippet->title);
        db_insert("INSERT INTO videos (youtube_id, topic_id, name) VALUES (?, ?, ?);", $db_args);
    }

    header("Location: index.php?topic=" . $new_topic["id"]);
} else {
    die("No results.");
}


?>
