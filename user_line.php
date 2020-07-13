<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <a href="index.php">戻る</a>
    <?php
    // データ受け取り
    $user_id = $_POST['user_id'];
    $user_num = $_POST['num'];

    // var_dump($user_id);
    // exit();

    $sin = null;

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
            'screen_name'       => $user_id,
            // ツイート件数
            'count'             => $user_num,
            // リプライを除外するかを、true（除外する）、false（除外しない）で指定
            'exclude_replies'   => 'false',
            // リツイートを含めるかを、true（含める）、false（含めない）で指定
            'include_rts'       => 'false'
        )
    );

    // ツイート本文を格納する変数
    $text_list = [];
    // 取得したツイート情報のオブジェクトから、ツイート本文を取得し配列$id_listに格納
    foreach ($statuses as $tweet) {
        $text = $tweet->text;
        array_push($text_list, $text);
    }

    // var_dump($tweet);
    // exit();

    for ($i = 0; $i < count($statuses); $i++) {
        echo "<p>";
        // echo "ツイートID: " . $statuses[$i]->id . "<br>";
        // echo "名前: " . $statuses[$i]->user->name . "<br>";
        // echo "ユーザー名(screen_name): " . $statuses[$i]->user->screen_name . "<br>";
        // echo "ツイート本文: " . $statuses[$i]->text . "<br>";

        $comment = $statuses[$i]->text;
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

        $sin += $result_array['documentSentiment']['score'];

        if ($result_array['documentSentiment']['score'] >= 0.3) {
            echo '[絶好調です]😆';
        } else if ($result_array['documentSentiment']['score'] < -0.4) {
            echo '<span class="big">[激おこです]😡</span>';
        } else {
            echo '[普通です]😑';
        }

        // var_dump($result_array);

        // echo "作成日: " . date("Y-m-d H:i:s", strtotime($statuses[$i]->created_at)) . "<br>";
        // echo "ツイート: " . $statuses[$i]->source . "<br>";
        // echo "リツイート数: " . $statuses[$i]->retweet_count . "<br>";
        // echo "いいね数: " . $statuses[$i]->favorite_count . "<br><br>";

        // $url = "https://twitter.com/" . $statuses[$i]->user->screen_name . "/status/" . $statuses[$i]->id;
        // echo 'ツイートURL: <a href="' . $url . '">' . $url . '</a><br><br>';

        $url2 = "https://publish.twitter.com/oembed?url=https://twitter.com/" . $statuses[$i]->user->screen_name . "/status/" . $statuses[$i]->id;
        $embed = file_get_contents($url2);
        echo json_decode($embed)->html;

        echo "</p>";
    }

    // $sample = $sum / $i;
    // echo "対象者の最近の平均感情値は{$sample}です。";

    // if ($sample >= 0.5) {
    //     echo '超絶好調です!!';
    // } else if ($sample < 0.5 && $sample >= 0.1) {
    //     echo '心は良好です。';
    // } else if ($sample < 0.1 && $sample >= -0.1) {
    //     echo '無です。悟りを開いています。';
    // } else if ($sample < -0.1 && $sample >= -0.4) {
    //     echo '少し不安やストレスがあるようです。';
    // } else if ($sample < -0.4 && $sample >= -0.8) {
    //     echo 'かなり情緒不安定です。';
    // } else {
    //     echo '危険です。';
    // }


    // var_dump($sum);
    ?>

    <table border="1">
        <tr>
            <th>
                <? $sample = $sin / $i;
                echo "対象者の最近の平均感情値は{$sample}です。";?>
            </th>

        </tr>
        <tr>
            <td>
                <? if ($sample >= 0.5) {
        echo '超絶好調です!!';
    } else if ($sample < 0.5 && $sample >= 0.1) {
        echo '心は良好です。';
    } else if ($sample < 0.1 && $sample >= -0.1) {
        echo '無です。悟りを開いています。';
    } else if ($sample < -0.1 && $sample >= -0.4) {
        echo '少し不安やストレスがあるようです。';
    } else if ($sample < -0.4 && $sample >= -0.8) {
        echo 'かなり情緒不安定です。';
    } else {
        echo '危険です。';
    }?>
            </td>

        </tr>

    </table>


</body>

</html>