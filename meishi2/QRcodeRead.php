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
} else {
    echo "No data received";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- CSS -->
        <link rel="stylesheet" href="./style.css"/>
        <!-- JavaScript -->
        <script src="./jsQR.js" defer></script>
        <script src="./main.js" defer></script>
    </head>
    <body>
    <h1>jsQR</h1>
        <div id="wrapper">
            <div id="msg">Unable to access video stream.</div>
            <canvas id="canvas"></canvas>
            <!-- 閉じるボタン -->
            <button onclick="closeWindow()">閉じる</button>
        </div>

        <script>
            function closeWindow() {
                // welcome.phpにリダイレクトする
                window.location.href = "../welcome.php";
            }
        </script>
    </body>
</html>
