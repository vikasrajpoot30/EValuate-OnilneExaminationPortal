<?php
// require('../../../conn.php');

$sql = "SELECT cou_name FROM course_tbl";
$stmt = $conn->query($sql);
if ($stmt !== false) {
    $courseOptions = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $courseOptions .= "<option value='" . $row['cou_name'] . "'>" . $row['cou_name'] . "</option>";
    }
} else {
    $courseOptions = "No courses available.";
}
$conn = null;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Assignment</title>
    <script>
        function toggleDiv() {
            var div = document.getElementById("myDiv");

            if (div.style.display === "none" || div.style.display === "") {
                div.style.display = "block"; // Show the div
            } else {
                div.style.display = "none"; // Hide the div
            }
        }
        function toggleDiv2() {
            var div = document.getElementById("myDiv2");

            if (div.style.display === "none" || div.style.display === "") {
                div.style.display = "block"; // Show the div
            } else {
                div.style.display = "none"; // Hide the div
            }
        }
        function toggleDiv3() {
            var div = document.getElementById("myDiv3");

            if (div.style.display === "none" || div.style.display === "") {
                div.style.display = "block"; // Show the div
            } else {
                div.style.display = "none"; // Hide the div
            }
        }
    </script>
    <style>
        body{
            width:100%;
        }
        h2{
            background-color:#718990;
            padding:15px 0px;
            text-align:center;
            font-size:35px;
            color:white;
        }
        .button{
            margin-top:20px;
            padding:20px 30px;
        }
        .wrapper{
            /* border:2px solid red; */
            width:100%;
            display:flex;
            flex-wrap:wrap;
            margin:0 auto;
            align-items:center;
            justify-content:center;
            gap:100px;
        }
    </style>
</head>
<body>
    <!-- <h2 style={margin-right:0px}>Course Assignment</h2> -->
    <div class="wrapper">
    <div class="button button1">    
        <button onclick="toggleDiv2()">Assign Course by Roll Number</button>
        <div id="myDiv2" style="display: none;">
            <form action="pages\assignCourse.php?q=1" method="post">
                <label for="cou1">Add Student TO Course:</label>
                <select id="cou1" name="cou1" required>
                    <?php echo $courseOptions; ?>
                </select><br><br>
                <div>
                    <label for="roll">Roll Number: </label>
                    <input type="text" required name="roll" id="roll">
                    <input type="submit" value="Assign Students">
                </div>
            </form>
        </div>
    </div>
        
    <div class="button button2">    
        <button onclick="toggleDiv()">Assign Course Using Roll Number Between Range</button>
        <div id="myDiv" style="display: none;">
            <form action="pages\assignCourse.php?q=2" method="post">
                <label for="cou2">Add Students TO Course:</label>
                <select id="cou2" name="cou2" required>
                    <?php echo $courseOptions; ?>
                </select><br><br>
            <div>
                <label for="minRoll">from: </label>
                <input type="text" required name="minRoll" id="minRoll">
                <label for="maxRoll">upto: </label>
                <input type="text" required name="maxRoll" id="maxRoll">
                <input type="submit" value="Assign Students">
            </div>
        </form>
    </div>
    </div>


    <!-- <div class="button button3">    
        <button onclick="toggleDiv3()">Assign Course To All Students</button>
        <div id="myDiv3" style="display: none;">
            <form action="pages\assignCourse.php?q=3" method="post">
                <label for="cou3">Add Students TO Course:</label>
                <select id="cou3" name="cou3" required>
                    <?php echo $courseOptions; ?>
                </select><br><br>
                <input type="submit" value="Assign Students">
        </form>
    </div> -->
    </div>
    </div>
</body>
</html>
