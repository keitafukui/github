
<?php


// try {
//   // JSONパース処理をここに記述
// } catch(JSONException e) {
//   e.printStackTrace();
// }


// String jsonData = "{ \"name\": \"Ichiro\", \"age\": 3 }";
// JSONObject jsonObj = new JSONObject(jsonData);

$json = file_get_contents('data.json');
$date= $json["value1"][0];
var_dump($date);

// 提供されたJSONデータ
//  '{
//     "code": [0],
//     "from_date": ["2023/09/01"],
//     "to_date": ["2023/10/01"],
//     "value1": [["2023/09/18", 79.8]],
//     "value1_name": ["体組成計 - 体重"]
// }';

// JSONデータを連想配列に変換
$data = json_decode($jsonData, true);

var_dump($data)
// ラベルとデータポイントを準備

// $labels = [];
// $dataPoints = [];

// // 体重のデータを抽出
// if (isset($data['value1']) && is_array($data['value1'][0])) {
//     foreach ($data['value1'] as $entry) {
//         $date = $entry[0];
//         $weight = $entry[1];
//         $labels[] = $date;
//         $dataPoints[] = $weight;
//     }
// }

// ?>

// <!DOCTYPE HTML>
// <html>
// <head>
//     <script>
//         // PHPからデータを受け取る
//         var labels = <?php echo json_encode($labels); ?>;
//         var dataPoints = <?php echo json_encode($dataPoints); ?>;
//     </script>
//     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
// </head>
// <body>
//     <div style="width: 80%;">
//         <canvas id="myChart"></canvas>
//     </div>
//     <script>
//         // Chart.jsを使用してグラフを描画
//         var ctx = document.getElementById('myChart').getContext('2d');
//         var chart = new Chart(ctx, {
//             type: 'line',
//             data: {
//                 labels: labels,
//                 datasets: [{
//                     label: '体重',
//                     data: dataPoints,
//                     borderColor: 'rgba(75, 192, 192, 1)',
//                     borderWidth: 1,
//                     fill: false
//                 }]
//             },
//             options: {
//                 scales: {
//                     x: {
//                         type: 'time',
//                         time: {
//                             unit: 'day',
//                             displayFormats: {
//                                 day: 'YYYY/MM/DD'
//                             }
//                         }
//                     },
//                     y: {
//                         beginAtZero: true
//                     }
//                 }
//             }
//         });
//     </script>
// </body>
</html>
