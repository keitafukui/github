<?php
// require_once('vendor/autoload.php'); // oauthlibのインストールが必要です
require 'vendor/autoload.php';

// クライアントIDとクライアントシークレット
$clientID = '13312.A43WPZnw7d.apps.healthplanet.jp';
$clientSecret = '1696162013020-UcpHfbOQRrHxqASouXQDezmAG6WKrvaWnHOkl58Y';

// アクセストークンを取得するためのURL
$tokenURL = 'https://www.healthplanet.jp/oauth/token';

$oauth = new OAuth2\Client($clientID, $clientSecret);

// AccessTokenを発行するURLを取得
$authUrl = $oauth->getAuthenticationUrl('https://www.healthplanet.jp/oauth/auth', 'https://www.healthplanet.jp/success.html', ['scope' => 'innerscan']);
echo $authUrl;

echo '上記のURLにアクセスし、取得したコードを入力して、Enterを押してください。';
$code = trim(fgets(STDIN));

// AccessTokenを取得
$response = $oauth->getAccessToken($tokenURL, 'authorization_code', ['code' => $code]);
$accessToken = $response['result']['access_token'];

// 体組成測定情報を取得するURL
$dataURL = 'https://www.healthplanet.jp/status/innerscan.json';

// リクエスト用のパラメータ
$requestData = [
    'access_token' => $accessToken,
    'date' => 0, // 登録日付を指定
];

// データを取得するためのcURLリクエスト
$ch = curl_init($dataURL . '?' . http_build_query($requestData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$dataResponse = curl_exec($ch);

if ($dataResponse === false) {
    die('cURLエラー: ' . curl_error($ch));
}

curl_close($ch);

// 取得したデータを表示
echo '<pre>';
print_r(json_decode($dataResponse, true));
echo '</pre>';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Health Planetデータ取得</title>
</head>
<body>
    <button onclick="location.reload()">更新</button>
</body>
</html>
