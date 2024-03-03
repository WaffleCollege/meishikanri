document.addEventListener("DOMContentLoaded", function() {
    // ボタン要素を取得
    const button1 = document.getElementById("redirectButton1");
    const button2 = document.getElementById("redirectButton2");

    // ボタンのクリックイベントを処理
    button1.addEventListener("click", function() {
        // index2.htmlにリダイレクトする
        window.location.href = "/screen2-1";
    });

    button2.addEventListener("click", function() {
        // index3.htmlにリダイレクトする（例として）
        window.location.href = "/screen2-2";
    });
});

