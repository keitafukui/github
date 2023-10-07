<!DOCTYPE html>
<html>
<head>
    <title>体重グラフ</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.0.2/chartjs-plugin-annotation.min.js"></script>
</head>
<body>
    <canvas id="weightChart" width="800" height="400"></canvas>
    <div id="pointDisplay">
        <h1>現在の目標体重との乖離：<span id="weightDiff">0</span> kg</h1>
        <h2>本日の獲得ポイント: <span id="dailyPoints">0</span></h2>
        <h3>目標体重：<span id="targetWeight">XXkg</span></h3>
        <h4>所有ポイント: <span id="ownPoints">0</span></h4>
    </div>

    <script>
        // 初期のJSONデータは空のオブジェクトとして定義
        var jsonData = {};

        fetch('data.json') // data.jsonファイルのパスを指定
            .then(function(response) {
                return response.json(); // JSONデータを解析
            })
            .then(function(data) {
                // JSONデータをjsonData変数に格納
                jsonData = data;

                // 以下、JSONデータが読み込まれた後のコード
                // 日付と体重のデータを取得し、グラフを描画するコードなどを追加できます

                // JSONデータから日付と体重を抽出
                var dates = jsonData.value1.map(function(item) {
                    return item[0]; // 日付を取得
                });

                var weights = jsonData.value1.map(function(item) {
                    return parseFloat(item[1].toFixed(1)); // 体重を小数点以下1桁に表示し、浮動小数点数に変換
                });

                // 曜日を取得する関数
                function getDayOfWeek(dateString) {
                    var daysOfWeek = ["日", "月", "火", "水", "木", "金", "土"];
                    var date = new Date(dateString);
                    var dayOfWeek = date.getDay();
                    return daysOfWeek[dayOfWeek];
                }

                // 目標体重との差分を計算
                var tgtweight = 75; // ここに目標体重を設定
                var weightDiff = weights.map(function(weight) {
                    var diff = weight - tgtweight;
                    return diff.toFixed(1); // 差分を小数点以下1桁に表示
                });

                // グラフの描画
                var ctx = document.getElementById('weightChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: dates.map(function(date) {
                            return getDayOfWeek(date); // 曜日に変換
                        }),
                        datasets: [{
                            label: '体重 (kg)',
                            data: weights,
                            backgroundColor: 'rgb(102, 204, 102)', // 淡い緑色
                            borderWidth: 2
                        }, {
                            label: '差分',
                            data: weightDiff,
                            type: 'line', // 折れ線グラフで表示
                            borderColor: 'blue', // 線の色
                            borderWidth: 2,
                            yAxisID: 'y-diff', // 差分の軸をy-diffとして指定
                            fill: false, // 線を塗りつぶさない
                            pointStyle: 'circle', // ポイントのスタイルを円に設定
                            pointRadius: 5 // ポイントの半径を設定
                        }]
                    },
                    options: {
                        scales: {
                            'y-weight': { // 体重の軸設定
                                position: 'left', // 左側に表示
                                beginAtZero: true,
                                suggestedMax: Math.max.apply(null, weights) * 1.5, // 体重の最大値から1.5倍
                                title: {
                                    display: true,
                                    text: '体重 (kg)'
                                }
                            },
                            'y-diff': { // 差分の軸設定
                                position: 'right', // 右側に表示
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: '差分 (kg)'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        if (context.dataset.label === '体重 (kg)') {
                                            return context.dataset.label + ": " + context.raw + ' kg';
                                        } else if (context.dataset.label === '差分') {
                                            return context.dataset.label + ": " + context.raw + ' kg';
                                        }
                                    }
                                }
                            },
                            annotation: {
                                annotations: [{
                                    type: 'line',
                                    mode: 'horizontal',
                                    scaleID: 'y-weight',
                                    value: tgtweight,
                                    borderColor: 'red',
                                    borderWidth: 2,
                                    label: {
                                        content: '目標体重：' + tgtweight.toFixed(1) + ' kg', // 目標体重を表示
                                        enabled: true,
                                        position: 'right'
                                    }
                                }]
                            }
                        }
                    }
                });

                // ポイントの計算
                var dailyWeightDiff = parseFloat(weightDiff[weightDiff.length - 1]);
                var points;
                if (dailyWeightDiff > 0) {
                    points = -Math.floor(dailyWeightDiff / 0.1) * 500;
                } else {
                    points = Math.abs(dailyWeightDiff) * 100;
                }

                // 所有ポイントをデータベースから取得する代わりに、適当な初期ポイントを設定
                var ownPoints = 1000; // 仮の初期ポイント

                // ポイントを表示
                document.getElementById('weightDiff').textContent = dailyWeightDiff ; // 乖離の表示
                document.getElementById('dailyPoints').textContent = points; // 本日の獲得ポイントの表示
                document.getElementById('targetWeight').textContent =  tgtweight.toFixed(1) + ' kg'; // 目標体重の表示
                document.getElementById('ownPoints').textContent = ownPoints; // 所有ポイントの表示
            })
            .catch(function(error) {
                console.error('データの読み込みに失敗しました: ', error);
            });
    </script>
</body>
</html>
