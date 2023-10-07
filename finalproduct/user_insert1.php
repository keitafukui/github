<?php
session_start();
include "funcs.php";
// sschk();

//1. POSTデータ取得
$name      = filter_input( INPUT_POST, "name" );
$lid       = filter_input( INPUT_POST, "lid" );
$lpw       = filter_input( INPUT_POST, "lpw" );
$kanri_flg = filter_input( INPUT_POST, "kanri_flg" );
$tntid       = filter_input( INPUT_POST, "tntid" );
$tntpw       = filter_input( INPUT_POST, "tntpw" );
$tgtweight       = filter_input( INPUT_POST, "tgtweight" );

// $lpw       = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(name,lid,lpw,tntid,tntpw,tgtweight,kanri_flg,life_flg) VALUES(:name,:lid,:lpw,:tntid,:tntpw,:tgtweight,:kanri_flg,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tntid', $tntid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tntpw', $tntpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':tgtweight', $tgtweight, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    //５．Menu.phpへリダイレクト
    header("Location: menu.php");
    exit;
}
