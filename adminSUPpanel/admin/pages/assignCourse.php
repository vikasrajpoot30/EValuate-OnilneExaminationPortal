<?php
require('../../../conn.php');
// Check the value of 'q' to determine the assignment method
$method = isset($_GET['q']) ? intval($_GET['q']) : 0;

if ($method === 1) {
    // Method 1: Assign course to a specific student by roll number
    $course = $_POST['cou1'];
    $rollNumber = $_POST['roll'];

    // Perform the database insert
    $sql = "INSERT INTO course_assign (course_id, examinee_id) VALUES ((SELECT cou_id FROM course_tbl WHERE cou_name = :course),(SELECT exmne_id FROM examinee_tbl where exmne_roll=:rollNumber))";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':course', $course);
    $stmt->bindParam(':rollNumber', $rollNumber);
    $stmt->execute();
} elseif ($method === 2) {
    // Method 2: Assign course to students within a roll number range
    $course = $_POST['cou2'];
    $minRoll = $_POST['minRoll'];
    $maxRoll = $_POST['maxRoll'];

    // Perform the database insert for each student in the range
    $sql = "INSERT INTO course_assign (course_id, examinee_id) VALUES ((SELECT cou_id FROM course_tbl WHERE cou_name = :course), :rollNumber)";
    $stmt = $conn->prepare($sql);

    for ($rollNumber = $minRoll; $rollNumber <= $maxRoll; $rollNumber++) {
        $stmt->bindParam(':course', $course);
        $stmt->bindParam(':rollNumber', $rollNumber);
        $stmt->execute();
    }
} elseif ($method === 3) {
    // Method 3: Assign course to all students
    $course = $_POST['cou3'];

    // Retrieve all student roll numbers
    $sql = "SELECT examinee_id FROM your_student_table";
    $stmt = $conn->query($sql);

    // Perform the database insert for each student
    $sqlInsert = "INSERT INTO course_assign (course_id, examinee_id) VALUES ((SELECT cou_id FROM course_tbl WHERE cou_name = :course), :rollNumber)";
    $stmtInsert = $conn->prepare($sqlInsert);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rollNumber = $row['examinee_id'];
        $stmtInsert->bindParam(':course', $course);
        $stmtInsert->bindParam(':rollNumber', $rollNumber);
        $stmtInsert->execute();
    }
}

// Close the database connection
$conn = null;

// Redirect back to the main page or a confirmation page
header("Location: ../home.php?page=assign-course");
?>
