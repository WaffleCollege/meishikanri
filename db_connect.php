<?php
/* ①　データベースの接続情報を定数に格納する */
// const DB_HOST = 'mysql:dbname=business_card_revolution;host=localhost';
// const DB_USER = 'business_card_revolution';
// const DB_PASSWORD = 'meishikanri';

//②　例外処理を使って、DBにPDO接続する
// try {
//     $pdo = new PDO(DB_HOST,DB_USER,DB_PASSWORD,[
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_EMULATE_PREPARES =>false
//     ]);
// } catch (PDOException $e) {
//     echo 'ERROR: Could not connect.'.$e->getMessage()."\n";
//     exit();
// }
  require_once __DIR__ . '/vendor/autoload.php'; // dotenv ライブラリのオートロードを読み込みます

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();

  $dsn = "mysql:host={$_ENV["DB_HOST"]};dbname={$_ENV["DB_NAME"]}";
  $options = array(
    //PDO::MYSQL_ATTR_SSL_CA => "/etc/ssl/certs/ca-certificates.crt",
    PDO::MYSQL_ATTR_SSL_CA => "/etc/ssl/cert.pem",
    //ここは機種によって変わるかも
  );

  $pdo = new PDO($dsn, $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"], $options);
?>