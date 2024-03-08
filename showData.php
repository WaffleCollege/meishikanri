<?php
// ファイルの読み込み
require_once "db_connect.php";
require_once "functions.php";
// セッション開始
session_start();

// ログインしているユーザーのIDを取得
$userID = isset($_SESSION["id"]) ? $_SESSION["id"] : '';

// 友達の情報を取得するSQLクエリ
$sql = "SELECT * FROM user_info WHERE user_id IN (SELECT other_user_id FROM friends WHERE user_id = :userID)";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userID', $userID, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Friends List</title>
    <link rel="stylesheet" href="./showData.css">
</head>
<body class="showData_body" style="background-color: #F0E8F8;">
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
            <span class="title">PROFILE</span>
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
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search...">
        <button type="button" onclick="searchTable()">Search</button>
    </div>

    <div class="wrapper">
        <table class="table_table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Affiliation</th>
                    <th style="text-align: center;">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $row): ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $row['kanji_name'] . " ( " . $row['romaji_name'] . " )"; ?></td>
                        <td style="text-align: center;"><?php echo $row['affiliation']; ?></td>
                        <td style="text-align: center;"><?php echo $row['email_address']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- 検索機能のJS -->
<script>
function searchTable() {
  // 入力された検索キーワードを取得
  var input = document.getElementById("searchInput");
  var filter = input.value.toUpperCase();
  
  // テーブルの行を取得
  var table = document.querySelector(".table_table-bordered");
  var rows = table.getElementsByTagName("tr");
  
  // 各行をループして検索し、表示/非表示を設定
  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName("td");
    var found = false;
    for (var j = 0; j < cells.length; j++) {
      var cell = cells[j];
      if (cell) {
        if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
    }
    // ヘッダー行は常に表示されるようにする
    if (rows[i].classList.contains("header-row")) {
      rows[i].style.display = "";
    } else {
      // 検索フィルターが空の場合はすべての行を表示する
      if (filter === "") {
        rows[i].style.display = "";
      } else {
        if (found) {
          rows[i].style.display = "";
        } else {
          rows[i].style.display = "none";
        }
      }
    }
  }
}


</script>

<!-- サイドバーのJS -->
<script>
    const list = document.querySelectorAll(".list");
    console.log(list);
    function activeLink() {
        list.forEach((item) =>
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
