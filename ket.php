<?php
    require_once './sql/comm.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/ket.css">
    <style>
        .centen ul,li{
            list-style: none;
        }

        .centen .left,.centen .right{
            width:23%;
            height: 520px;
            border: 1px solid green;
            float: left;
            box-sizing: border-box;
        }
        .centen .center{
            width:44%;
            height: 520px;
            border: 1px solid green;
            float: left;
            box-sizing: border-box;
        }
        .centen .goud1,.centen .goud2{
            width:5%;
            height: 520px;
            border:1px solid blue;
            float: left;
            box-sizing: border-box;
        }
        .centen .guod span{
            display: block;
            width: 100%;
            height: 100px;
            margin: 100px 0;
            text-align: center;
            font-size: 20px;
            color: #666;
        }


        .centen .left li,.right li{
            display: block;
            width: 100px;
            height: 50px;
            border:1px solid blue;
            float: left;
            margin:6px 18px;
        }
        .centen .center li{
            display: block;
            width: 100px;
            height: 50px;
            border:1px solid blue;
            float: left;
            margin: 6px 16px;
        }
        .bottom .teacher {
            width: 200px;
            height: 50px;
            border:1px solid blue;
            margin: 35px auto;
        }
        .bottom .teacher span{
            line-height: 50px;
            display: block;
            text-align: center;
            color:#666;
        }
        a{
            text-decoration: none;
        }
        .centen li{
            text-align: center;
            line-height:50px;
            color:black;
            font-weight:bold;
        }
    </style>
</head>

<body>
    <div class="box">
        <div class="box1">
            <div class="box2">
                <div class="top">
                <?php
                        // 查询带有班级和课程
                        while($row = $result->fetch_assoc()){
                            $class=$row['of_class'];
                            $kc=$row['class_kec'];

                            // 查询课程表的班级和课程
                            $iall="SELECT * FROM `curriculum` WHERE `curriculum`.`class`='$class' AND `curriculum`.`name`='$kc'";
                            // 执行
                            $select=$conn->query($iall);

                            while($sel = $select->fetch_assoc()){
                                // 显示
                                $class_name=$sel['class'];
                                $class_kc=$sel['name'];
                                $week=$sel['week_id'];
                                // 判定星期
                                if ($weekdata==$week) {
                                    // 判定具体时间
                                    if (date('H:i')>=$sel['start_timer'] && date('H:i')<=$sel['end_timer']) {
                                        // 输出课程名
                                        echo  "<div class='class com'>".'班级：'.$class_name.'<br/>'."</div>";
                                        echo  "<div class='kec com'>".'课程：'.$sel['name']."</div>";
                                        break;
                                    }
                                }
                            }
                        }
                        
                    ?>
                </div>
                <div class="centen">
                    <div class="left">
                        <ul>
                            <li>
                                <?php require_once './show/show1.php' ?>        
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show2.php' ?>      
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show12.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show13.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="goud1 guod">
                        <span>过</span>
                        <span>道</span>
                    </div>
                    <div class="center">
                    <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show3.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show4.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show10.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show11.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show5.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show6.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="goud2 guod">
                        <span>过</span>
                        <span>道</span>
                    </div>
                    <div class="right">
                    <ul>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show7.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show8.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li>
                                <?php require_once './show/show9.php' ?>
                            </li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <div class="bottom">
                    <div class="teacher"><span><a href="#">讲座</a></span></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>