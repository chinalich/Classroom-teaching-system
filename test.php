<?php
// 调用数据库
    require_once 'sql/db.php';
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>测试html</title>
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            
            .box {
                width: 100%;
                height: 750px;
                border: 1px solid green;
            }
            
            .box .qdao {
                width: 100%;
                height: 25%;
                border: 1px solid red;
            }
            
            .qdao .left {
                height: 100%;
                width: 40%;
                float: right;
                border: 1px solid rgb(174, 231, 135);
            }
            
            .qdao .left button {
                width: 60px;
                height: 25px;
                margin: 13% 25% 27% 25%;
            }
            
            .right {
                width: 250px;
                height: 300px;
                border: 2px solid green;
                margin: 30px auto;
                /* display: none; */
                /* 最多满足 */
                box-sizing: border-box;
                text-align: center;
            }
            
            .right .top {
                width: 100%;
                height: 25%;
                background-color: pink;
            }
            
            .right .test {
                width: 100%;
                height: 60%;
                background-color: blue;
            }
            
            .right .bottom {
                width: 100%;
                height: 15%;
                background-color: yellow;
                position: relative;
            }
            .right .bottom .auto {
                position: absolute;
                top: 10px;
                left: 60px;
            }
            .right .test .qdaos{
                width:100px;
                height: 150px;
                margin:0 auto;
            }
            .test .qdaos input{
                width:100px;
                height: 30px;
                margin-top:50px;
                background-color: red;
                border:none !important;
                border-radius:4px;
            }
        </style>
    </head>

    <body>
        <div class="box">
            <div class="qdao">
                <div class="left">
                    <button>签到</button>
                </div>
                <div class="right">
                    <div class="top">
                        <div id="CurrentTime"></div>
                    </div>
                    <div class="test">
                        <div class="qdaos">
                            <form action="./qdaos.php" method="post">
                                <input type="submit" value="报道" name="submit">
                            </form>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="auto">AUTO：LICH教育</div>
                    </div>
                </div>
            </div>
            <div class="txt"></div>
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
            function changetime(){
                var ary = Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
                var Timehtml = document.getElementById('CurrentTime');
                var date = new Date();
                Timehtml.innerHTML = ''+date.toLocaleString()+'<br>'+ary[date.getDay()];
            }
            window.onload = function(){
                changetime();
                setInterval(changetime,1000);
            }

        </script>
    </body>

    </html>