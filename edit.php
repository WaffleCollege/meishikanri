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

// POSTリクエストを処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータを取得
    $kanji_name = $_POST["kanji_name"];
    $romaji_name = $_POST["romaji_name"];
    $affiliation = $_POST["affiliation"];
    $position = $_POST["position"];
    $company_address = $_POST["company_address"];
    $phone_number = $_POST["phone_number"];
    $email_address = $_POST["email_address"];
    $photo_url = $_POST["photo_url"];

    // データベースの情報を更新
    $stmt = $pdo->prepare("UPDATE user_info SET kanji_name=?, romaji_name=?, affiliation=?, position=?, company_address=?, phone_number=?, email_address=?, photo_url=? WHERE user_id=?");
    $stmt->execute([$kanji_name, $romaji_name, $affiliation, $position, $company_address, $phone_number, $email_address, $photo_url, $userID]);

    // MyPage.phpにリダイレクト
    header("Location: MyPage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit My Info</title>
</head>
<body>
    <h1>Edit My Info</h1>

    <!-- フォーム -->
    <form method="post">
        <label for="kanji_name">漢字名前:</label>
        <input type="text" id="kanji_name" name="kanji_name" value="<?php echo $userInfo['kanji_name']; ?>"><br>

        <label for="romaji_name">ローマ字名前:</label>
        <input type="text" id="romaji_name" name="romaji_name" value="<?php echo $userInfo['romaji_name']; ?>"><br>

        <label for="affiliation">所属:</label>
        <input type="text" id="affiliation" name="affiliation" value="<?php echo $userInfo['affiliation']; ?>"><br>

        <label for="position">役職:</label>
        <input type="text" id="position" name="position" value="<?php echo $userInfo['position']; ?>"><br>

        <label for="company_address">住所:</label>
        <input type="text" id="company_address" name="company_address" value="<?php echo $userInfo['company_address']; ?>"><br>

        <label for="phone_number">電話番号:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $userInfo['phone_number']; ?>"><br>

        <label for="email_address">メールアドレス:</label>
        <input type="email" id="email_address" name="email_address" value="<?php echo $userInfo['email_address']; ?>"><br>

        <label for="photo_url">写真URL:</label>
        <input type="text" id="photo_url" name="photo_url" value="<?php echo $userInfo['photo_url']; ?>"><br>

        <input type="submit" value="保存">
    </form>
</body>
</html>

