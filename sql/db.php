<?php
// 连接数据库
$conn=new mysqli("localhost","root","root","classroom");

// 执行数据库

// 判断
if(!$conn){
    die("Could not connect to-->".$conn->connect_error);
}