<?php 
 include("../../../conn.php");
 
 extract($_POST);

 $examDate = $_POST["examDate"];
 $startTime = $_POST["examStartTime"];
 $endTime = $_POST["examEndTime"];
 $updExam = $conn->query("UPDATE exam_tbl SET cou_id='$courseId', ex_title='$examTitle', ex_time_limit='$examLimit', ex_questlimit_display='$examQuestDipLimit' , ex_description='$examDesc' , start_time='$startTime', starting_date='$examDate' , end_time='$endTime' WHERE  ex_id='$examId' ");
//  $dateandtime = $conn->query("UPDATE time_tbl SET start_time='$startTime', starting_date='$examDate' , end_time='$endTime' WHERE  exam_id='$examId' ");
 if($updExam)
 {
   $res = array("res" => "success", "msg" => $examTitle);
 }
 else
 {
   $res = array("res" => "failed");
 }

 echo json_encode($res);
 ?>