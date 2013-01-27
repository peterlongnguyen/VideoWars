<?php

require_once("config.php");
require_once("db.php");
    
$topics = db_fetch("SELECT COUNT(topics.id) AS count, topics.id, topics.name FROM topics JOIN videos ON videos.topic_id = topics.id GROUP BY topics.id");
foreach ($topics as $key => $topic) {
    if ($topic["count"] <= CONFIG_MIN_VIDEO_COUNT) unset($topics[$key]);
}
$topic_key = array_rand($topics);
$random_topic = $topics[$topic_key];
$topic_id = $random_topic["id"];

// echo "Topic:";
// echo "<pre>"; print_r($random_topic); echo "</pre>";

$videos = db_fetch("SELECT * FROM videos WHERE topic_id = ?", array($topic_id));
$video_keys = array_rand($videos, 2);
$video_id_1 = $videos[$video_keys[0]];
$video_id_2 = $videos[$video_keys[1]];

$battle_vids = Array(0 => $video_id_1, 1 => $video_id_2);


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>title</title>
<link rel="stylesheet" type="text/css" href="http://reset5.googlecode.com/hg/reset.min.css">
<link href="http://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/assets/css/screen.css">
</head>
<body>
<header>
  <h1><a href="/">Video Wars</a></h1>
</header>
<div id="battle">
  <nav id="browse">
  <ul>
    <li><a href="#">Category</a></li>
    <li><a href="#">Category</a></li>
    <li><a href="#">Category</a></li>
    <li><a href="#">Category</a></li>
    <li><a href="#">Category</a></li>
    <li><a href="#">Category</a></li>
    <li><a href="#">More...</a></li>
  </ul>
  <form class="search" action="">
    <input type="search" placeholder="kittens" />
  </form>
</nav>
<?php
for ($i = 0; $i < count($battle_vids); $i++) {
  $battle_vids[$i];
?>
  <article>
    <div class="video">
      <iframe width="400" height="300" src="http://www.youtube.com/embed/<?php echo $battle_vids[$i]['youtube_id']; ?>" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="vote"><button>vote!</button></div>
    <ul class="actions">
      <li><button>share!</button></li>
      <li><button>flag!</button></li>
      <li><a href="#">permalink</a></li>
    </ul>
  </article>
<?php
}
?>


</div><footer>
  hi i'm a footer.
</footer><script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script>
</script>
</body>
</html>
