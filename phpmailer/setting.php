<?php

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
define('SMTP_PORT', 587); // 環境に応じて変更

// メールアドレス・ここではメールユーザー名と同じでOK
define('MAIL_FROM','メールアドレス');

// 表示名
define('MAIL_FROM_NAME','OkoMemo');

// メールタイトル
define('MAIL_SUBJECT','【OkoMemo】仮会員登録が完了しました');

