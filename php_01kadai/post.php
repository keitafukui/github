<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post画面</title>
</head>
<body>
<form action="write.php" method="post">
    お名前: <input type="text" name="name">
	EMAIL: <input type="email" name="mail"  placeholder="info@sample.com">
	電話番号：<input type="tel" name="tel"  pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" placeholder="090-1234-5678">
    好きなマクドナルドは？
    <select id="dinner_menu" name="mcdmenu" multiple size="3">
            <option value="hokkaido">北海道じゃがバタてりやき</option>
            <option value="osaka">大阪お好み焼き風ソースたまごてりやき</option>
            <option value="hakata">博多明太てりやきチキン</option>  
        </select>
	<input type="submit" name="submit" value="送信">
</form>

</body>
</html>

<?php 
    $result = "";
    if (isset($_POST['submit'])) {
        $result = "送信しました";
    }
    echo $result;

?>