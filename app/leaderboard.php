<?php

require_once("config.php");
require_once("db.php");

// @TODO: TOP 10

$topic_id = $_GET["topic"];

$topic = db_fetch("SELECT name FROM topics WHERE id = ?", array($topic_id), True);

//$top_videos = db_fetch("SELECT * FROM videos WHERE topic_id = ? ORDER BY votes DESC LIMIT 25", array($topic_id));
$top_videos = db_fetch("SELECT COUNT(*) AS loses, videos.* FROM votes JOIN videos ON votes.lose_video_id = videos.id WHERE videos.topic_id = ? GROUP BY votes.lose_video_id;", array($topic_id));
//$losses = db_fetch("SELECT COUNT(*) AS losses FROM votes WHERE lose_video_id = ?", array($video_id), True);


echo("<b>Leaderboard</b>");
foreach ($top_videos as $key => $video) {
  echo("<br />");
  echo "<pre>"; print_r($video); echo "</pre>";
  //echo("http://www.youtube.com/watch?v=" . $top_videos[$key]["youtube_id"] . " " . $top_videos[$key]["count"] . " " . $top_videos[$key]["name"]);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>VIDEO WARS</title>
<link rel="stylesheet" type="text/css" href="http://reset5.googlecode.com/hg/reset.min.css">
<link href="http://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/assets/css/screen.css">
<link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.min.css">

</head>
<body>
<header>
  <h1><a href="/"><img src="/assets/img/video_wars_logo.png"></a></h1>
  <h2><?php echo $topic['name']; ?></h2>
  <nav id="browse">
    <ul>
      <?php foreach($all_topics as $value) {?>
      <li><a href="/?topic=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>
      <?php } ?>
      <li><a href="/add_topic.php">More</a></li>
    </ul>
    <form class="search" action="">
      <input class="q" type="text" placeholder="search" />
    </form>
  </nav>
</header>
<div id="main" class="leaderboard">
  <h1>LEADER BOARD</h1>
  <table>
<?php foreach ($top_videos as $key => $video) { ?>
    <tr>
      <td> thumbnail
      </td> 
      <td> score
      </td>
      <td> chart
      </td>
    </tr>
<?php } ?>
  </table>
  <?php ?>
  this is a leaderboard
</div>


<footer>
  +
</footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
</body>
</html>

