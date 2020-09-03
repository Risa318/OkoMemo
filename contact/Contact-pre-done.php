<?php
    if(isset($_COOKIE['userName'])) {
        header('Location: Contact-entry-done.php');
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>お問い合わせ完了</title>
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
                    <a href="../PreEntry.php">新規会員登録</a>
                    <a href="../Login.php">ログイン</a>
                    <a href="Contact-sle.php">お問い合わせ</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!--メッセージ-->
        <p class="text">管理人にメールを送信しました。<br>
        確認の上返信しますので、お待ちください。</p>
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