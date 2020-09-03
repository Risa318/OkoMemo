<?php
    if(empty($_COOKIE['entry'])) {
        header('Location: EntryError.html');
    } else {
        try {
            $name = $_GET['name'];
            $pass = $_GET['pass'];
            $mail = $_GET['mail'];

            // データベースに接続
            $dsn = 'mysql:dbname=データベース名;host=ホスト名;charset=utf8';
            $user = 'ユーザー名';
            $password = 'パスワード';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 会員情報テーブルに登録
            $sql = 'INSERT INTO registers(name, pass, mail) VALUES (?,?,?)';
            $stmt = $dbh->prepare($sql);
            $data[] = $name;
            $data[] = $pass;
            $data[] = $mail;
            $stmt->execute($data);

            // 口座記録用のレコードを作成
            $sql = "CREATE TABLE IF NOT EXISTS $name"
            . " ("
            . "id INT AUTO_INCREMENT PRIMARY KEY,"
            . "name char(32),"
            . "balance INT"
            . ");";
            $stmt = $dbh->query($sql);

            $dbh = null;  // 切断

            // ログイン判定用のCookie追加
            setcookie('userName', $name, time() + 86400); // cookieを設定、期限1日

            // 仮登録用のCookie削除
            setcookie('entry', "", time() - 100);           
        } catch(Exception $e) {
            print '<p class="text2">ただいま障害により大変ご迷惑をおかけしております。</p>';
            exit(); // 強制終了    
        }

    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>会員登録完了</title>
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
                    <a href="AccountSelect.php">口座編集</a>
                    <a href="contact/Contact-entry.php">お問い合わせ</a>
                    <a href="Logout.php"><?php echo $name; ?></a>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <!--メッセージ-->
        <p class="text2">会員登録が完了しました！</p>

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