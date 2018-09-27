<?php
// getで送信されたidを取得
$id = $_GET['id'];
echo "GET:".$id;


//1.  DB接続します
include('functions.php');
$pdo = db_conn();


//２．データ登録SQL作成，指定したidのみ表示する
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id=:id');
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();


//３．データ表示
if($status==false){
  // エラーのとき
  errorMsg($stmt);
}else{
  // エラーでないとき
  $rs = $stmt->fetch();
  // fetch()で1レコードを取得して$rsに入れる
  // $rsは配列で返ってくる．$rs["id"], $rs["name"]などで値をとれる
  // var_dump()で見てみよう
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<form method="post" action="update.php">
<!-- <div > -->
<!-- <ul> -->
<legend id="bm">Bookmark</legend>
    <div id="aaa">
    <fieldset>
    <legend>更新ページ</legend>
     <label>name：<input type="text" name="name" value="<?=$rs["name"]?>"></label><br>
     <label>URL：<input type="text" name="url" value="<?=$rs["url"]?>"></label><br>
     <label>comment:<textArea name="comment" rows="4" cols="40" ><?=$rs["comment"]?></textArea></label><br>
     <label>action:<textArea name="action" rows="4" cols="40"><?=$rs["action"]?></textArea></label><br>
     <input type="submit" value="送信">
     <!-- idは変えたくない = ユーザーから見えないようにする-->
     <input type="hidden" name="id" value="<?=$rs["id"]?>">
    </fieldset>

     <!-- <p  id="aa1">name：<input type="text" name="name"></p>
     <p  id="aa2">URL：<input type="text" name="url"></p>
     
     <P id="aa3">comment:<textArea name="comment" rows="4" cols="30"></textArea></P>
     <P id="aa4">Action:<textArea name="action" rows="2" cols="35"></textArea></P>
     <input type="submit" value="読了" id="bbb"> -->
     </div>
<!-- </ul> -->
  <!-- </div> -->
</form>
 <a href="select.php">読んだ本リスト</a>

</body>
</html>