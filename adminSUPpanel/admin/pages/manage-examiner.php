<link rel="stylesheet" type="text/css" href="css/mycss.css">
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>MANAGE EXAMINER</div>
                    </div>
                </div>
            </div>     
            
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Examiner List
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                            <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th>Deprtment</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExmne = $conn->query("SELECT * FROM admin_acc ORDER BY admin_id DESC ");
                                if($selExmne->rowCount() > 0)
                                {
                                    while ($selExmneRow = $selExmne->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                           <td><?php echo $selExmneRow['admin_name']; ?></td>
                                           <td><?php echo $selExmneRow['admin_gender']; ?></td>
                                           <td><?php echo $selExmneRow['admin_department']; ?></td>
                                           <td><?php echo $selExmneRow['admin_user']; ?></td>
                                           <td><?php echo $selExmneRow['admin_pass']; ?></td>
                                           <td>
                                               <a rel="facebox" href="facebox_modal/updateExaminer.php?id=<?php echo $selExmneRow['admin_id']; ?>" class="btn btn-sm btn-primary">Update</a>

                                           </td>
                                        </tr>
                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="2">
                                        <h3 class="p-3">No Course Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
</div>
         
