<?php 
 include("../../../conn.php");

 extract($_POST);

 $selCourse = $conn->query("SELECT * FROM exam_tbl WHERE ex_title='$examTitle' ");

 if($courseSelected == "0")
 {
 	$res = array("res" => "noSelectedCourse");
 }
//  else if($timeLimit == "0")
//  {
//  	$res = array("res" => "noSelectedTime");
//  }
 else if($examQuestDipLimit == "" && $examQuestDipLimit == null)
 {
 	$res = array("res" => "noDisplayLimit");
 }
 else if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist", "examTitle" => $examTitle);
 }
 else
 {
	session_start();
	$examDate = $_POST["examDate"];
	$startTime = $_POST["examStartTime"];
	$endTime = $_POST["examEndTime"];
	$examin_id=$_SESSION['admin']['admin_id'];
	$insExam = $conn->query("INSERT INTO exam_tbl(cou_id,ex_title,ex_time_limit,ex_questlimit_display,ex_description,admin_id,start_time,end_time,starting_date) VALUES('$courseSelected','$examTitle','$timeLimit','$examQuestDipLimit','$examDesc','$examin_id','$startTime','$endTime','$examDate') ");
	// $insTime = $conn->query("INSERT INTO time_tbl(start_time,end_time,starting_date) VALUES ('$startTime','$endTime','$examDate')");
	if($insExam)
	{
		$res = array("res" => "success", "examTitle" => $examTitle);
	}
	else
	{
		$res = array("res" => "failed", "examTitle" => $examTitle);
	}


 }




 echo json_encode($res);
 ?>