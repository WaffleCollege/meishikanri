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
    <title>User Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            font: 14px sans-serif;
        }
        .wrapper{
            width: 800px;
            padding: 20px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>User Information</h2>
        <p>Here is the information of users:</p>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Aff</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>email</th>
                    <th>photo</th>
                    <!-- 他の必要な情報があればここに追加 -->
                </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $row): ?>
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
