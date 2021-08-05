<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
   $userName = 'Welcome, ' . $userName;
}

$CourseId = $_SESSION['upcoming_courses-edit'];
$courses = mysql_query_db('select * from course where Id = ' . $CourseId);
$course = mysql_fetch_db($courses);


if (isset($_POST["delete"]) && $_POST["delete"] != '') {
    mysql_query_db("delete from `course-term` where Id = " . $_POST["delete"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Custom styles for this template -->
    <link href="cataloguesystem.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CMS</title>
</head>

<body id="upcoming_courses_add_page" class="upcoming_courses_add_page">

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

        function delete_course(id, name) {
            var delete_flag = confirm('Are you sure you want to remove this course: ' + name);
            if (delete_flag == true) {
                document.getElementById('delete').value = id;
                document.getElementById("upcoming_courses_edit_form").submit();
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
            <a class="button hidden active" href="upcoming_courses.php" id="upcoming_courses">Upcoming Courses</a>
            <a class="button hidden" href="view_courses.php" id="view_courses">View Courses</a>
            <a class="button hidden" href="view_feedback.php" id="view_feedback">View Feedback</a>
            <a class="button hidden" href="users.php" id="users">Users</a>
        </div>
    </header>
    <!-- end header -->

    <!-- upcoming_courses section -->
    <section class="section_card">
        <a href="upcoming_courses.php">
            < Go back</a> <div align="center">
                <h2>Edit classes for <?php echo $course["Name"] ?> Course for Upcoming Semester: </h2>
                </div>
                <?php
                $courses = mysql_query_db('select * from `course-term` INNER JOIN course ON `course-term`.CourseId=course.Id WHERE `course-term`.CourseId = ' . $CourseId);
                while ($course = mysql_fetch_db($courses)) {
                    // print_r($course);
                    // die();
                ?>
                    <div class="card">
                        <img src="images/course.jpg" alt="Avatar" class="users_image">
                        <div class="container">
                            <h4><b><?php echo $course["Name"] ?></b></h4>
                            <p><?php echo $course["ProfessorName"] ?></p>
                            <p><?php echo $course["Term"] ?></p>
                            <p><?php echo $course["Class"] ?></p>
                            <table class="table">
                                <tr>
                                    <td onclick="delete_course(<?php echo $course['0'] ?>,'<?php echo $course['Name'] ?>')" class="cell">Delete</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                <?php
                }
                ?>

                <form method="POST" name="upcoming_courses_edit_form" id="upcoming_courses_edit_form">
                    <input id="delete" name="delete" type="text" hidden />
                </form>

                <!-- end upcoming_courses section -->

                <!-- footer -->
                <footer>
                    <div class="footer_bot_section">
                        <span>All Rights Reserved.</span>
                    </div>
                </footer>
                <!-- end footer -->
</body>

</html>