<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
   $userName = 'Welcome, ' . $userName;
}

$userId = json_decode($_SESSION["user"])->Id;

if (isset($_POST["submit"])) {
    $stud_feed = mysql_query_db("select * from feedback where UserId='" . $userId . "' and `Course-TermId` = '" . $_POST["enrolled_courses"] . "'");
    $stud_feed_count = mysql_num_db($stud_feed);
    if ($stud_feed_count == 0) {
        mysql_query_db("insert into feedback set UserId ='" . $userId . "', `Course-TermId` = '" . $_POST["enrolled_courses"] . "',  Feedback = '" . $_POST["feedback"] . "'");
        $_POST = array();
        $message = "Feedbcak Submitted Successfully!!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        $message2 = 'A student can submit feedbaack once per course.';
        echo "<script type='text/javascript'>alert('$message2');</script>";
    }
}
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

<body id="feedback_page" class="feedback_page">

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
            <a class="button hidden active" href="feedback.php" id="feedback">Feedback</a>
            <a class="button hidden" href="upcoming_courses.php" id="upcoming_courses">Upcoming Courses</a>
            <a class="button hidden" href="view_courses.php" id="view_courses">View Courses</a>
            <a class="button hidden" href="view_feedback.php" id="view_feedback">View Feedback</a>
            <a class="button hidden" href="users.php" id="users">Users</a>
        </div>
    </header>
    <!-- end header -->

    <!-- feedback section -->
    <section class="section_card">
        <form method="POST" name="feedback_form" id="feedback_form">
            <div align="center">
                <h2>Feedback about the Courses</h2>
                <a href="mailto:@asd@asd">Write an email.</a>
                <br><br><br>
                <b>OR</b>
                <br><br><br>
                <table class="table_class">
                    <tr>
                        <td>Select Course:</td>
                        <td><select name="enrolled_courses" required>
                                <?php
                                $enrl_courses = mysql_query_db("select `student-enrollment`.`Course-TermId`, course.Name from ((`student-enrollment` INNER JOIN `course-term` ON `student-enrollment`.`Course-TermId`= `course-term`.Id) INNER JOIN course ON `course-term`.CourseId=course.Id) where `student-enrollment`.UserId ='" . $userId . "'");
                                while ($enrl_course = mysql_fetch_db($enrl_courses)) {
                                ?>
                                    <option value="<?php echo $enrl_course["Course-TermId"] ?>"><?php echo $enrl_course["Name"] ?></option>
                                <?php
                                }
                                ?>
                            </select></td>
                    </tr>

                    <tr>
                        <td>Enter Feedback:</td>
                        <td><textarea name="feedback" required></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Submit" />
                        </td>
                    </tr>
                </table>
        </form>
        </div>



        <!-- end feedback section -->

        <!-- footer -->
        <footer>
            <div class="footer_bot_section">
                <span>All Rights Reserved.</span>
            </div>
        </footer>
        <!-- end footer -->
</body>

</html>