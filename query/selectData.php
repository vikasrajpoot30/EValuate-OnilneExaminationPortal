<?php 
$exmneId = $_SESSION['examineeSession']['exmne_id'];

// Select Data sa nilogin nga examinee
$selExmneeData = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id='$exmneId' ")->fetch(PDO::FETCH_ASSOC);


$selExam = $conn->query("SELECT * FROM exam_tbl WHERE cou_id IN (select course_id from course_assign where examinee_id='$exmneId') ORDER BY ex_id DESC ");


//

 ?>