<?php
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $select = $_POST['select'];
    $content = $_POST['content'];

    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $mail = htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
    $select = htmlspecialchars($select, ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';

    // メール情報
    // メールホスト名・gmailでは smtp.gmail.com
    define('MAIL_HOST','メールホスト名');

    // メールユーザー名・アカウント名・メールアドレスを@込でフル記述
    define('MAIL_USERNAME','メールアドレス');

    // メールパスワード・上で記述したメールアドレスに即したパスワード
    define('MAIL_PASSWORD','アカウントのパスワード');

    // SMTPプロトコル(sslまたはtls)
    define('MAIL_ENCRPT','tls');  // 環境に応じて変更

    // 送信ポート(ssl:465, tls:587)
    define('SMTP_PORT', 587);  // 環境に応じて変更

    // メールアドレス・ここではメールユーザー名と同じでOK
    define('MAIL_FROM','メールアドレス');

    // 表示名
    define('MAIL_FROM_NAME','OkoMemo');

    // メールタイトル
    define('MAIL_SUBJECT','【OkoMemo問い合わせ】「' . $select . '」');

    // PHPMailerのインスタンス生成
    $mailTo = new PHPMailer\PHPMailer\PHPMailer();

    $mailTo->isSMTP(); // SMTPを使うようにメーラーを設定する
    $mailTo->SMTPAuth = true;
    $mailTo->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
    $mailTo->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
    $mailTo->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
    $mailTo->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
    $mailTo->Port = SMTP_PORT; // 接続するTCPポート

    // メール内容設定
    $mailTo->CharSet = "UTF-8";
    $mailTo->Encoding = "base64";
    $mailTo->setFrom(MAIL_FROM,MAIL_FROM_NAME);
    $mailTo->addAddress('メールアドレス（上で入力したものと一緒）', '自分'); //受信者（送信先）を追加する
//    $mailTo->addReplyTo('xxxxxxxxxx@xxxxxxxxxx','返信先');
//    $mailTo->addCC('xxxxxxxxxx@xxxxxxxxxx'); // CCで追加
//    $mailTo->addBcc('xxxxxxxxxx@xxxxxxxxxx'); // BCCで追加
    $mailTo->Subject = MAIL_SUBJECT; // メールタイトル
    $mailTo->isHTML(true);    // HTMLフォーマットの場合はコチラを設定します
    $body = 'お問い合わせが来ました。<br><br>＜名前＞' . $name . '<br>＜メールアドレス＞' . $mail . '<br>＜種類＞' . $select . '<br>＜内容＞<br>' . $content ;

    $mailTo->Body  = $body; // メール本文
    // メール送信の実行
    if(!$mailTo->send()) {
        echo "<p class='error'>メールの送信に失敗しました。障害が発生しています。</p>";
        exit();
    } else { // メールが送れたら実行
        header('Location: Contact-pre-done.php');
    }    
?>
