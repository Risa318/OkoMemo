<?php
    class Account {
        public $name;     //　口座名 
        public $balance;  //　残高名
        public $edit;    //  編集用


        // 口座作成メソッド
        public function accountMake() {
            // データベースに接続
            $dsn = 'mysql:dbname=tb220101db;host=localhost';
            $user = 'tb-220101';
            $password = 'SWYukeANsH';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

            $test = null; // エラー判定用の変数
            $userName = $_COOKIE['userName'];  // ログインしているユーザー名を取得

            $sql = "SELECT * FROM $userName";
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                if($this->name == $row['name']) {
                    $test = 1;
                }
            } 
            
            // データベースに書き込み
            if($test == null) {  
                $sql = $pdo -> prepare("INSERT INTO $userName (name, balance) VALUES (:name, :balance)");
                $sql -> bindParam(':name', $this->name, PDO::PARAM_STR);
                $sql -> bindParam(':balance', $this->balance, PDO::PARAM_INT);
                $sql -> execute();
            } else {
                echo "<p class='error'>この口座はすでに作成されています。</p>";
            }
        }

        // 口座預け入れメソッド
        public function accountDeposit() {
            // データベースに接続
            $dsn = 'mysql:dbname=tb220101db;host=localhost';
            $user = 'tb-220101';
            $password = 'SWYukeANsH';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

            $test = null; // エラー判定用の変数
            $userName = $_COOKIE['userName'];   // ログインしているユーザー名を取得

            // 指定された口座の編集前の残高を取得
            $sql = "SELECT * FROM $userName";
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                if($this->name == $row['name']) {  // 名前が一致したとき
                    $this->balance = $row['balance'];  // 残高取得
                    $test = 1;  // 口座名が存在することを示す
                    break;
                }
            } 
            // 入力された口座名がレコードに存在するときのみ実行
            if($test == 1){
                $this->balance += $this->edit; // 入力された値を加算

                // 残高データを編集
                $sql = "UPDATE $userName SET balance=:balance WHERE name=:name";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                $stmt->bindParam(':balance', $this->balance, PDO::PARAM_INT);
                $stmt->execute();                
            } else {
                echo "<p class='error' style='margin-top: 150px; margin-left: 80px;'>指定された口座が存在しません。</p>";
            }            
        }

        // 口座引き出しメソッド
        public function accountDrawer() {
            // データベースに接続
            $dsn = 'mysql:dbname=tb220101db;host=localhost';
            $user = 'tb-220101';
            $password = 'SWYukeANsH';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

            $test = null; // エラー判定用の変数
            $userName = $_COOKIE['userName'];  // ログインしているユーザー名を取得

            // 指定された口座の編集前の残高を取得
            $sql = "SELECT * FROM $userName";
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                if($this->name == $row['name']) {  // 名前が一致したとき
                    $this->balance = $row['balance'];  // 残高取得
                    $test = 1;  // 口座名が存在することを示す
                    break;
                }
            }

            if($test == 1) {  // 指定された口座名が存在するとき
                $this->balance -= $this->edit;  // 入力された値と口座残高を計算して代入
                if($editTest < 0) {  // 計算後の値が負の値になっている場合
                    $this->balance = 0;  // 口座の値は0になる
                }

                // 残高データを更新
                $sql = "UPDATE $userName SET balance=:balance WHERE name=:name";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                $stmt->bindParam(':balance', $this->balance, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                echo "<p class='error' style='margin-top: 150px; margin-left: 80px;'>指定された口座が存在しません。</p>";
            }
        }

        // 口座削除メソッド
        public function accountDelete() {
            // データベースに接続
            $dsn = 'mysql:dbname=tb220101db;host=localhost';
            $user = 'tb-220101';
            $password = 'SWYukeANsH';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

            $userName = $_COOKIE['userName'];  // ログインしているユーザー名を取得
            $test = null; // エラー判定用の変数

            $sql = "SELECT * from $userName";
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach($results as $row) {
                if($row['name'] == $this->name) {
                    $test = 1;  // 口座が存在することを示す
                }
            }

            if($test == 1) {    // 指定された口座が存在するとき
                // レコードの中のデータ削除
                $sql = "DELETE from $userName where name=:name";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                echo "<p class='error' style='margin-top: 150px; margin-left: 80px;'>指定された口座が存在しません。</p>";
            }
        }
    }
?>