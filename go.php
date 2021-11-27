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

    // 获取当前周期
    $weekarray=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六"); //先定义一个数组
    $weekdata = $weekarray[date("w")];

    // 独立执行
    $results=$conn->query($sql);
    // 独立显示
    $teata = $results->fetch_assoc();
    $teatb = $results->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>测试html</title>
        <link rel="stylesheet" href="css/go.css">
    </head>

    <body>
        <div class="box">
            <div class="top">
                <div id="CurrentTime"></div>
            </div>
            <div class="hello">
                <div class="txt">
                    <span>Dear：<?php echo $teata['teacher_name']; ?></span>：WELCOME TO YOUR TEACHER's CLASS
                </div>
            </div>
            <div class="text">
                <div class="top">
                    <div class="zhh">
                        <span>当前账号：</span>
                        <?php echo $username; ?>
                    </div>
                    <div class="name">
                        <span>姓名：</span>
                        <?php echo $teata['teacher_name'];?>
                    </div>
                    <div class="classa">
                        <span>所教班课——1：</span>
                        <?php echo $teata['of_class']; ?>：
                        <?php echo $teata['class_kec']; ?>
                    </div>
                    <div class="classb">
                        <span>所教班课——2：</span>
                        <?php echo $teatb['of_class']; ?>：
                        <?php echo $teatb['class_kec']; ?>
                    </div>
                </div>
                <div class="center">
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
                                        echo "<div class='teacher'>老师！有课哦</div>";
                                        echo '<br/>';
                                        echo  "<div class='kec'>".'班级：'.$class_name.'<br/>'.'课程：'.$sel['name']."</div>";
                                        break;
                                    }
                                }
                                // else{
                                //     echo "<div class='teacher cent'>老师！没有课哦</div>";
                                //     break;
                                //     // continue;
                                // }
                            }
                        }
                        
                    ?>
                </div>
                <div class="bottom">
                    <a href="./ket.php">进入课堂</a>
                </div>
            </div>
        </div>
        <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
        </script>
        <script>
            $(document).ready(function() {
                $("button").click(function() {
                    // 弹出弹入
                    $(".right").toggle();
                });
            });

            function changetime() {
                var ary = Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
                var Timehtml = document.getElementById('CurrentTime');
                var date = new Date();
                Timehtml.innerHTML = '' + date.toLocaleString() + '<br>' + ary[date.getDay()];
            }
            window.onload = function() {
                changetime();
                setInterval(changetime, 1000);
            }
        </script>
    </body>

    </html>