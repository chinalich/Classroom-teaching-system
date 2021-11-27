<?php
                                    // 从教师表查询带有班级和课程循环
                                    while($row = $result13->fetch_assoc()){
                                        // 班级
                                        $class=$row['of_class'];

                                        // 课程
                                        $kc=$row['class_kec'];

                                        // 查询课程表的班级和课程
                                        $iall="SELECT * FROM `curriculum` WHERE `curriculum`.`class`='$class' AND `curriculum`.`name`='$kc'";
                                        
                                        // 执行
                                        $select=$conn->query($iall);

                                        while($sel = $select->fetch_assoc()){
                                            // 显示

                                            // 班级
                                            $class_name=$sel['class'];
                                            // 课程：
                                            $class_kc=$sel['name'];
                                            // 星期
                                            $week=$sel['week_id'];

                                            // 判定星期
                                            if ($weekdata==$week) {
                                                // 判定具体时间
                                                if (date('H:i')>=$sel['start_timer'] && date('H:i')<=$sel['end_timer']) {
                                                    // 输出课程名
                                                    
                                                    //  考核：查询班级 课程
                                                    $classroom="SELECT * FROM `kaoh` 
                                                                WHERE `class`='$class_name'
                                                                AND `kec`='$class_kc'";
                                                    // 执行
                                                    $room=$conn->query($classroom);

                                                    while ($rooms=$room->fetch_assoc()){
                                                        // 判定周 判定星期 判定节数 判定状态
                                                        if($datecount==$rooms['week'] &&
                                                        $week==$rooms['week_id'] &&
                                                        $rooms['state']==$kcsum &&
                                                        ($rooms['ztai']=='迟到' || $rooms['ztai']=='正常' || $rooms['ztai']=='请假')){ 
                                                            // 指定
                                                            if($rooms['show_id']=='13'){ 
                                                            // <!-- // 判定相同
                                                            // // echo $rooms['week'];
                                                            // // echo $rooms['week_id'];
                                                            // // echo $rooms['state'];
                                                            // // echo $rooms['ztai']; -    
                                                            echo $rooms['name'];
                                }}}}}}} ?> 