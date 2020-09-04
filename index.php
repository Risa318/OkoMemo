<?php
    if(!empty($_COOKIE['userName'])) {
        header('Location: TopPage.php'); // ログインしている場合、ページ推移
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
                    <a href="index.php" class="header-logo">
                        <img src="images/okomemo-logo.png" alt="ロゴ">
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
        <!--トップメニュー-->
        <div class="top">
            <div class="container">
                <h1>OkoMemo</h1>
                <p>OkoMemoとは、「おこづかいのメモ帳」のことです。</p>
                <p>メモ帳にメモするように、シンプルにおこづかいの記録をつけることができます。</p>
                <div class="menu">
                    <a href="Login.php">ログインはこちら</a>
                    <a href="PreEntry.php">新規会員登録</a>
                </div>
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
