<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録データ表示</title>
</head>
<body>
<?php 
    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $tel = $_POST["tel"];
    $mcdmenu = $_POST["mcdmenu"];
?>
    <li>お名前:<?= $name ?></li>
    <li>Mail:<?= $mail ?></li>
    <li>TEL:<?= $tel ?></li>
    <li>好きなマクド:<?= $mcdmenu ?></li>
    <?php     
    $c = ",";
    $str = date("Y-m-d H:i:s").$c.$name.$c.$mail.$c.$tel.$c.$mcdmenu."<br>"
    ?>

    <?php
    $file = fopen("./data/data.txt", "a" ); //ファイルOPEN
    fwrite( $file, $str ); //書込み
    fclose( $file ); //ファイル閉じる
    ?>

</body>
</html>

