<!-- ユーザーの新規登録を行う画面 ⇒アクションはuser_insert-->

<?php
session_start();

include "funcs.php";
// sschk();
 
// フォームが送信された場合の処理 質問①　なぜポップアップされない？
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ここでポップアップを表示するJavaScriptを生成します
    echo '<script>
            function showPopup() {
                var popupWindow = window.open("", "popupWindow", "width=300,height=200");
                popupWindow.document.write("<html><body>");
                popupWindow.document.write("<h1>体重計に乗ってください</h1>");
                popupWindow.document.write("<button onclick=\'redirectToUser1()\'>OK</button>");
                popupWindow.document.write("</body></html>");
            }
            
            function redirectToUser1() {
                window.location.href = "user1.php";
            }
            
            // ポップアップを表示
            showPopup();
          </script>';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>USERデータ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
    <!-- <?php echo $_SESSION["name"]; ?>さん　 -->
    <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_insert1.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>Login ID：<input type="text" name="lid"></label><br>
     <label>Login PW<input type="text" name="lpw"></label><br>
     <label>タニタログインID<input type="text" name="tntid"></label><br>
     <label>タニタログインPW<input type="text" name="tntpw"></label><br>
     <label>今月の目標体重<input type="text" name="tgtweight"></label><br>
     <label>管理FLG：
      一般<input type="radio" name="kanri_flg" value="0">　
      管理者<input type="radio" name="kanri_flg" value="1">
    </label>
    <br>
     <!-- <label>退会FLG：<input type="text" name="life_flg"></label><br> -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>

<!-- Main[End] -->

</body>
</html>