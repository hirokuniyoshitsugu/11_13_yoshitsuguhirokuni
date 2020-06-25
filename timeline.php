<?php
// データ受け取り
$user_id = $_POST['user_id'];

// TwitterOAuthを利用するためComposerのautoload.phpを読み込み
require 'vendor/autoload.php';
// TwitterOAuthクラスをインポート
use Abraham\TwitterOAuth\TwitterOAuth;

// Twitter APIを利用する認証情報。xxxxxxxxの箇所にそれぞれの情報を指定
$CK = 'ZVTfiSNAasPFZbCQbh8CGsnAu'; // Consumer Keyをセット
$CS = 'KUgGuKsDsGsdM5CQ2M1ouPehOuP94NLEJ4NwcqOtA4DDIXgzKW'; // Consumer Secretをセット
$AT = '1258950398804520960-WKrh0IN3lVzV5jyZkrJfeAsCYDD8Tf'; // Access Tokenをセット
$AS = '6iZ22baLsYzHG1XbtOk34N9A8xNNd8kBJCOWnIuUUmTZP'; // Access Token Secretをセット

// TwitterOAuthクラスのインスタンスを作成
$connect = new TwitterOAuth($CK, $CS, $AT, $AS);

$statuses = $connect->get(
    'statuses/user_timeline',
    // 取得するツイートの条件を配列で指定
    array(
        // ユーザー名（@は不要）
        'screen_name' => '$user_id',
        // ツイート件数
        'count' => '10',
        // リプライを除外するかを、true（除外する）、false（除外しない）で指定
        'exclude_replies' => 'true',
        // リツイートを含めるかを、true（含める）、false（含めない）で指定
        'include_rts' => 'false'
    )
);

// var_dump($statuses);

// ツイート本文を格納する変数
$text_list = [];
// 取得したツイート情報のオブジェクトから、ツイート本文を取得し配列$id_listに格納

foreach ($statuses as $tweet) {
    $text = $tweet->text;
    array_push($text_list, $text);
}

var_dump($text);
exit();
