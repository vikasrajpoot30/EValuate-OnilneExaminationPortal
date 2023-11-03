<?php
 include("../../../conn.php");
 extract($_POST);


$updCourse = $conn->query("UPDATE admin_acc SET admin_name='$adFullname', admin_gender='$adGender', admin_department='$adDepartment' exmne_email='$adEmail', exmne_password='$adPass' WHERE exmne_id='$admin_id' ");
if($updCourse)
{
	   $res = array("res" => "success", "admin_name" => $adFullname);
}
else
{
	   $res = array("res" => "failed");
}



 echo json_encode($res);	
?>