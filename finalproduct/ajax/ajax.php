
<?php 
    //パラメータをセット
    $params = array( 
        "access_token" => '13312.A43WPZnw7d.apps.healthplanet.jp', 
        "client_secret" => '1696162013020-UcpHfbOQRrHxqASouXQDezmAG6WKrvaWnHOkl58Y', 
        "code"  => "uRpwSt7ZqnxRA0HZ8Z0jB1W7O0UCmOWkPdHFwVIlNhSU6"

    ); 
    
    
    //クッキー保存ファイルを作成
    //Cookieを同じ場所に保存しています。
    
    $cookie_path = './cookie.txt';
    touch($cookie_path);
    
    //ログインページへ移動
    
    $URL1 = "https://www.healthplanet.jp/status/innerscan.json";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URL1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_path);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_path);
    $put = curl_exec($ch) or die('error ' . curl_error($ch)); 
    curl_close($ch);
    
    
    //ログインIDとパスワードを転送して認証されればトップページを開く
    
    $URL2 = "https://www.phppro.jp/members/login.php";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URL2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_path);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_path);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    $output = curl_exec($ch) or die('error ' . curl_error($ch)); 
    curl_close($ch);
    
    
    mb_language("Japanese");
    $html_source = mb_convert_encoding($output, "UTF-8", "auto");
    
     
    echo $html_source;
    
    
    
    //Cookieの削除のタイミングはあなたまかせです
    unlink($cookie_file_path);
    
?>


ページのスクレイピング

<?php
    require_once("simple_html_dom.php");
    $html = str_get_html($html_source);
    
    //この後、$htmlにスクレイピングを実施
?>


        