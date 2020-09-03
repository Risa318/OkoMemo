<?php
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $select = $_POST['select'];
    $content = $_POST['content'];

    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $mail = htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
    $select = htmlspecialchars($select, ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
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
                    <a href="../PreEntry.php">新規会員登録</a>
                    <a href="../Login.php">ログイン</a>
                    <a href="Contact-sle.php">お問い合わせ</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!--送信確認-->
        <div class="check">
            <div class="container">
                <h2>＜お問い合わせ確認＞</h2>
                <h3>お名前</h3>
                <p><?php echo $name; ?></p>
                <h3>メールアドレス</h3>
                <p><?php echo $mail; ?></p>
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