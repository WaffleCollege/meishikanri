<?php
// QRコードのデータがPOSTされたかどうかを確認
if (isset($_POST['qr_data'])) {
    // db_connect.phpをインクルード
    require_once '../db_connect.php';

    // POSTリクエストから読み取ったQRコードのデータを取得
    $qr_data = $_POST['qr_data'];

    // データベースに接続
    try {
        // PDOインスタンスの作成
        $pdo = new PDO($dsn, $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"], $options);
        // エラーモードを例外モードに設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL文を準備
        $stmt = $pdo->prepare("INSERT INTO friends (my_id, other_id, memo) VALUES (?, ?, NULL)");

        // バインド変数を設定
        $my_id = $_SESSION["id"]; // 自分のID
        $other_id = (int)$qr_data; // QRコードのデータをint型に変換して設定
        $stmt->bindParam(1, $my_id);
        $stmt->bindParam(2, $other_id);

        // SQL文を実行
        $stmt->execute();

        // 接続を閉じる
        $pdo = null;

        // レスポンスを返す
        echo "QR code data saved successfully";
    } catch (PDOException $e) {
        // エラー時の処理
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- CSS -->
        <link rel="stylesheet" href="./camera.css"/>
        <!-- JavaScript -->
        <script src="./jsQR.js" defer></script>
        <script src="./main.js" defer></script>
    </head>
    <body>
    <div class="navigation">
      <ul>
        <li class="list">
          <a href="showData.php">
            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
            <span class="title">HOME</span>
          </a>
        </li>
        <li class="list active">
          <a href="MyPage.php">
            <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
            <span class="title">PLOFILE</span>
          </a>
        </li>
        <li class="list">
          <a href="logout.php">
            <span class="icon"
              ><ion-icon name="log-out-outline"></ion-icon
            ></span>
            <span class="title">SIGNOUT</span>
          </a>
        </li>
      </ul>
  </div>


    <div class="content">
        <div id="wrapper">
            <div id="msg"></div>
            <canvas id="canvas"></canvas>

            <button class="button1" id="redirectButton1" type="button">Back</button>
            
        </div>
    </div>

    <!-- <button class="button1" id="redirectButton1" type="button">Back</button> -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // ボタン要素を取得
            const button1 = document.getElementById("redirectButton1");

            // ボタンのクリックイベントを処理
            button1.addEventListener("click", function() {
                
                window.location.href = "MyPage.php";
            });
        });
    </script>

    
    <!-- サイドバーのJS -->
    <script>
      const list = document.querySelectorAll(".list");
      console.log(list);
      function activeLink() {
        list.forEach((item) =>
          // console.log(item);
          item.classList.remove("active")
        );
        this.classList.add("active");
      }

      list.forEach((item) => {
        item.addEventListener("click", activeLink);
      });
    </script>

    <!-- アイコンの引用元 -->
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
    </body>
</html>