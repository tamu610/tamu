<meta charset="utf-8">
<form method="POST" action="mission_5-3.php">
  名前:<input type="text" name="namae" ><br>
  コメント:<input type="text" name="content" ><br>
  パスワード:<input type="text" name="pa" ><input type="submit" value="送信"><br>
  削除対象番号:<input type="text" name="del" ><input type="submit" value="削除"><br>
  編集対象番号:<input type="text" name="cha" ><input type="submit" value="編集">
  <?php 
    echo "<br>";
    $pdo = new PDO('データベース','ユーザー名','ぱすわーど',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sqlq = "CREATE TABLE IF NOT EXISTS tb"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name char(32),"
        . "comment TEXT,"
        . "password TEXT,"
        . "date TEXT"
        .");";
       $stmd = $pdo->query($sqlq);
    if(isset($_POST["pa"])){
     if($_POST["content"]!="" && $_POST["namae"]!="" && $_POST["pa"]!="" && $_POST["cha"]==""){
      $pdo = new PDO('データベース','ユーザー名','ぱすわーど',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
      $sql = $pdo -> prepare("INSERT INTO tb (name, comment, password, date) VALUES (:name, :comment, :password, :date)");
      $sql -> bindParam(':name', $name, PDO::PARAM_STR);
      $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
      $sql -> bindParam(':password', $password, PDO::PARAM_STR);
      $sql -> bindParam(':date', $date, PDO::PARAM_STR);
      $name = $_POST["namae"];
      $comment = $_POST["content"];
      $password = $_POST["pa"];
      $date = date("Y/m/d H:i:s");
      $sql -> execute();
     }elseif($_POST["content"]!="" && $_POST["namae"]!="" && $_POST["pa"]!="" && $_POST["cha"]!=""){
      $pdo = new PDO('データベース','ユーザー名','ぱすわーど',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
      $id = $_POST["cha"];
      $name = $_POST["namae"];
      $comment = $_POST["content"];
      $password = $_POST["pa"];
      $date = date("Y/m/d H:i:s");
      $sql = 'update tb set name=:name,comment=:comment,password=:password,date=:date where id=:id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
      $stmt->bindParam(':password', $password, PDO::PARAM_STR);
      $stmt->bindParam(':date', $date, PDO::PARAM_STR);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
     }elseif($_POST["pa"]!="" && $_POST["del"]!=""){
      $pdo = new PDO('データベース','ユーザー名','ぱすわーど',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
      $id = $_POST["del"];
      $password = $_POST["pa"];
      $sql = 'delete from tb where id=:id and password=:password ';
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':password', $password, PDO::PARAM_STR);
      $stmt->execute();
     }

     $pdo = new PDO('データベース','ユーザー名','ぱすわーど',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
     $sqla = 'SELECT * FROM tb';
     $stmta = $pdo->query($sqla);
     $results = $stmta->fetchAll();
     foreach ($results as $row){
      echo $row['id'].'<>';
      echo $row['name'].'<>';
      echo $row['comment'].'<>';
      echo $row['date'].'<br>';
      echo "<hr>";
     }
    }
   ?>
</form>
