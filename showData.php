<?php
//ファイルの読み込み
require_once "db_connect.php";
require_once "functions.php";
//セッション開始
session_start();



// ユーザー情報を取得
$sql = "SELECT * FROM user_info";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Friends List</title>
    <link rel="stylesheet" href="./MyPage.css">
</head>
<body class="showData_body">
    <div class="wrapper">
        <h2>Your Friends List</h2>
        <p>Here is the information of your friends users:</p>

        <table class="table_table-bordered">
            <thead>
                <!-- <tr>
                    <th>ID</th>
                    <th>Name_kanji</th>
                    <th>Name_romaji</th>
                    <th>Affiliation</th>
                    <th>Position</th>
                    <th>Company Address</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>PHOTO</th>
                    
                </tr> -->
            </thead>
            <tbody>
                <?php
                // データベースからデータを取得してHTMLに出力
                require_once "db_connect.php"; // データベースに接続
                $sql = "SELECT * FROM user_info";
                $stmt = $pdo->query($sql);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row): ?>
                
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['kanji_name']; ?></td>
                        <td><?php echo $row['romaji_name']; ?></td>
                        <td><?php echo $row['affiliation']; ?></td>
                        <td><?php echo $row['position']; ?></td>
                        <td><?php echo $row['company_address']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><?php echo $row['email_address']; ?></td>
                        <td><?php echo $row['photo_url']; ?></td>
                        <!-- 他の必要な情報があればここに追加 -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
