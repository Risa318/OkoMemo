<?php
    try {
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $pass = $_POST['password'];
        $test = null;

        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $mail = htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
        $pass = htmlspecialchars($pass, ENT_QUOTES, 'UTF-8');

        $pass = md5($pass);  // 暗号化

        // データベースに接続
        $dsn = 'mysql:dbname=データベース名;host=ホスト名;charset=utf8';
        $user = 'ユーザー名';
        $password = 'パスワード';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 本登録用のレコードがない場合作成
        $sql = "CREATE TABLE IF NOT EXISTS registers"
        . " ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name char(32) NOT NULL,"  // アカウント名
        . "pass char(32) NOT NULL,"  // パスワード
        . "mail char(32) NOT NULL"   // メールアドレス
        . ");";
        $stmt = $dbh->query($sql); 
        
        // 登録されている名前とパスワードを全て取得
        $sql = 'SELECT name,pass,mail FROM registers WHERE 1';
        $stmt = $dbh->query($sql);
        $results = $stmt->fetchAll();

        $dbh = null; // 切断

        foreach ($results as $row){
            if($row['name'] == $name) {
                echo "<p class='error'>このユーザー名は既に登録済みです。</p>";
                $test = 1;
                break;
            }
            if($row['mail'] == $mail) {
                echo "<p class='error'>このメールアドレスは既に登録済みです。</p>";
                $test = 1;
                break;
            }
        }

        // 問題がなければメール送信を送信、データを記憶して仮登録を完了           
        if($test != 1) {
            setcookie('entry', 'entry-set', time() + 1800); // 仮登録用のcookieを設定、期限30分(60秒 * 30)
                            
            $name = rawurlencode($name);  // URLで渡せるようにする

            require 'phpmailer/send.php'; // メールを送る＆仮登録完了ページへ
        }
    } catch(Exception $e) {
        echo '<p class="text2">ただいま障害により大変ご迷惑をおかけしております。</p>';
        exit(); // 強制終了
    }
?>
