<?php
include("../../../conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exfullname = $_POST['exfullname'];
    $exemail = $_POST['exemail'];
    $exdepartment = $_POST['exdepartment'];
    $exgender = $_POST['exgender'];
    $password = $_POST['expassword'];

    $selExaminerFullname = $conn->query("SELECT * FROM admin_acc WHERE admin_name='$exfullname'");
    $selExaminerEmail = $conn->query("SELECT * FROM admin_acc WHERE admin_user='$exemail'");

    if ($exdepartment == "0") {
        $res = array("res" => "noDepartment");
    } elseif ($exgender == "0") {
        $res = array("res" => "noGender");
    } elseif ($selExaminerFullname->rowCount() > 0) {
        $res = array("res" => "fullnameExist", "msg" => $exfullname);
    } elseif ($selExaminerEmail->rowCount() > 0) {
        $res = array("res" => "emailExist", "msg" => $exemail);
    } else {
        $insData = $conn->query("INSERT INTO admin_acc(admin_name,admin_gender,admin_department,admin_user,admin_pass) VALUES('$exfullname','$exgender','$exdepartment','$exemail','$password')");
        if ($insData) {
            $res = array("res" => "success", "msg" => $exemail);
        } else {
            $res = array("res" => "failed");
        }
    }

    echo json_encode($res);
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Include any necessary CSS or JavaScript files here -->
</head>
<body>
<div class="modal fade" id="modalForAddExaminer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addExaminerFrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Examiner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Fullname</label>
            <input type="" name="exfullname" id="exfullname" class="form-control" placeholder="Input Fullname" autocomplete="off" required="">
          </div>
          <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="exgender" id="exgender">
              <option value="0">Select gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label>Department</label>
            <input type="" name="exdepartment" id="exdepartment" class="form-control" placeholder="Input Deparment" autocomplete="off" >
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="exemail" id="exemail" class="form-control" placeholder="Input Email" autocomplete="off" required="">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="expassword" id="expassword" class="form-control" placeholder="Input Password" autocomplete="off" required="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Now</button>
      </div>
    </div>
   </form>
  </div>
</div>

    <!-- Include any necessary JavaScript code here, such as handling form submission via AJAX -->
</body>
</html>




















<!-- <?php
 include("../../../conn.php");
extract($_POST);

$selExaminerFullname = $conn->query("SELECT * FROM admin_acc WHERE admin_name='$exfullname' ");
$selExaminerEmail = $conn->query("SELECT * FROM admin_acc WHERE admin_user='$exemail' ");

if($exdepartment == "0")
{
	$res = array("res" => "noDepartment");
}
else if($exgender == "0")
{
	$res = array("res" => "noGender");
}
else if($selExaminerFullname->rowCount() > 0)
{
	$res = array("res" => "fullnameExist", "msg" => $exfullname);
}
else if($selExaminerEmail->rowCount() > 0)
{
	$res = array("res" => "emailExist", "msg" => $exemail);
}
else
{
	$insData = $conn->query("INSERT INTO admin_acc(admin_name,admin_gender,admin_department,admin_user,admin_password) VALUES('$exfullname','$exgender','$exdepartment','$exemail','$password')  ");
	if($insData)
	{
		$res = array("res" => "success", "msg" => $exemail);
	}
	else
	{
		$res = array("res" => "failed");
	}
}


echo json_encode($res);
 ?> -->