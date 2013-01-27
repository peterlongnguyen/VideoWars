<?php

require_once("config.php");
require_once("db.php");

echo "Add topic<br /><br />";

$categories = db_fetch("SELECT id, name FROM categories ORDER BY name");

?>
<html><head></head>
<body>

<form action="add_topic_action.php" method="get">
Keyword: <input type="text" name="keyword">
<br />
<br />

<a href="#">Advanced Options...</a>
<br /><br />

Battle Name: <input type="text" name="name">
<br /><br />

Playlist or Channel URL: <input type="text" name="url">
<br /><br />

Category<br />
<select name="category">
<?php foreach ($categories as $category) {
    echo "<option value='" . $category["id"] . "'>" . $category["name"] . "</option>";
} ?>
</select>
<br /><br />

Visiblility<br />
<input type="radio" name="visibility" value="1" checked>Public<br >
<input type="radio" name="visibilty" value="2">Unlisted<br />
<input type="radio" name="visibilty" value="3">Private
<br /><br />

Allow Skips<br />
<input type="radio" name="skips" value="1" checked>Yes<br >
<input type="radio" name="skips" value="0">No
<br /><br />

Allow Additions<br />
<input type="radio" name="additions" value="1" checked>Yes<br >
<input type="radio" name="additions" value="0">No
<br /><br />

Allow Leaderboard<br />
<input type="radio" name="leaderboard" value="1" checked>Yes<br >
<input type="radio" name="leaderboard" value="0">No
<br /><br />

<input type="submit" value="Submit">
</form>



</body>
</html>
