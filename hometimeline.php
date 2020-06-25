<?php

// 外部ファイル読み込み
include('functions.php');

// DB接続します
$pdo = connect_to_db();

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

//ステップ1でTwitter developersから取得した値を代入
$consumerKey = "ZVTfiSNAasPFZbCQbh8CGsnAu";
$consumerSecret = "KUgGuKsDsGsdM5CQ2M1ouPehOuP94NLEJ4NwcqOtA4DDIXgzKW";
$accessToken = "1258950398804520960-WKrh0IN3lVzV5jyZkrJfeAsCYDD8Tf";
$accessTokenSecret = "6iZ22baLsYzHG1XbtOk34N9A8xNNd8kBJCOWnIuUUmTZP";

$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
//ホームタイムラインを10ツイート取得
//$timeline = $connection->get("statuses/home_timeline", ["count" => 10, "tweet_mode" => "extended"]);
//ユーザータイムラインを10ツイート取得
$timeline = $connection->get("statuses/user_timeline", ["count" => 10, "tweet_mode" => "extended"]);
//メンションタイムラインを10ツイート取得
//$timeline = $connection->get("statuses/mentions_timeline", ["count" => 10, "tweet_mode" => "extended"]);
//いいねのリストから10ツイート取得
//$timeline = $connection->get("favorites/list", ["count" => 10, "tweet_mode" => "extended"]);
if (isset($timeline->errors)) {
    //取得失敗
    echo "Error occurred. ";
    echo "Error message: " . $timeline->errors[0]->message;
} else {
    //取得成功


    for ($i = 0; $i < count($timeline); $i++) {
        echo "<p>";
        // echo "ツイートID: " . $timeline[$i]->id . "<br>";
        // echo "名前: " . $timeline[$i]->user->name . "<br>";
        // echo "ユーザー名(screen_name): " . $timeline[$i]->user->screen_name . "<br>";
        // echo "ツイート本文: " . $timeline[$i]->full_text . "<br>";

        $comment = $timeline[$i]->full_text;
        $url = "https://language.googleapis.com/v1/documents:analyzeSentiment?key=AIzaSyB0UlftBBKzWpdh8DEB68S1XlkR0nzjGog";
        $document = array('type' => 'PLAIN_TEXT', 'language' => 'ja', 'content' => $comment);
        $postdata = array('encodingType' => 'UTF8', 'document' => $document);
        $json_post = json_encode($postdata);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_post);

        $result = curl_exec($ch);
        curl_close($ch);

        $result_array = json_decode($result, true);
        // var_dump($result_array);

        echo '感情数値：' . $result_array['documentSentiment']['score'];

        if ($result_array['documentSentiment']['score'] >= 0.3) {
            echo '[絶好調です]';
        } else if ($result_array['documentSentiment']['score'] < -0.4) {
            echo '[激おこです]';
        } else {
            echo '[普通です]';
        }

        // var_dump($result_array);

        // echo "作成日: " . date("Y-m-d H:i:s", strtotime($timeline[$i]->created_at)) . "<br>";
        // echo "ツイート: " . $timeline[$i]->source . "<br>";
        // echo "リツイート数: " . $timeline[$i]->retweet_count . "<br>";
        // echo "いいね数: " . $timeline[$i]->favorite_count . "<br><br>";

        // $url = "https://twitter.com/" . $timeline[$i]->user->screen_name . "/status/" . $timeline[$i]->id;
        // echo 'ツイートURL: <a href="' . $url . '">' . $url . '</a><br><br>';

        $url2 = "https://publish.twitter.com/oembed?url=https://twitter.com/" . $timeline[$i]->user->screen_name . "/status/" . $timeline[$i]->id;
        $embed = file_get_contents($url2);
        echo json_decode($embed)->html;

        echo "</p>";
    }
}
