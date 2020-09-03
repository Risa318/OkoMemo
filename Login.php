<?php
    if(!empty($_COOKIE['userName'])) {
        header('Location: TopPage.php');
    }
    try {
        if(isset($_POST['name'])) {
            $name = $_POST['name'];
            $pass = $_POST['password'];

            $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
            $pass = htmlspecialchars($pass, ENT_QUOTES, 'UTF-8');
            $test = null; // エラー判定用
            $pass = md5($pass); // 暗号化

            // データベースに接続
            $dsn = 'mysql:dbname=データベース名;host=ホスト名;charset=utf8';
            $user = 'ユーザー名';
            $password = 'パスワード';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 登録されている名前とパスワードを全て取得
            $sql = 'SELECT name,pass FROM registers WHERE 1';
            $stmt = $dbh->query($sql);
            $results = $stmt->fetchAll();

            $dbh = null; // 切断

            foreach ($results as $row){
                if($row['name'] == $name) {
                    $test = 1;
                    if($row['pass'] == $pass) {
                        setcookie('userName', $name, time() + 86400); // cookieを設定、期限1日
                        header('Location: TopPage.php'); // ログイン後のページへ
                        break;
                    } else {
                        echo "<p class='error'>パスワードが間違っています</p>";
                        break;
                    }
                }
            }
            // 登録された名前が入力したものと違った場合
            if(empty($test)) {
                echo "<p class='error'>ログインに失敗しました。もう一度ご確認の上、入力してください。</p>";
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
        <title>ログイン</title>
		<link rel="stylesheet" href="index.css">
		<link rel="shortcut icon" href="images/icon.ico">
    </head>
    <body>
        <!--ヘッダー-->
        <div class="header">
            <div class="coutainer">
                <div class="header-left">
                    <a href="index.php">
                        <h1 class="header-logo">OkoMemo</h1>
                    </a>
                </div>
                <!--メニュー-->
                <div class="header-right">
                <a href="PreEntry.php">新規会員登録</a>
                    <a href="Login.php">ログイン</a>
                    <a href="contact/Contact-sle.php">お問い合わせ</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!--フォーム-->
		<div class="form">
			<div class="container">
				<form action="" method="post" class="form-action">
                    <h2 class="form-title">ログイン</h2>
                    <hr>
                    <h3>アカウント名</h3>
					<input type="text" class="form-text" name="name" required>
					<h3>パスワード</h3>
                    <input type="password" class="form-text" name="password" required>
                    <br>
					<input type="submit" class="submit-button">
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
