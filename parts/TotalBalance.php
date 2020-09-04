<?php
    class TotalBalance {
        private $allTotal;
        private $number;

        
        // 全ての残高の合計を表示
        public function AllTotal() {
            // データベースに接続
            $dsn = 'mysql:dbname=tb220101db;host=localhost';
            $user = 'tb-220101';
            $password = 'SWYukeANsH';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            // レコードを読み込んで加算し、表示
            $userName = $_COOKIE['userName'];
            $sql = "SELECT * FROM $userName";
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                $this->allTotal += $row['balance'];
            }
            if($this->allTotal == null) {
                $this->allTotal = 0;
            }   
            echo "<div class='total'><p>残高合計：" . $this->allTotal . "円</p></div>";
        }


    }
?>