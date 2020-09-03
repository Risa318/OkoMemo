<?php
    if(!empty($_COOKIE['userName'])) {
        header('Location: TopPage.php');
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>会員登録</title>
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
				<form action="PreEntry-done.php" method="post" class="form-action">
                    <h2 class="form-title">新規会員登録</h2>
                    <hr>
                    <h3>アカウント名</h3>
                    <input type="text" class="form-text" name="name" required>
                    <h3>メールアドレス</h3>
                    <input type="email" class="form-text" name="mail" required>
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