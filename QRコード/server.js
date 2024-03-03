const express = require('express');
const {request, response} = require("express");

const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();

// ミドルウェアの設定
app.use(bodyParser.urlencoded({ extended: true }));


// 画面１を表示する
app.get('/', (request, response) => {
  response.sendFile(__dirname + '/index1.html');
});

// 画面2-1を表示する
app.get('/screen2-1', (request, response) => {
  response.sendFile(__dirname + '/index2-1.html');
});

// 画面2-2を表示する
app.get('/screen2-2', (request, response) => {
  response.sendFile(__dirname + '/index2-2.html');
});

// 画面３を表示する
//ここを変える(/user/{ID})
app.get('/screen3/1', (request, response) => {
  response.sendFile(__dirname + '/index3.html');
});

// app1.jsを取得できるようにする
app.get('/app1.js', (request, response) => {
  response.sendFile(__dirname + '/app1.js');
});

// app2-1.jsを取得できるようにする
app.get('/app2-1.js', (request, response) => {
  response.sendFile(__dirname + '/app2-1.js');
});

// app2-2.jsを取得できるようにする
app.get('/app2-2.js', (request, response) => {
  response.sendFile(__dirname + '/app2-2.js');
});

// テキストを返すサンプル
app.get('/hello', (request, response) => {
  response.send('Hello World!');
});

//サーバの起動
app.listen(8080, () => {  
  console.log('server running on port 8080');
});