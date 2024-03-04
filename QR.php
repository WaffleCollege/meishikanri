<?php
//ファイルの読み込み
require_once "db_connect.php";
require_once "functions.php";
//セッション開始
session_start();
// セッションからユーザーIDを取得
$userID = isset($_SESSION["id"]) ? $_SESSION["id"] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>QRコード表示</title>
</head>
<body>
    <h1>QRコード表示</h1>
    
    <!-- QRコードを表示するための要素 -->
    <div id="qrcode"></div>

    <!-- qrcode.jsのスクリプト -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  

    <!-- PHPで生成したJavaScriptコード -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // QRコードを表示する要素を取得
            const qrCodeDiv = document.getElementById("qrcode");

            // PHPで取得したユーザーIDをJavaScriptの変数に代入
            let userID = "<?php echo $userID; ?>";

            // URLを変数に代入
            let URL = userID;

            // QRコードを生成して表示
            new QRCode(qrCodeDiv, URL); 
        });
    </script>
</body>
</html>
