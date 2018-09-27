<?php
//1.  DB接続します
//   try {
//     return new PDO('mysql:dbname=***********;charset=utf8;host=********','****','****');
//   } catch (PDOException $e) {
//     exit('DbConnectError:'.$e->getMessage());
//   }
include('functions.php');
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

// //３．データ表示
// $view='';
// if($status==false){
//   errorMsg($stmt);

  $view="";
  if($status==false) {
      //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("sqlError:".$error[2]);




}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view .= '<a href="detail.php?id='.$result['id'].'">';  //更新ページへのaタグを作成
    $view .= $result["name"]."-".$result["lid"]."-".$result["lpw"]."-".$result["kanli_flg"]."-".$result["life_flg"];
    $view .= '</a>';
    $view .= '　';
    $view .= '<a href="delete.php?id='.$result['id'].'">';  //削除用aタグを作成
    $view .= '［削除］';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">登録画面</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
