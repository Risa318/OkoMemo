<?php
    if(!empty($_COOKIE['userName'])) {  // ログイン判定
        if(isset($_POST['yes'])) { // 「はい」が押されたとき
        // ログアウト用
        setcookie('userName', "", time() - 100);  // Cookieを削除
        header('Location: index.php');  //ログイン前トップページへ
        }

        if(isset($_POST['no'])) { // 「いいえ」が押されたとき
            header('Location: TopPage.php');  //  トップページへ戻る
        }
    } else {
        header('Locatiom: index.php'); // ログイン前トップページへ
    }
?>       

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ログアウト</title>
		<link rel="stylesheet" href="index.css">
		<link rel="shortcut icon" href="images/icon.ico">
    </head>
    <body>
        <!--ヘッダー-->
        <div class="header">
            <div class="coutainer">
                <div class="header-left">
                    <a href="TopPage.php" class="header-logo">
                        <img src="images/okomemo-logo.png" alt="ロゴ">
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
                <h1>ログアウト</h1>
                <p>ここはログアウトページです。</p>
                <p><?php echo $_COOKIE['userName'] ?>さん、ログアウトしますか？</p>
                <div class="logout-button">
                    <div class="container">
                        <form action="" method="post">
                            <input type="submit" name="yes" value="はい">
                            <input type="submit" class="button-no" name="no" value="いいえ">
                        </form>
                    </div>
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
