<div class="app-main__outer">
    <div id="refreshData">
    <div class="app-main__inner">
                     <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-midnight-bloom">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Course</div>
                                <div class="widget-subheading" style="color:transparent;">.</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white">
                                <div class="widget-numbers text-white">
    <?php
        $totalCourse = $conn->query("SELECT count(cou_id) FROM course_tbl");
        $totalCourseValue = $totalCourse->fetchColumn();
    ?>
    <span><?php echo $totalCourseValue; ?></span>
</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Exam</div>
                                <div class="widget-subheading" style="color:transparent;">.</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white">
                                <?php
        $totalCourse = $conn->query("SELECT count(ex_id) FROM exam_tbl");
        $totalCourseValue = $totalCourse->fetchColumn();
    ?>
    <span><?php echo $totalCourseValue; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-grow-early">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Examinee</div>
                                <div class="widget-subheading" style="color:transparent;">.</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white">
                                <?php
        $totalCourse = $conn->query("SELECT count(exmne_id) FROM examinee_tbl");
        $totalCourseValue = $totalCourse->fetchColumn();
    ?>
    <span><?php echo $totalCourseValue; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
         
    </div>
