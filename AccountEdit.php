<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>口座編集</title>
		<link rel="stylesheet" href="index.css">
		<link rel="shortcut icon" href="images/icon.ico">
    </head>
    <body>
        <!--ヘッダー-->
        <div class="header">
            <div class="coutainer">
                <div class="header-left">
                <a href="TopPage.php">
                        <h1 class="header-logo">OkoMemo</h1>
                    </a>
                </div>
                <!--メニュー-->
                <div class="header-right">
                    <a href="AccountMake.php">口座作成</a>
                    <a href="AccountEdit.php">口座編集</a>
                    <a href="contact/Contact-entry.php">お問い合わせ</a>
                    <a href="Logout.php"><?php echo $_COOKIE['userName']; ?></a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <?php
            if(!empty($_COOKIE['userName'])) {  // ログインしているかの確認
                try {
                    // 口座編集機能
                    if(isset($_POST['select'])) {
                        $select = $_POST['select'];
                        $id = $_POST['accountId'];
                        $edit = $_POST['accountEdit'];

                        // エラーチェック
                        if($id == null) {
                            echo "<p class='error'>編集したい口座を選択してください。</p>";
                        } else {
                            // データベースに接続
                            $dsn = 'mysql:dbname=データベース名;host=ホスト名;charset=utf8';
                            $user = 'ユーザー名';
                            $password = 'パスワード';
                            $dbh = new PDO($dsn, $user, $password);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $userName = $_COOKIE['userName'];   // ログインしているユーザー名を取得

                            // 選んだ操作を実行
                            if($select == "deposit") {
                                // 口座預け入れ
                                if(preg_match('/\A[0-9]+\z/', $edit) == 0) {
                                    echo "<p class='error'>変更したい値を正の整数で入力してください。</p>";
                                } else {
                                    // 指定された口座の編集前の残高を取得
                                    $sql = "SELECT id,name,balance FROM $userName WHERE 1";
                                    $stmt = $dbh->query($sql);
                                    $results = $stmt->fetchAll();                    
                                    foreach ($results as $row){
                                        if($id == $row['id']) { 
                                            $balance = $row['balance'];  // 残高取得
                                            break;
                                        }
                                    } 
                                    $balance += $edit; // 入力された値を加算

                                    // 残高データを更新
                                    $sql = "UPDATE $userName SET balance=:balance WHERE id=:id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                                    $stmt->bindParam(':balance', $balance, PDO::PARAM_INT);
                                    $stmt->execute();             
                                    
                                    $dbh = null;  // 切断
                                }
                            } else if($select == "drawer") {
                                if(preg_match('/\A[0-9]+\z/', $edit) == 0) {
                                    echo "<p class='error'>変更したい値を正の整数で入力してください。</p>";
                                } else {                                    
                                    // データベース内のデータを取り出す
                                    $sql = "SELECT id,name,balance FROM $userName WHERE 1";
                                    $stmt = $dbh->query($sql);
                                    $results = $stmt->fetchAll();

                                     // 指定された口座の編集前の残高を取得
                                    foreach ($results as $row){
                                        if($id == $row['id']) {  // 一致したとき
                                            $balance = $row['balance'];  // 残高取得
                                            break;
                                        }
                                    }
                                    $balance -= $edit;  // 入力された値と口座残高を計算して代入
                                    if($balance < 0) {  // 計算後の値が負の値になっている場合
                                        $balance = 0;  // 口座の値は0になる
                                    }               
                                    
                                    // 残高データを更新
                                    $sql = "UPDATE $userName SET balance=:balance WHERE id=:id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                                    $stmt->bindParam(':balance', $balance, PDO::PARAM_INT);
                                    $stmt->execute();

                                    $dbh = null;  // 切断
                                }
                            } else if($select == "delete") {
                                // レコードの中のデータ削除
                                $sql = "DELETE FROM $userName WHERE id=:id";
                                $stmt = $dbh->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                                $stmt->execute();

                                $dbh = null; // 切断
                            }
                        }    
                    }        
                } catch(Exception $e) {
                    echo '<p class="text2" style="margin-top: 100px;">ただいま障害により大変ご迷惑をおかけしております。</p>';
                    exit();
                }    
            } else {
                header('Location: index.php');
            }
            
            $test = null; // エラーメッセージ表示時に入力した口座名を残すための変数

        ?>
        <!--口座編集フォーム-->
		<div class="form">
			<div class="container">
				<form action="" method="post" class="form-action">
                    <h2 class="form-title">口座編集</h2>
                    <hr>
                    <h3>口座名</h3>
                    <?php 
                        // データベースに接続
                        $dsn = 'mysql:dbname=データベース名;host=ホスト名;charset=utf8';
                        $user = 'ユーザー名';
                        $password = 'パスワード';
                        $dbh = new PDO($dsn, $user, $password);
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        // レコードを読み込む
                        $userName = $_COOKIE['userName'];
                        $sql = "SELECT id,name,balance FROM $userName WHERE 1";
                        $stmt = $dbh->query($sql);
                        $results = $stmt->fetchAll();

                        $dbh = null; // 切断

                        foreach($results as $row) {
                            echo "<input type='radio' name='accountId' value='" . $row['id'] . "'>  " . $row['name']; 
                            echo "<br>";
                        }
                    ?>
                    <br>
                    <h3>ひとつ選んでください。</h3>
                    <input type="radio" name="select" value="deposit" checked="checked">  預け入れ<br>
                    <input type="radio" name="select" value="drawer">  引き出し<br>
                    <input type="radio" name="select" value="delete">  口座削除<br>
                    <h3>金額(削除のときは入力不要)</h3>
                    <input type="number" class="form-text" name="accountEdit">
                    <br>
					<input type="submit" class="submit-button">
				</form>
			</div>
		</div>
        <?php
            // 現在登録されている口座を表示する
            if(!empty($_COOKIE['userName'])) {  // ログイン判定
                try {
                    // 口座を表示
                    if(!empty($results)) {  // 口座が登録されていたら内容を表示
                        foreach ($results as $row){
                            echo "<div class='box'><div class='container'>"; // 口座表示のスタイル
                            echo "<p>口座名：" . $row['name'] . "</p>";
                            echo "<p>残高：" . $row['balance'] . "円</p><hr>";
                            echo "</div></div>";
                        }
                    } else { // まだ口座が作成されていない場合
                        echo "<a href='AccountMake.php'>";  // クリックしたら口座作成ページへ
                        echo "<div class='box'><div class='container'>"; // 口座表示のスタイル
                        echo "<p>まだ口座が登録されていません。</p>";
                        echo "</div></div>";
                        echo "</a>";
                    }                        
                } catch(Exception $e) {
                    echo '<p class="text2" style="margin-top: 100px;">ただいま障害により大変ご迷惑をおかけしております。</p>';
                }
            } else {
                header('Location: index.php'); // ログイン前トップページへ
            }           
        ?>

        <!--フッター-->
        <div class="wrapper">
            <footer>
                <div class="container">
                    &copy; 2020 OkoMemo.
                </div>
            </footer>
        </div>
    </body>
</html>
