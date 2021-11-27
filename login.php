<?php

//登录

// 导入
require_once 'sql/db.php';

session_start();
if(!isset($_POST['submit'])){
    exit("非法访问！");
}

// 获取用户
$username=$_POST['username'];
$password=$_POST['password'];

// 判断是否空
if(!$username || !$password){
    echo "用户名或密码不能为空".'<a href="javascript:history.back(-1)">点击返回到登录页面</a>';
}
else{
    // 查询
    $name=$conn->query("SELECT id from `students` WHERE `username`='$username' and `password`='$password' limit 1");

    $result=mysqli_fetch_array($name);

    if($result){
        $_SESSION['username'] = $username;

        $_SESSION['password'] = $password;//一般情况下session中不保存密码信息


        header('location:test.php');
        
    }
    else{
        echo '用户名或密码不正确！<a href="javascript:history.back(-1)">点击返回到登录页面</a>';
    }
}
