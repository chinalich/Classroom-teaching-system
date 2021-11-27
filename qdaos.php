<?php
    // 调用数据库
    require 'sql/db.php';
        // 开始记录账号
        session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        // 获取当前账号
        $username=$_SESSION['username'];
        // 根据cookie获取的账号来查询学生表
        $sqls="SELECT * FROM `students` WHERE `students`.`username`=$username"; 
        // 执行
        $result=$conn->query($sqls);
        $class = $result->fetch_assoc();

        // 获取当前周期
        $weekarray=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六"); //先定义一个数组
        $week = $weekarray[date("w")];

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
        $kcsum='第'.$keccount.'节';

        // 获取周数
        $weekcount = date('W');
        $date=intval(($weekcount/4)-1);
        $datecount='第'.intval(($weekcount/4)-1).'周';
        
        echo '今天是：'.$week.'=>第'.$date.'周'.'=>第'.$keccount.'节';
        echo '<br />';

        // 获取表数据
        $classid = $class['class'];
        $classidd = $class['student_id'];
        $classidname = $class['name'];
        $show_id=$class['show_id'];
        echo '班级：'.$classid;
        echo '<br />';
        echo '学号：'.$classidd;
        echo '<br />';
        echo '姓名：'.$classidname;
        echo '<br />';

        // 根据学生表里的班级来查询课程表
        $classname="SELECT * FROM `curriculum` WHERE `class`='$classid'";
        // 执行
        $result=$conn->query($classname);
    ?>
    <?php
        // 定义总课空数组
        $zkweek=[];
        // 定义不上课空数组
        $kweek=array();
        // 循环显示
        while ($row=$result->fetch_assoc()){
            // 添加数组元素总课程
            array_push($zkweek,$row['week_id']);

            // 判断当前周期与表周期是否符合
            if ($week==$row['week_id']) {

                // 定义课程
                $kecname=$row['name'];

                // 判断开始上课时间与结束时间
                if(date('H:i')>=$row['start_timer'] && date('H:i')<=$row['end_timer']) {
                    // 输出课程名
                    echo  '课程：'.$row['name'].'<br>';

                    // 判定迟到
                    if ((date('H:i')>='08:11' && date('H:i')<='08:15')||
                        (date('H:i')>='09:06' && date('H:i')<='09:10')||
                        (date('H:i')>='10:11' && date('H:i')<='10:15')||
                        (date('H:i')>='11:06' && date('H:i')<='11:10')||
                        (date('H:i')>='14:31' && date('H:i')<='14:35')||
                        (date('H:i')>='15:26' && date('H:i')<='14:30')||
                        (date('H:i')>='16:21' && date('H:i')<='16:25')||
                        (date('H:i')>='19:31' && date('H:i')<='19:35')) {
                        // 查询
                        $sql="SELECT * FROM `students` WHERE `students`.`username`=$username";
                        // 执行
                        $result=$conn->query($sql);
                        $res = $result->fetch_assoc();
                        // 输出表数据
                        echo '你已经迟到！';
                        // 添加
                        $cdao="INSERT INTO `kaoh` (`id`, `student_id`, `name`, `class`, `kec`, `week`, `week_id`, `state`, `ztai`,`show_id`)
                        VALUES (NULL, '$username', '$classidname', '$classid', '$kecname', '$datecount', '$week', '$kcsum', '迟到','$show_id')";
                        // 执行
                        $conn->query($cdao);
                        break;
                    }

                    // 判定旷课
                    elseif ((date('H:i')>='08:16' && date('H:i')<='08:40')||
                        (date('H:i')>='09:11' && date('H:i')<='09:35')||
                        (date('H:i')>='10:16' && date('H:i')<='10:40')||
                        (date('H:i')>='11:11' && date('H:i')<='11:35')||
                        (date('H:i')>='14:36' && date('H:i')<='15:00')||
                        (date('H:i')>='15:31' && date('H:i')<='14:55')||
                        (date('H:i')>='16:26' && date('H:i')<='16:50')||
                        (date('H:i')>='19:36' && date('H:i')<='20:00')){
                        // 查询
                        $sql="SELECT * FROM `students` WHERE `students`.`username`=$username";
                        // 执行
                        $result=$conn->query($sql);
                        $res = $result->fetch_assoc();
                        // 输出表数据
                        echo '你已经旷课！';
                         // 添加
                        $kke="INSERT INTO `kaoh` (`id`, `student_id`, `name`, `class`, `kec`, `week`, `week_id`, `state`, `ztai`,`show_id`)
                        VALUES (NULL, '$username', '$classidname', '$classid', '$kecname', '$datecount', '$week', '$kcsum', '旷课','$show_id')";
                        // 执行
                        $conn->query($kke);
                        break;
                    }

                    // 上课期间
                    else{
                        echo '正在上课中';
                    }
                }

                // 判定签到,签到时间只有10分钟
                elseif((date('H:i')>='08:00' && date('H:i')<='08:10')||
                        (date('H:i')>='08:55' && date('H:i')<='09:05')||
                        (date('H:i')>='10:00' && date('H:i')<='10:10')||
                        (date('H:i')>='10:55' && date('H:i')<='11:05')||
                        (date('H:i')>='14:20' && date('H:i')<='14:30')||
                        (date('H:i')>='15:15' && date('H:i')<='15:25')||
                        (date('H:i')>='16:10' && date('H:i')<='16:20')||
                        (date('H:i')>='19:20' && date('H:i')<='19:30')){

                        // 当前时间加10分钟
                        $startTime = date("H:i",strtotime(date("H:i")." +10 minutes"));

                        // 当前时间加30分钟
                        $endTime = date("H:i",strtotime(date("H:i")." +30 minutes"));

                        // 判定当前时间是否有课
                        if($startTime>=$row['start_timer'] && $endTime<=$row['end_timer']){
                            // 查询
                            $sql="SELECT * FROM `students` WHERE `students`.`username`=$username";

                            // 执行
                            $result=$conn->query($sql);
                            $res = $result->fetch_assoc();
                            
                            // 输出表数据
                            echo '你已经签到成功！';

                            // 添加
                            $add="INSERT INTO `kaoh` (`id`, `student_id`, `name`, `class`, `kec`, `week`, `week_id`, `state`, `ztai`,`show_id`)
                                VALUES (NULL, '$username', '$classidname', '$classid', '$kecname', '$datecount', '$week', '$kcsum', '正常','$show_id')";
                            // 执行
                            $conn->query($add);
                        }
                }
            }
            // 否则周末
            else{
                // 添加元素
                array_push($kweek,$row['week_id']);
            }       
        }

        // 不上课
        if((date('H:i')>='00:00' && date('H:i')<='08:20')||
        (date('H:i')>='08:55' && date('H:i')<='09:05')||
        (date('H:i')>='09:55' && date('H:i')<='10:10')||
        (date('H:i')>='10:55' && date('H:i')<='11:05')||
        (date('H:i')>='11:50' && date('H:i')<='14:29')||
        (date('H:i')>='15:15' && date('H:i')<='15:25')||
        (date('H:i')>='16:10' && date('H:i')<='16:20')||
        (date('H:i')>='18:00' && date('H:i')<='19:30')||
        (date('H:i')>='21:10' && date('H:i')<='23:59')){    
            echo '还没到上课时间哦！';       
        }

        // 定义周末
        // 计算总值
        // 定义总课程总值
        $zcount=count($zkweek);

        // 定义不上课总值
        $kcount=count($kweek);
        echo '<br />';
        
        // 判断
        if($zcount==$kcount){
            echo '今天没课，请同学们做好功课！';
        }
?>

</body>

</html>