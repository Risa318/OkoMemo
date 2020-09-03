<?php
    if(!isset($_COOKIE['userName'])) {
        header('Location: Contact-pre.html');
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>お問い合わせ</title>
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
        <!--フォーム-->
		<div class="form">
			<div class="container">
				<form action="Contact-entry-check.php" method="post" class="form-action">
                    <h2 class="form-title">お問い合わせ</h2>
                    <hr>
                    <h3>種類</h3>
                    <p>当てはまるものを選んでください。</p>
                    <select name="select">
                        <option value="サイトの不具合について">サイトの不具合について</option>
                        <option value="退会について">退会について</option>
                        <option value="その他">その他</option>
                    </select>
                    <h3>お問い合わせ内容</h3>
					<textarea rows="4" class="form-text" name="content" required></textarea>
                    <br>
					<input type="submit" class="submit-button" value="確認">
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