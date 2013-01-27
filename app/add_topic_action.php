<?php

require_once("config.php");
require_once("db.php");
require_once("yt_data_api.php");

/*
if (array_key_exists("keyword", $_GET) && $_GET["keyword"]) { $keyword = $_GET["keyword"]; } else { $keyword = ""; }
if (array_key_exists("category", $_GET) && $_GET["category"]) { $category = $_GET["category"]; } else { $category_id = 0; }
if (array_key_exists("skips", $_GET) && $_GET["skips"]) { $allow_skips = $_GET["skips"]; } else { $allow_skips = 1; }
if (array_key_exists("additions", $_GET) && $_GET["additions"]) { $allow_additions = $_GET["additions"]; } else {$allow_additions = 1; }
if (array_key_exists("leaderboard", $_GET) && $_GET["leaderboard"]) { $allow_leaderboard = $_GET["leaderboard"]; } else { $allow_leaderboard = 1; }
if (array_key_exists("visibility", $_GET) && $_GET["visibility"]) { $visibility = $_GET["visibility"]; } else { $visibility = 1; }
if (array_key_exists("url", $_GET) && $_GET["url"]) { $youtube_url = $_GET["url"]; } else { $youtube_url = ""; }
*/

$keyword = $_GET["keyword"];
$name = $_GET["name"];
$category = $_GET["category"];
$allow_skips = $_GET["skips"];
$allow_additions = $_GET["additions"];
$allow_leaderboard = $_GET["leaderboard"];
$visibility = $_GET["visibility"];
$youtube_url = $_GET["url"];
if (!$name) $name = $keyword;

if ($keyword) {
    echo "keyword";
    $videos = yt_keyword($keyword);
} elseif (preg_match("/playlist/", $youtube_url)) {
    $videos = yt_playlist($youtube_url);
} elseif (preg_match("/user/", $youtube_url)) {
    $videos = yt_channel($youtube_url);
} else {
    die("Invalid URL");
}

// Insert new topic
$topic_args = array($name, $category, $allow_skips, $allow_additions, $allow_leaderboard, $visibility);
$test = db_insert("INSERT INTO topics (name, category_id, allow_skips, allow_additions, allow_leaderboard, visibility) VALUES (?, ?, ?, ?, ?, ?)", $topic_args, True);
$new_topic = db_fetch("SELECT id FROM topics WHERE name = ? ORDER BY created DESC LIMIT 1", array($name), True);

if ($videos) {
    foreach ($videos as $video) {
        $db_args = array($video["id"], $new_topic["id"], $video["title"]);
        db_insert("INSERT INTO videos (youtube_id, topic_id, name) VALUES (?, ?, ?);", $db_args);
    }

    header("Location: index.php?topic=" . $new_topic["id"]);
} else {
    die("No results.");
}


?>
