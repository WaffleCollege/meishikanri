<?php
// QRコードから受け取ったデータ
$qr_data = $_POST['qr_data'];

// データベースへの追加処理やその他の必要な処理があればここに追加してください

// ページに表示するメッセージ
$message = "読み取ったデータ「" . $qr_data . "」を追加しました。";

// 以下はHTMLとしてメッセージを表示します
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Friends</title>
</head>
<body>
    <h1><?php echo $message; ?></h1>
</body>
</html>
