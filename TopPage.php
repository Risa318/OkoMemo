<?php
    if(empty($_COOKIE['userName'])) {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>OkoMemo</title>
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
        <!--トップメッセージ表示-->
        <div class="top_lo">
            <div class="container">
                <h1><?php echo $_COOKIE['userName']; ?>のOkoMemo</h1>
            </div>
        </div>
        <?php
            try {
                $allTotal = 0;   // 残高計算用

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

                // 残高の合計を加算、値が存在しない場合は0を代入
                foreach ($results as $row){
                    $allTotal += $row['balance'];
                }
                // 残高の合計を表示
                echo "<div class='total'><p>残高合計：" . $allTotal . "円</p></div>";

                // 口座を表示
                if(!empty($results)) {  // 口座が登録されていたら内容を表示
                    echo "<div class='box_bottom'>";
                    foreach ($results as $row){
                        echo "<div class='box'><div class='container'>"; // 口座表示のスタイル
                        echo "<p>口座名：" . $row['name'] . "</p>";
                        echo "<p>残高：" . $row['balance'] . "円</p><hr>";
                        echo "</div></div>";
                    }
                    echo "</div>";
                } else { // まだ口座が作成されていない場合
                    echo "<a href='AccountMake.php'>";  // クリックしたら口座作成ページへ
                    echo "<div class='box'><div class='container'>"; // 口座表示のスタイル
                    echo "<p>まだ口座が登録されていません。</p>";
                    echo "</div></div>";
                    echo "</a>";
                }        
            } catch(Exception $e) {
                print '<p class="text2">ただいま障害により大変ご迷惑をおかけしております。</p>';
                exit(); // 強制終了    
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