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
                    <a href="../AccountMake.php">口座作成</a>
                    <a href="../AccountEdit.php">口座編集</a>
                    <a href="Contact-entry.php">お問い合わせ</a>
                    <a href="../Logout.php"><?php echo $_COOKIE['userName']; ?></a>
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