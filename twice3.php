<?php
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'root';
    $password = '';

    // PDO のインスタンスを生成して、MySQLサーバに接続
    $database = new PDO('mysql:host=localhost;dbname=twice_member;charset=UTF8;', $username, $password);

   
    // 実行するSQLを作成
    $sql = 'SELECT * FROM data';
    // SQL を実行する直前のステートメントを取得する
    $statement = $database->query($sql);
    // ステートメントから SQL を実行し、レコードを取得する
    $records = $statement->fetchAll();
    
    //var_dump($records);

    // ステートメントを破棄する
    $statement = null;
    // MySQLを使った処理が終わると、接続は不要なので切断する
    $database = null;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
     <meta charset="utf-8">
     <title>TWICE MEMBER</title>
     <link rel="stylesheet" href="twice.css">
</head> 
<header><center>TWICEメンバー検索</center></header>
    
<body>
  
        <form action="twice3.php" method="POST">
            <label>member: </label>
            
            <select name="target_name">
                <option value="">選択してください</option>
               <?php
               foreach($records as $record) { ?>
                <option value="<?php echo($record['name']) ?>"><?php echo($record['name']) ?></option>
                <?php } ?>
            </select>
      
            <input type="submit" value="送信">
        
        </form>
        
       <div class="member_data"> 
    
        <?php
        foreach($records as $record):?> 
       <?php if($_POST['target_name'] == ($record["name"])) :?>
    
           <p>氏名：<?php echo ($record["name"])?></p>
           <p>年齢：<?php echo ($record["age"])?></p>
           <p>性別：<?php echo ($record["gender"])?></p>
           <p>血液型：<?php echo ($record["bloodtype"])?></p>
           <p>出身地：<?php echo ($record["birthplace"])?></p>
           <p>プロフィール画像：<img src="<?php echo ($record["photo"])?>"></p>
           
       <?php endif ?>
        <?php endforeach ?>
        
        
       </div>
       
        
    
        
</body>
</html>