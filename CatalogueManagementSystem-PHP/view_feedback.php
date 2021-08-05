<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
   $userName = 'Welcome, ' . $userName;
}

$deptId = json_decode($_SESSION["user"])->DepartmentId;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Custom styles for this template -->
    <link href="cataloguesystem.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS</title>
</head>

<body id="view_feedback_page" class="view_feedback_page">

    <!-- Script -->
    <script>
        window.onload = function() {
            value = localStorage["role"];
            if (value != undefined) {
                document.getElementById('logout').style.display = "inline-block";
                document.getElementById('login').style.display = "none";
                document.getElementById('signup').style.display = "none";
                if (value == '1') {
                    document.getElementById('courses').style.display = "inline-block";
                    document.getElementById('feedback').style.display = "inline-block";
                } else if (value == '2') {
                    document.getElementById('upcoming_courses').style.display = "inline-block";
                    document.getElementById('view_courses').style.display = "inline-block";
                    document.getElementById('view_feedback').style.display = "inline-block";
                } else if (value == '3') {
                    document.getElementById('users').style.display = "inline-block";
                }
            } else {
                document.getElementById('login').style.display = "inline-block";
                document.getElementById('signup').style.display = "inline-block";
                document.getElementById('logout').style.display = "none";
            }
        }
    </script>
    <!-- end Script -->

    <!-- header -->
    <header class="header">
        <div class="header_top_section" id="header_top_section">
            <span style="color: white;float: left;margin: 7px;"><?php echo $userName ?></span>
            <a class="button hidden" href="login.php" id="login">Login</a>
            <a class="button hidden" href="signup.php" id="signup">Sign Up</a>
            <a class="button hidden" href="logout.php" id="logout">Logout</a>
        </div>

        <div class="header_bottom_section">
            <a class="button" href="index.php">Home</a>
            <a class="button" href="about.php">About</a>
            <a class="button" href="Blog.php">Forum</a>
            <a class="button hidden" href="courses.php" id="courses">List of Courses</a>
            <a class="button hidden" href="feedback.php" id="feedback">Feedback</a>
            <a class="button hidden" href="upcoming_courses.php" id="upcoming_courses">Upcoming Courses</a>
            <a class="button hidden" href="view_courses.php" id="view_courses">View Courses</a>
            <a class="button hidden active" href="view_feedback.php" id="view_feedback">View Feedback</a>
            <a class="button hidden" href="users.php" id="users">Users</a>
        </div>
    </header>
    <!-- end header -->

    <!-- view_feedback section -->
    <section class="section_card">
        <div align="center">
            <h2>View Planned Courses</h2>
        </div>

        <?php
        $courses = mysql_query_db('select * from `course-term` INNER JOIN course ON `course-term`.CourseId=course.Id WHERE course.DepartmentId = ' . $deptId);
        while ($course = mysql_fetch_db($courses)) {
        ?>
            <div class="card" style="width: 100%;">
                <div class="container">
                    <h4><b><?php echo $course["Name"] ?></b></h4>
                    <p><u>Prof</u> - <?php echo $course["ProfessorName"] ?> <u>Term</u> - <?php echo $course["Term"] ?> <u>Class</u> - <?php echo $course["Class"] ?></p>
                    <table class="table" style="text-align: justify;">
                        <tr>
                            <td><b>Feedbacks: </b></td>
                        </tr>
                        <?php
                        $feedbacks = mysql_query_db('select * from feedback WHERE `Course-TermId` = ' . $course['0']);
                        while ($fb = mysql_fetch_db($feedbacks)) {
                            // print_r($fb["Feedback"]);
                            // die();
                        ?>
                            <tr>
                                <td><u>Anonymous</u> -
                                    <span style="text-align: justify;"><?php echo $fb["Feedback"] ?></p>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        <?php
        }
        ?>

        <!-- end view_feedback section -->

        <!-- footer -->
        <footer>
            <div class="footer_bot_section">
                <span>All Rights Reserved.</span>
            </div>
        </footer>
        <!-- end footer -->
</body>

</html>