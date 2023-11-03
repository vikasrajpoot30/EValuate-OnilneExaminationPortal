<?php
$examId = $_GET['id'];
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);
$exDisplayLimit = $selExam['ex_questlimit_display'];
// $startTime=$selExam['start_time'];
$endTime=$selExam['end_time'];
$startDate=$selExam['starting_date'];
$specificTime = $startDate.' '.$endTime;
// $specificTime = '2023-03-11 02:50:00';
// Get the current time as a string
$currentTime = date("Y-m-d H:i:s");

// Convert both times to Unix timestamps
$specificTimeTimestamp = strtotime($specificTime);
$currentTimeTimestamp = strtotime($currentTime);

// Calculate the time difference in minutes
$timeDifferenceMinutes = round(($specificTimeTimestamp-$currentTimeTimestamp-16000) / 60);

// Use the time difference as $selExamTimeLimit
$selExamTimeLimit = $timeDifferenceMinutes;


if ($selExam) {
    $questions = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examId' ORDER BY rand() LIMIT $exDisplayLimit ")->fetchAll(PDO::FETCH_ASSOC);
}

$questionCount = count($questions);
$currentQuestionIndex = 0; // Index of the current question
$currentQuestion = $questions[$currentQuestionIndex];
$currentQuestionId=$questions[$currentQuestionIndex];
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        .question-button {
            width: 30px;
            height: 30px;
            border: 1px solid #000;
            border-radius: 50%;
            text-align: center;
            margin: 2px;
            display: inline-block;
            cursor: pointer;
        }

        .current-button {
            background-color: gray;
            color: #fff;
        }

        .answered-button {
            background-color: green;
            color: #fff;
        }
    </style>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }

        setTimeout("preventBack()", 0);
        window.onunload = function () {
            null;
        };

    </script>
</head>

<body>

    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="col-md-12">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>
                                <?php echo $selExam['ex_title']; ?>
                                <div class="page-title-subheading">
                                    <?php echo $selExam['ex_description']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="page-title-actions mr-5" style="font-size: 20px;">
                        <form name="cd">
                          <input type="hidden" name="" id="timeExamLimit" value="<?php echo $selExamTimeLimit; ?>">
                          <label>Remaining Time :</label>
                          <input style="border:none;background-color: transparent;color:blue;font-size: 25px;" name="disp" type="text" class="clock" id="txt" value="00:00" size="5" readonly="true" />
                      </form> 
                    </div>   
                    </div>
                </div>
            </div>

            <div class="col-md-12 p-0 mb-4">
                <form method="post" id="submitAnswerFrm">
                    <input type="hidden" name="exam_id" id="exam_id" value="<?php echo $examId; ?>">
                    <input type="hidden" name="examAction" id="examAction">

                    <div id="question-navigation">
                        <h3>Question Navigation</h3>
                        <?php
                        foreach ($questions as $index => $question) {
                            $buttonClass = 'question-button';
                            if ($currentQuestionIndex == $index) {
                                $buttonClass .= ' current-button';
                            } elseif (isset($question['answered'])) {
                                $buttonClass .= ' answered-button';
                            }
                            $questionNumber = $index + 1;
                            echo "<div class='$buttonClass' data-question-index='$index'>$questionNumber</div>";
                        }
                        ?>
                    </div>

                    <div id="exam-questions">
                        <?php
                        foreach ($questions as $index => $question) {
                            $display = $index === $currentQuestionIndex ? 'block' : 'none';
                            $questionNumber = $index + 1;
                            $id=$question['eqt_id'];
                            echo "<div class='question' id='question-$index' style='display: $display;'>";
                            echo "<p><b>Question $questionNumber:</b> " . $question['exam_question'] . "</p>";
                            echo "<div class='col-md-4 float-left'>";
                            echo "<div class='form-group pl-4'>";
                            echo "<input name='answer[$id][correct]' value='" . $question['exam_ch1'] . "' class='form-check-input' type='radio' value=''>";
                            echo "<label class='form-check-label' for='invalidCheck'>" . $question['exam_ch1'] . "</label>";
                            echo "</div>";
                            echo "<div class='form-group pl-4'>";
                            echo "<input name='answer[$id][correct]' value='" . $question['exam_ch2'] . "' class='form-check-input' type='radio' value=''>";
                            echo "<label class='form-check-label' for='invalidCheck'>" . $question['exam_ch2'] . "</label>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class='col-md-8 float-left'>";
                            echo "<div class='form-group pl-4'>";
                            echo "<input name='answer[$id][correct]' value='" . $question['exam_ch3'] . "' class='form-check-input' type='radio' value=''>";
                            echo "<label class='form-check-label' for 'invalidCheck'>" . $question['exam_ch3'] . "</label>";
                            echo "</div>";
                            echo "<div class='form-group pl-4'>";
                            echo "<input name='answer[$id][correct]' value='" . $question['exam_ch4'] . "' class='form-check-input' type='radio' value=''>";
                            echo "<label class='form-check-label' for='invalidCheck'>" . $question['exam_ch4'] . "</label>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>
                    </div>

                    <div id="buttons" class="text-center">
                        <button type="button" class="btn btn-xlg btn-warning p-3 pl-4 pr-4" id="resetExamFrm">Reset</button>
                        <button type="button" class="prev-button btn btn-xlg btn-primary p-3 pl-4 pr-4" <?php echo $currentQuestionIndex == 0 ? 'disabled' : ''; ?>>Previous</button>
                        <button type="button" class="next-button btn btn-xlg btn-primary p-3 pl-4 pr-4" <?php echo $currentQuestionIndex == $questionCount - 1 ? 'disabled' : ''; ?>>Next</button>
                        <input name="submit" type="submit" value="Submit Exam" class="btn btn-xlg btn-primary p-3 pl-4 pr-4" id="submitAnswerFrmBtn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.question-button').click(function () {
                var questionIndex = $(this).data('question-index');
                showQuestion(questionIndex);
                $('.question-button.current-button').removeClass('current-button');
                $(this).addClass('current-button');
            });

            $('.prev-button').click(function () {
                if (currentQuestionIndex > 0) {
                    currentQuestionIndex--;
                    showQuestion(currentQuestionIndex);
                    $('.question-button.current-button').removeClass('current-button');
                    $('.question-button[data-question-index="' + currentQuestionIndex + '"]').addClass('current-button');
                }
            });

            $('.next-button').click(function () {
                if (currentQuestionIndex < <?php echo $questionCount - 1; ?>) {
                    currentQuestionIndex++;
                    showQuestion(currentQuestionIndex);
                    $('.question-button.current-button').removeClass('current-button');
                    $('.question-button[data-question-index="' + currentQuestionIndex + '"]').addClass('current-button');
                }
            });

            showQuestion(currentQuestionIndex);

            function showQuestion(questionIndex) {
                $('.question').hide();
                $('#question-' + questionIndex).show();
                currentQuestionIndex = questionIndex;

                // Disable Previous button when on the first question
                if (questionIndex == 0) {
                    $('.prev-button').prop('disabled', true);
                } else {
                    $('.prev-button').prop('disabled', false);
                }

                // Disable Next button when on the last question
                if (questionIndex == <?php echo $questionCount - 1; ?>) {
                    $('.next-button').prop('disabled', true);
                } else {
                    $('.next-button').prop('disabled', false);
                }
            }
        });
    </script>
</body>

</html>