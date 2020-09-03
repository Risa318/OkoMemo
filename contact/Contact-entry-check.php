<?php
    try {
        $select = $_POST['select'];
        $content = $_POST['content'];
        $name = $_COOKIE['userName'];
    
        $select = htmlspecialchars($select, ENT_QUOTES, 'UTF-8');
        $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    
        // データベースに接続
        $dsn = 'mysql:dbname=データベース名;host=ホスト名;charset=utf8';
        $user = 'ユーザー名';
        $password = 'パスワード';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // 登録されている名前とメールアドレスを全て取得
        $sql = 'SELECT name,mail FROM registers WHERE 1';
        $stmt = $dbh->query($sql);
        $results = $stmt->fetchAll();
        $dbh = null; // 切断
        // メールアドレスを取得
        foreach($results as $row) {
            if($name == $row['name']) {
                $mail = $row['mail'];
            }
        }    
    } catch(Exception $e) {
        echo '<p class="text2">ただいま障害により大変ご迷惑をおかけしております。</p>';
        exit(); // 強制終了
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>お問い合わせ確認</title>
        <link rel="stylesheet" href="../index.css">
		<link rel="shortcut icon" href="../images/icon.ico">
    </head>
    <body>
        <!--ヘッダー-->
        <div class="header">
            <div class="coutainer">
                <div class="header-left">
                    <a href="../index.php">
                        <h1 class="header-logo">OkoMemo</h1>
                    </a>
                </div>
                <!--メニュー-->
                <div class="header-right">
                    <a href="../AccountMake.php">口座作成</a>
                    <a href="../AccountEdit.php">口座編集</a>
                    <a href="Contact-entry.php">お問い合わせ</a>
                    <a href="../Logout.php"><?php echo $_COOKIE['userName']; ?></a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!--送信確認-->
        <div class="check">
            <div class="container">
                <h2>＜お問い合わせ確認＞</h2>
                <h3>種類</h3>
                <p><?php echo $select; ?></p>
                <h3>お問い合わせ内容</h3>
                <p><?php echo $content; ?></p>
            </div>
        </div>
        <div class="check-form">
			<div class="container">
                <p>この内容で管理人に問い合わせます。</p>
				<form action="Contact-mail.php" method="post" class="check-button">
                        <input type="hidden" name="name" value="<?php echo $name;?>">
                        <input type="hidden" name="mail" value="<?php echo $mail; ?>">
                        <input type="hidden" name="select" value="<?php echo $select; ?>">
                        <input type="hidden" name="content" value="<?php echo $content; ?>">
                        <input type="submit" value="送信">
                        <input type="button" class="button-no" onclick="history.back()" value="戻る">
				</form>
			</div>
        </div>
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
