<!DOCTYPE html>
<html>
<head>
    <title>JSONデータのValue表示</title>
</head>
<body>
    <?php
    // JSONデータを変数に格納
    $jsonData = '{
        "code": [0],
        "from_date": ["2023/09/05"],
        "to_date": ["2023/10/05"],
        "value1": [["2023/09/18", 79.8]],
        "value1_name": ["体組成計 - 体重"],
        "value1_unit": ["kg"],
        "value1_min": [78.8],
        "value1_max": [80.8],
        "value1_formatString": ["%.1f"],
        "value2": [["2023/09/18", 25.2]],
        "value2_name": ["体組成計 - 体脂肪率"],
        "value2_unit": ["%"],
        "value2_min": [24.2],
        "value2_max": [26.2],
        "value2_formatString": ["%.1f"],
        "value3": [["2023/09/18", 20.1096]],
        "value3_name": ["体組成計 - 体脂肪量"],
        "value3_unit": ["kg"],
        "value3_min": [19.1096],
        "value3_max": [21.1096],
        "value3_formatString": ["%.2f"]
    }';

    // JSONデータをPHPの連想配列に変換
    $data = json_decode($jsonData, true);

    // 各"value"の値を取り出して表示
    for ($i = 1; $i <= 3; $i++) {
        $valueKey = "value" . $i;
        if (isset($data[$valueKey])) {
            echo "<h2>{$data[$valueKey.'_name'][0]}</h2>";
            echo "<p>{$data[$valueKey][0][1]} {$data[$valueKey.'_unit'][0]}</p>";
        }
    }
    ?>

</body>
</html>