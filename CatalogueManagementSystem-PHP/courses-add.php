<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
    $userName = 'Welcome, ' . $userName;
}

$type = $_SESSION['courses-add'];


if (isset($_POST["submit"])) {
    $type = $_SESSION['courses-add'];
    $deptId = json_decode($_SESSION["user"])->DepartmentId;
    mysql_query_db("insert into course set DepartmentId='" . $deptId . "', Name='" . $_POST["CourseName"] . "',Type='" . $type . "'");
    $message = "Success!!!";
    echo "<script type='text/javascript'>alert('$message');</script>";
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
            <a class="button hidden <?php if ($type == 'upcoming') echo "active"; ?>" href="upcoming_courses.php" id="upcoming_courses">Upcoming Courses</a>
            <a class="button hidden <?php if ($type == 'planned') echo "active"; ?> " href="view_courses.php" id="view_courses">View Courses</a>
            <a class="button hidden" href="view_feedback.php" id="view_feedback">View Feedback</a>
            <a class="button hidden" href="users.php" id="users">Users</a>
        </div>
    </header>
    <!-- end header -->

    <!-- upcoming_courses section -->
    <section class="section_card">
        <a href="<?php if ($type == 'upcoming') echo "upcoming_courses.php";
                    else echo "view_courses.php" ?>">
            < Go back</a> <div align="center">
                <h2>Add a Course: </h2>
                </div>


                <form method="POST" name="courses_add_form" id="courses_add_form">
                    <table class="table_class">
                        <tr>
                            <td>Course Name:</td>
                            <td><input type="text" name="CourseName" minlength="3" required /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Add" /></td>
                        </tr>

                    </table>
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