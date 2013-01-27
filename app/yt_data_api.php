<?php

function json_call($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $results = curl_exec($ch);
    curl_close($ch);

    if ($results) {
        return json_decode($results);
    } else {
        return array();
    }
}

function yt_keyword($keyword) {
    $url = "https://www.googleapis.com/youtube/v3/search?part=id%2Csnippet&maxResults=50&q=" . urlencode($keyword) . "&key=" . API_KEY;
    $results = json_call($url);

    $videos = array();
    foreach ($results->items as $item) {
        $video = array("id" => $item->id->videoId, "title" => $item->snippet->title);
        array_push($videos, $video);
    }
    if ($videos) {
        return $videos;
    } else {
        return array();
    }
}

function yt_playlist($youtube_url)
{
    $parts = parse_url($youtube_url);
    $playlist_id = str_replace("list=", "", $parts["query"]);
    $url = "https://www.googleapis.com/youtube/v3/playlistItems?part=id%2Csnippet%2CcontentDetails&maxResults=50&playlistId=" . $playlist_id . "&key=" . API_KEY;
    $results = json_call($url);

    $videos = array();
    foreach ($results->items as $item) {
        $video = array("id" => $item->snippet->resourceId->videoId, "title" => $item->snippet->title);
        array_push($videos, $video);
    }
    if ($videos) {
        return $videos;
    } else {
        return array();
    }
}

function yt_channel($youtube_url)
{
    $url_pieces = parse_url($youtube_url);
    $channel_name = str_replace("/user/", "", $url_pieces["path"]);
    $channel_search_url = "https://www.googleapis.com/youtube/v3/search?part=id%2Csnippet&maxResults=1&q=" . $channel_name . "&type=channel&key=" . API_KEY;
    $channel_search = json_call($channel_search_url);
    $channel_id = $channel_search->items[0]->id->channelId;

    $channel_data_url = "https://www.googleapis.com/youtube/v3/channels?part=contentDetails%2Cstatistics%2CtopicDetails&id=" . $channel_id . "&key=" . API_KEY;
    $channel_data = json_call($channel_data_url);
    $playlist_id = $channel_data->items[0]->contentDetails->relatedPlaylists->uploads;

    $playlist_url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId=" . $playlist_id . "&key=" . API_KEY;
    $results = json_call($playlist_url);

    $videos = array();
    foreach ($results->items as $item) {
        $video = array("id" => $item->snippet->resourceId->videoId, "title" => $item->snippet->title);
        array_push($videos, $video);
    }
    if ($videos) {
        return $videos;
    } else {
        return array();
    }
}

?>
