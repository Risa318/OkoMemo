<?php
    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';
    require 'setting.php';

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
    $mailTo->addAddress($mail, ''); //受信者（送信先）を追加する
//    $mailTo->addReplyTo('xxxxxxxxxx@xxxxxxxxxx','返信先');
//    $mailTo->addCC('xxxxxxxxxx@xxxxxxxxxx'); // CCで追加
//    $mailTo->addBcc('xxxxxxxxxx@xxxxxxxxxx'); // BCCで追加
    $mailTo->Subject = MAIL_SUBJECT; // メールタイトル
    $mailTo->isHTML(true);    // HTMLフォーマットの場合はコチラを設定します
    $body = '仮登録が完了しました。以下のURLをクリックして、本登録をしてください。<br>※このURLは30分のみ有効です。30分過ぎてしまった場合は、もう一度仮登録しなおしてください。<br><br>https://ドメイン名/OkoMemo/EntryExe.php?name=' . $name . '&pass=' . $pass . '&mail=' . $mail . '<br><br>※本メールへの返信は対応できかねます。';

    $mailTo->Body  = $body; // メール本文
    // メール送信の実行
    if(!$mailTo->send()) {
        echo "<p class='error'>メールの送信に失敗しました。メールアドレスをもう一度ご確認の上入力してください。</p>";
        exit();
    } else { // メールが送れたら実行
        header('Location: Tempo.html');
    }

