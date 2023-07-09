<?php

$file = fopen('./data/data.txt', 'r');　// ファイルを開く

// ファイル内容を1行ずつ読み込んで出力
while ($str = fgets($file)) {
    echo nl2br($str); // nl2br() ... 改行文字を追加
}
fclose($file); // ファイルを閉じる

?>
