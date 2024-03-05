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
    <link rel="stylesheet" href="./MyPage.css"/>
    <title>MyPage</title>
</head>
<body>
<div class="navigation">
      <ul>
        <li class="list active">
          <a href="showData.php">
            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
            <span class="title">HOME</span>
          </a>
        </li>
        <li class="list">
          <a href="MyPage.php">
            <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
            <span class="title">PLOFILE</span>
          </a>
        </li>
        <li class="list">
          <a href="#">
            <span class="icon"
              ><ion-icon name="log-out-outline"></ion-icon
            ></span>
            <span class="title">SIGNOUT</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="content">
        <div class="namecard">
            <p class="name"><?php echo $kanji_name; ?></p>
            <span class="phonetic"><?php echo $romaji_name; ?></span>

            <div class="contact">
                
            </div>
        </div>
        
        <button class="button1" id="redirectButton1" type="button">Edit</button>

        <div class="button2">
            <button id="redirectButton2" type="button">
                <ion-icon type="button" name="qr-code-outline"></ion-icon>
            </button>

            <button id="redirectButton3" type="button">
                <ion-icon name="camera-outline"></ion-icon>
            </button>
        </div>
        
    </div>

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
