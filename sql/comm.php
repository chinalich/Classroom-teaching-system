<?php
// 调用数据库
require_once 'sql/db.php';
// 开始记录账号
session_start();
// 获取当前账号
$username=$_SESSION['username'];
// 根据cookie获取的账号来查询教师表
$sql="SELECT * FROM `teachers` WHERE `teachers`.`username`=$username"; 
// 执行
$result=$conn->query($sql);
// 执行
$result1=$conn->query($sql);
$result2=$conn->query($sql);
$result3=$conn->query($sql);
$result4=$conn->query($sql);
$result5=$conn->query($sql);
$result6=$conn->query($sql);
$result7=$conn->query($sql);
$result8=$conn->query($sql);
$result9=$conn->query($sql);
$result10=$conn->query($sql);
$result11=$conn->query($sql);
$result12=$conn->query($sql);
$result13=$conn->query($sql);

// 获取当前星期
$weekarray=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六"); //先定义一个数组
// 定义
$weekdata = $weekarray[date("w")];

// 获取当前的节数
// 定义节数
$keccount=0;
if(date('H:i')>='08:00' && date('H:i')<='08:55'){$keccount+=1;}
if(date('H:i')>='09:00' && date('H:i')<='09:55'){$keccount+=2;}
if(date('H:i')>='10:10' && date('H:i')<='10:55'){$keccount+=3;}
if(date('H:i')>='11:00' && date('H:i')<='11:50'){$keccount+=4;}
if(date('H:i')>='14:20' && date('H:i')<='15:15'){$keccount+=5;}
if(date('H:i')>='15:20' && date('H:i')<='16:10'){$keccount+=6;}
if(date('H:i')>='16:15' && date('H:i')<='18:00'){$keccount+=7;}
if(date('H:i')>='19:20' && date('H:i')<='21:10'){$keccount+=8;}
// 定义
$kcsum='第'.$keccount.'节';


// 获取当前周期
$weekarray=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六"); //先定义一个数组
// 定义
$week = $weekarray[date("w")];

// 获取周数
$weekcount = date('W');
$datecount='第'.intval(($weekcount/4)-1).'周';
?>