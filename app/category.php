<?php

require_once("config.php");
require_once("db.php");

if (array_key_exists("id", $_GET) && is_numeric($_GET["id"])) {
    $category_id = $_GET["id"];
} else {
    die("Invalid category.");
}

$topics = db_fetch("SELECT id FROM topics WHERE category_id = ?", array($category_id));
$topic_key = array_rand($topics);

header("Location: index.php?topic=" . $topics[$topic_key]["id"]);
?>
