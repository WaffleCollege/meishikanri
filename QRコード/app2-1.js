document.addEventListener("DOMContentLoaded", function() {
    // QRコードを表示する要素を取得
    const qrCodeDiv = document.getElementById("qrcode");

    //ここを変える(/user/{ID})
    let URL = "http://localhost:8080/screen3/1"

    // QRコードを生成して表示
    new QRCode(qrCodeDiv, URL); 

});
