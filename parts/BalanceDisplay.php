<?php
    // それぞれの口座を表示
    class BalanceDisplay {
        public function AllDisplay() {
            // データベースに接続
            $dsn = 'mysql:dbname=tb220101db;host=localhost';
            $user = 'tb-220101';
            $password = 'SWYukeANsH';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

            $userName = $_COOKIE['userName'];
            $sql = "SELECT * FROM $userName";
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            if(!empty($results)) {  // 口座が登録されていたら内容を表示
                echo "<div class='box_bottom'>";
                foreach ($results as $row){
                    echo "<div class='box'><div class='container'>"; // 口座表示のスタイル
                    echo "<p>口座名：" . $row['name'] . "</p>";
                    echo "<p>残高：" . $row['balance'] . "円</p><hr>";
                    echo "</div></div>";
                }
                echo "</div>";
            } else { // まだ口座が作成されていない場合
                echo "<a href='AccountMake.php'>";  // クリックしたら口座作成ページへ
                echo "<div class='box'><div class='container'>"; // 口座表示のスタイル
                echo "<p>まだ口座が登録されていません。</p>";
                echo "</div></div>";
                echo "</a>";
            }
        }
    }
?>