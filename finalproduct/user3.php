<?php

// クライアントIDとクライアントシークレット
$clientID = '13312.A43WPZnw7d.apps.healthplanet.jp';
$clientSecret = '1696162013020-UcpHfbOQRrHxqASouXQDezmAG6WKrvaWnHOkl58Y';

// アクセストークンを取得するURL
$tokenURL = 'https://www.healthplanet.jp/oauth/token';

// リフレッシュトークン
$refreshToken = 'O59095iYxDLlrZzVLEmSar7P9G2wGfJcsh3kFsqEc8vsT';

// アクセストークンを取得するためのパラメータ
$params = [
    'client_id' => $clientID,
    'client_secret' => $clientSecret,
    'refresh_token' => $refreshToken,
    'grant_type' => 'refresh_token',
];

// cURLを使用して新しいアクセストークンを取得
$ch = curl_init($tokenURL);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if ($response === false) {
    die('cURLエラー: ' . curl_error($ch));
}

curl_close($ch);

// JSONレスポンスから新しいアクセストークンを取得
$data = json_decode($response, true);

if (isset($data['access_token'])) {
    $newAccessToken = $data['access_token'];

    // 体組成測定情報を取得するURL
    $dataURL = 'https://www.healthplanet.jp/status/innerscan.json';

    // リクエスト用のパラメータ
    $requestData = [
        'access_token' => $newAccessToken,
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
} else {
    echo 'アクセストークンの取得に失敗しました。';
}

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
