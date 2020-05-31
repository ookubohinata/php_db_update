<?php
// 1.POSTでid,name,email,naiyouを取得
$id     = $_POST["id"];
$name   = $_POST["name"];
$email  = $_POST["email"];
$naiyou = $_POST["naiyou"];

// ２．DB接続
try {
  $pdo = new PDO('mysql:dbname=b_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

// UPDATE a_table SET ....;で更新（bindValue）
$sql = 'UPDATE a_table SET name=:name,email=:email,naiyou=:naiyou WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',$name,PDO::PARAM_STR);
$stmt->bindValue(':email',$email,PDO::PARAM_STR);
$stmt->bindValue(':naiyou',$naiyou,PDO::PARAM_STR);
$stmt->bindValue(':id',$id,PDO::PARAM_INT); //更新したいidを渡す
$status = $stmt->execute();

// 4.データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
  header("Location: select.php");
  exit;

}
?>