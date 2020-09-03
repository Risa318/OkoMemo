<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf-8">
    <title>口座作成</title>
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
            try {
                if(isset($_POST['accountName'])) { 
                    $name = $_POST['accountName'];
                    $balance = $_POST['balance'];

                    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
                    $balance = htmlspecialchars($balance, ENT_QUOTES, 'UTF-8');

                    if(preg_match('/\A[0-9]+\z/', $balance) == 0 && $balance != null) {
                        echo "<p class='error'>残高は正の整数で入力してください。</p>";
                    } else {
                        $userName = $_COOKIE['userName'];  // ログインしているユーザー名を取得
                        if($balance == null) {
                            $balance = 0;
                        }

                        // データベースに接続
                        $dsn = 'mysql:dbname=データベース名;host=ホスト名;charset=utf8';
                        $user = 'ユーザー名';
                        $password = 'パスワード';
                        $dbh = new PDO($dsn, $user, $password);
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
            
                        // 口座名がすでに使われてないか確認
                        $sql = "SELECT name,balance FROM $userName WHERE 1";
                        $stmt = $dbh->query($sql);
                        $results = $stmt->fetchAll();
                        foreach ($results as $row){
                            if($name == $row['name']) {
                                $dbh = null;  // データベースから切断
                                break;
                            }
                        } 
                        
                        // 問題がなければデータベースに書き込み
                        if($dbh == null) {  
                            echo "<p class='error'>この口座はすでに作成されています。</p>";
                        } else {
                            $sql = "INSERT INTO $userName(name, balance) VALUES (?,?)";
                            $stmt = $dbh->prepare($sql);
                            $data[] = $name;
                            $data[] = $balance;
                            $stmt->execute($data);
                            $dbh = null;   // データベースから切断
                        }            
                    }
                }        
            } catch(Exception $e) {
                echo '<p class="text2">ただいま障害により大変ご迷惑をおかけしております。</p>';
                exit(); // 強制終了    
            }    
        ?>
        <!--フォーム-->
		<div class="form">
			<div class="container">
				<form action="" method="post" class="form-action">
                    <h2 class="form-title">口座作成</h2>
                    <hr>
                    <h3>口座名</h3>
					<input type="text" class="form-text" name="accountName" required>
					<h3>現在の残高</h3>
                    <input type="number" class="form-text" name="balance">
                    <br>
					<input type="submit" class="submit-button">
				</form>
			</div>
		</div>
        <?php
            // 現在登録されている口座を表示する
            if(!empty($_COOKIE['userName'])) {  // ログイン判定
                try {
                    // データベースに接続
                    $dsn = 'mysql:dbname=データベース名;host=ホスト名;charset=utf8';
                    $user = 'ユーザー名';
                    $password = 'パスワード';
                    $dbh = new PDO($dsn, $user, $password);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    // レコードを読み込む
                    $userName = $_COOKIE['userName'];
                    $sql = "SELECT name,balance FROM $userName WHERE 1";
                    $stmt = $dbh->query($sql);
                    $results = $stmt->fetchAll();

                    $dbh = null; // 切断

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
