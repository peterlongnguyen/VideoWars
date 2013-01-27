<?php

require_once("config.php");
require_once("db.php");

$video_id = $_GET["video_id"];
//$video_id = 1;

// video stat page
$video = db_fetch("SELECT * FROM videos WHERE id = ?", array($video_id), True);
echo "<pre>"; print_r($video); echo "</pre>";

$wins = db_fetch("SELECT COUNT(*) AS wins FROM votes WHERE win_video_id = ?", array($video_id), True);
$losses = db_fetch("SELECT COUNT(*) AS losses FROM votes WHERE lose_video_id = ?", array($video_id), True);

$topic = db_fetch("SELECT * FROM topics WHERE id = ?", array($video['topic_id']), True);


// echo("<b>Video Stat Page for video: </b>" . $video_id);
// echo("<br />");
// echo("<br />");

// echo "Wins: " . $wins["wins"];
// echo "<br />";

// echo "Losses: " . $losses["losses"];
// echo "<br />";

// video battle history
$wins = db_fetch("SELECT votes.win_video_id, votes.lose_video_id, votes.timestamp, videos.youtube_id FROM votes JOIN videos ON votes.lose_video_id = videos.id  WHERE votes.win_video_id = ?", array($video_id));
$losses = db_fetch("SELECT votes.win_video_id, votes.lose_video_id, votes.timestamp, videos.youtube_id FROM votes JOIN videos ON votes.win_video_id = videos.id  WHERE votes.lose_video_id = ?", array($video_id));
$merged = array_merge($wins, $losses);

$total_score = 100 * (count($wins) / (count($wins) + count($losses)));

$sorted = array();
foreach ($merged as $key => $value) {
    $sorted[$key] = $value['timestamp'];
}
array_multisort($sorted, SORT_DESC, $merged);

// echo("<b>Battle Wins for video: </b>" . $video_id);
foreach ($merged as $key => $value) {
	// echo("<br />");
	// echo "<pre>"; print_r($merged[$key]); echo "</pre>";
}

$all_topics = db_fetch("SELECT COUNT(topics.id) AS count, topics.id, topics.name FROM topics JOIN videos ON videos.topic_id = topics.id GROUP BY topics.id");

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
  <h2><?php print_r($topic['name']); ?></h2>
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
<div id="main" class="permalink">
  <article>
    <h1><?php echo $video['name'] ?></h1>
    <div class="video">
      <iframe width="550" height="350" src="http://www.youtube.com/embed/<?php echo $video['youtube_id']; ?>" frameborder="0" allowfullscreen></iframe>
    </div>
    <ul class="actions">
      <li class="twitter"> <a href="#" title="Twitter"><i class="icon-twitter"></i></a></li>
      <li class="facebook"> <a href="#" title="Facebook"><i class="icon-facebook-sign"></i></a></li>
      <li class="fave"> <a href="#" title="Favorite"><i class="icon-heart-empty"></i></a></li>
      <li class="link"> <a href="<?php echo $video['permalink_url'] ?>" title="Permalink"><i class="icon-link"></i></a></li>
      <li class="flag"> <a href="#" title="Flag as Inappropriate"><i class="icon-flag"></i></a></li>
    </ul>
  </article>
  <div id="chart_div" style="width: 200px; height: 200px;"></div>
  <div id="total_score"><?php echo $total_score ?></div>
</div>


<footer>
  +
</footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Decision', 'Quantity'],
      ['WINS', <?php echo count($wins); ?>],
      ['LOSSES', <?php echo count($losses); ?>],
    ]);

    var options = {
      slices: {0: {color: '#B5B6B6'}, 1: {color: '#C6312B'}},
      pieSliceText: 'none',
      reverseCategories: true,
      legend: {position: 'none'},
      tooltip: {text:'value', textStyle: {color: 'black', fontName: "sans-serif", fontSize: "12px"}},
      width: 200,
      height: 200,
      backgroundColor: 'none'
    };
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>
</body>
</html>

