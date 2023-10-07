<?php
// データベースから目標体重を取得
include "funcs.php"; // データベース接続の関数などを含むファイルをインクルード
$pdo = db_conn(); // データベース接続

// 今月の目標体重を取得
$stmt = $pdo->prepare("SELECT tgtweight FROM gs_user_table WHERE id = :id");
$stmt->bindValue(':id', 1, PDO::PARAM_INT); // ユーザーIDが1と仮定
$stmt->execute();
$tgtweight = $stmt->fetchColumn();

// JSONデータから本日と一日前の体重を取得
$jsonData = '{
    "2023/09/30": 75.0,
    "2023/09/29": 75.5,
    // 他の日付と体重データを追加
}';
$data = json_decode($jsonData, true);
$today = date('Y/m/d');
$yesterday = date('Y/m/d', strtotime('-1 day'));

$todayWeight = isset($data[$today]) ? $data[$today] : 0;
$yesterdayWeight = isset($data[$yesterday]) ? $data[$yesterday] : 0;

// 本日の体重差と獲得ポイントを計算
$dailyWeightDiff = $todayWeight - $yesterdayWeight;
if ($dailyWeightDiff > 0) {
    $points = -floor($dailyWeightDiff / 0.1) * 500;
} else {
    $points = abs($dailyWeightDiff) * 100;
}

// 所有ポイントをデータベースから取得
$stmt = $pdo->prepare("SELECT points FROM gs_user_table WHERE id = :id");
$stmt->bindValue(':id', 1, PDO::PARAM_INT); // ユーザーIDが1と仮定
$stmt->execute();
$ownPoints = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ポイント管理</title>
</head>
<body>
    <h1>本日の獲得ポイント: <?php echo $points; ?></h1>
    <h2>所有ポイント: <?php echo $ownPoints; ?></h2>
    <form method="post" action="donate.php">
        <input type="radio" name="choice" value="donate"> ユニセフに寄付<br>
        <input type="radio" name="choice" value="save"> 貯蓄する<br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>