<?php

require_once("config.php");
require_once("db.php");


// echo "<a href='add_topic.php'>+ Add Topic</a><br /><br />";

if (array_key_exists("topic", $_GET) && is_numeric($_GET["topic"])) {
    //Topic id has been set
    $topic_id = $_GET["topic"];
    $topic = db_fetch("SELECT id, name FROM topics WHERE id = ?", array($topic_id), True);

} else {

    //Chose random topic
    $topics = db_fetch("SELECT COUNT(topics.id) AS count, topics.id, topics.name FROM topics JOIN videos ON videos.topic_id = topics.id GROUP BY topics.id");
    foreach ($topics as $key => $topic) {
        if ($topic["count"] <= CONFIG_MIN_VIDEO_COUNT) unset($topics[$key]);
    }
    $topic_key = array_rand($topics);
    $topic = $topics[$topic_key];
}

// $all_topics = db_fetch("SELECT COUNT(topics.id) AS count, topics.id, topics.name FROM topics JOIN videos ON videos.topic_id = topics.id GROUP BY topics.id");

// echo "<pre>"; print_r($topic); echo "</pre>";

$topic_leaderboard_url = "/leaderboard.php?topic=" . $topic["id"];
// echo "<pre>"; echo ($topic_leaderboard_url); echo "</pre>";

$videos = db_fetch("SELECT * FROM videos WHERE topic_id = ?", array($topic["id"]));
$video_keys = array_rand($videos, 2);
$video_1 = $videos[$video_keys[0]];
$video_2 = $videos[$video_keys[1]];
$video_1["vote_url"] = "/vote.php?win=" . $video_1["id"] . "&lose=" . $video_2["id"] . "&topic=" . $topic["id"];
$video_1["permalink_url"] = "/stat_page.php?video_id=" . $video_1["id"];
$video_2["vote_url"] = "/vote.php?win=" . $video_2["id"] . "&lose=" . $video_1["id"] . "&topic=" . $topic["id"];
$video_2["permalink_url"] =  "/stat_page.php?video_id=" . $video_2["id"];

$videos = array();
array_push($videos, $video_1, $video_2);

if (array_key_exists("topic", $_GET) && is_numeric($_GET["topic"])) {
    $topics = db_fetch("SELECT COUNT(topics.id) AS count, topics.id, topics.name FROM topics JOIN videos ON videos.topic_id = topics.id GROUP BY topics.id");
    foreach ($topics as $key => $value) {
        if ($value["count"] <= CONFIG_MIN_VIDEO_COUNT) unset($topics[$key]);
        if ($value["id"] == $topic_id) unset($topics[$key]);
    }
} else {
    unset($topics[$topic_key]);
}
// echo "Random Topics:<br />";
// foreach ($topics as $value) {
//     echo "<a href='?topic=" . $value["id"] . "'>" . $value["name"] . "</a><br />";
// }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>VIDEO WARS</title>
<link rel="stylesheet" type="text/css" href="http://reset5.googlecode.com/hg/reset.min.css">
<link href="http://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="assets/css/screen.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">

</head>
<body>
<header>
  <h1><a href="/"><img src="assets/img/video_wars_logo.png"></a></h1>
  <h2><a href="leaderboard.php?topic=<?php echo $topic['id'];?>"><?php echo $topic['name']; ?></a></h2>
  <?php include('nav.php'); ?>
</header>

<div id="main" class="battle">
  <h3>
    <strong>
    Who does it better? <br>
    </strong>
    You decide.
  </h3>

  <?php $video1 = $videos[0] ?>
  <?php $video2 = $videos[1] ?>
  
  <script>
      var tag = document.createElement('script');
      tag.src = "http://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  </script>

  <article class="vid1">
    <div class="video">
    
    <div id="player1" frameborder="0" allowfullscreen></div>

    <script>
        var player1, player2;

        function onYouTubeIframeAPIReady() {
          player1 = new YT.Player('player1', {
            height: '298',
            width: '530',
            videoId: '<?php echo $video1['youtube_id']; ?>',
            events: {
              'onStateChange': onPlayerStateChange1
            }
          });
          player2 = new YT.Player('player2', {
              height: '298',
              width: '530',
              videoId: '<?php echo $video2['youtube_id']; ?>',
              events: {
                'onStateChange': onPlayerStateChange2
              }
            });
        }

        function onPlayerStateChange1(event) {
          if (event.data == YT.PlayerState.PLAYING) {
            $.get("update_views.php", { video_id:"<?php echo $video1['id'] ?>" } );
          }
        }

        function onPlayerStateChange2(event) {
          if (event.data == YT.PlayerState.PLAYING) {
            $.get("update_views.php", { video_id:"<?php echo $video2['id'] ?>" } );
          }
        }
      </script>

    </div>
    <div class="vote"><a href="<?php echo $video1['vote_url'] ?>">vote!</a></div>
    <ul class="actions">
      <li class="twitter"> <a href="#" title="Twitter"><i class="icon-twitter"></i></a></li>
      <li class="facebook"> <a href="#" title="Facebook"><i class="icon-facebook-sign"></i></a></li>
      <li class="fave"> <a href="#" title="Favorite"><i class="icon-heart-empty"></i></a></li>
      <li class="link"> <a href="<?php echo $video1['permalink_url'] ?>" title="Permalink"><i class="icon-link"></i></a></li>
      <li class="flag"> <a href="#" title="Flag as Inappropriate"><i class="icon-flag"></i></a></li>
    </ul>
  </article>



  <article class="vid2">
    <div class="video">
      
      <div id="player2" frameborder="0" allowfullscreen></div>

    </div>
    <div class="vote"><a href="<?php echo $video2['vote_url'] ?>">vote!</a></div>
    <ul class="actions">
      <li class="twitter"> <a href="#" title="Twitter"><i class="icon-twitter"></i></a></li>
      <li class="facebook"> <a href="#" title="Facebook"><i class="icon-facebook-sign"></i></a></li>
      <li class="fave"> <a href="#" title="Favorite"><i class="icon-heart-empty"></i></a></li>
      <li class="link"> <a href="<?php echo $video2['permalink_url'] ?>" title="Permalink"><i class="icon-link"></i></a></li>
      <li class="flag"> <a href="#" title="Flag as Inappropriate"><i class="icon-flag"></i></a></li>
    </ul>
  </article>

</div>
<footer>
  +
</footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
</body>
</html>

