
<?php 
  include("../../../conn.php");
  $id = $_GET['id'];
 
  $selExmne = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$id' ")->fetch(PDO::FETCH_ASSOC);

 ?>

<fieldset style="width:543px;" >
	<legend><i class="facebox-header"><i class="edit large icon"></i>&nbsp;Update <b>( <?php echo strtoupper($selExmne['admin_name']); ?> )</b></i></legend>
  <div class="col-md-12 mt-4">
<form method="post" id="updateExaminerFrm">
     <div class="form-group">
        <legend>Fullname</legend>
        <input type="hidden" name="admne_id" value="<?php echo $id; ?>">
        <input type="" name="adFullname" class="form-control" required="" value="<?php echo $selExmne['admin_name']; ?>" >
     </div>

     <div class="form-group">
        <legend>Gender</legend>
        <select class="form-control" name="adGender">
          <option value="<?php echo $selExmne['admin_gender']; ?>"><?php echo $selExmne['admin_gender']; ?></option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
     </div>

     <div class="form-group">
        <legend>Department</legend>
        <input type="" name="adDepartment" class="form-control" required="" value="<?php echo $selExmne['admin_department']; ?>" >
     </div>

     <div class="form-group">
        <legend>Email</legend>
        <input type="" name="adEmail" class="form-control" required="" value="<?php echo $selExmne['admin_user']; ?>" >
     </div>

     <div class="form-group">
        <legend>Password</legend>
        <input type="" name="adPass" class="form-control" required="" value="<?php echo $selExmne['admin_pass']; ?>" >
     </div>
  <div class="form-group" align="right">
    <button type="submit" class="btn btn-sm btn-primary">Update Now</button>
  </div>
</form>
  </div>
</fieldset>

