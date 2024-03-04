<?php
//ファイルの読み込み
require_once "db_connect.php";
require_once "functions.php";
//セッション開始
session_start();
// セッションからユーザーIDを取得
$userID = isset($_SESSION["id"]) ? $_SESSION["id"] : "";

// ユーザーIDに基づいてuser_infoテーブルから情報を取得
$stmt = $pdo->prepare("SELECT * FROM user_info WHERE user_id = ?");
$stmt->execute([$userID]);
$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

// 各要素を変数に格納
$kanji_name = $userInfo['kanji_name'];
$romaji_name = $userInfo['romaji_name'];
$affiliation = $userInfo['affiliation'];
$position = $userInfo['position'];
$company_address = $userInfo['company_address'];
$phon_number = $userInfo['phon_number'];
$email_address = $userInfo['email_address'];
$photo_url = $userInfo['photo_url'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPage</title>
</head>
<body>
    <h1>MyPage</h1>

    <p>漢字名前:<?php echo $kanji_name; ?></p>
    <p>ローマ字名前:<?php echo $$romaji_name; ?></p>
    <p>所属:<?php echo $affiliation; ?></p>
    <p>役職:<?php echo $$position; ?></p>
    <p>住所:<?php echo $company_address; ?></p>
    <p>電話番号:<?php echo $phon_number; ?></p>
    <p>メールアドレス:<?php echo $email_address; ?></p>
    <p>写真URL:<?php echo $photo_url; ?></p>
    

    <button id="redirectButton1" type="button">編集</button>
    <p></p>
    <button id="redirectButton2" type="button">QRコード</button>
    <button id="redirectButton3" type="button">カメラ</button>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // ボタン要素を取得
            const button1 = document.getElementById("redirectButton1");
            const button2 = document.getElementById("redirectButton2");
            const button3 = document.getElementById("redirectButton3");

            // ボタンのクリックイベントを処理
            button1.addEventListener("click", function() {
                
                window.location.href = "edit.php";
            });

            button2.addEventListener("click", function() {
                
                window.location.href = "QR.php";
            });

            button3.addEventListener("click", function() {
                
                window.location.href = "camera.php";
            });
        });
    </script>
</body>
</html>
