<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
    $userName = 'Welcome, ' . $userName;
}

if (isset($_POST["delete"]) && $_POST["delete"] != '') {
    mysql_query_db("delete from course where Id = " . $_POST["delete"]);
    mysql_query_db("delete from `course-term` where CourseId = " . $_POST["delete"]);
}

if (isset($_POST["edit"]) && $_POST["edit"] != '') {
    $_SESSION['upcoming_courses-edit'] = $_POST["edit"];
    header('location: upcoming_courses-edit.php');
}

if (isset($_POST["add"]) && $_POST["add"] != '') {
    $_SESSION['upcoming_courses-add'] = $_POST["add"];
    header('location: upcoming_courses-add.php');
}

if (isset($_POST["course_add"]) && $_POST["course_add"] != '') {
    $_SESSION['courses-add'] = $_POST["course_add"];
    header('location: courses-add.php');
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

<body id="upcoming_courses_page" class="upcoming_courses_page">

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

        function add_course(id) {
            document.getElementById('delete').value = '';
            document.getElementById('edit').value = '';
            document.getElementById('course_add').value = '';
            document.getElementById('add').value = id;
            document.getElementById("upcoming_courses_form").submit();
        }

        function edit_course(id) {
            document.getElementById('add').value = '';
            document.getElementById('delete').value = '';
            document.getElementById('course_add').value = '';
            document.getElementById('edit').value = id;
            document.getElementById("upcoming_courses_form").submit();
        }

        function delete_course(id, name) {
            var delete_flag = confirm('Are you sure you want to remove this from Upcoming Courses to Planned Courses: ' + name +
                '\nWarning: This will also delete all the Course-Terms!');
            if (delete_flag == true) {
                document.getElementById('add').value = '';
                document.getElementById('edit').value = '';
                document.getElementById('course_add').value = '';
                document.getElementById('delete').value = id;
                document.getElementById("upcoming_courses_form").submit();
            }
        }

        function course_add_func() {
            document.getElementById('add').value = '';
            document.getElementById('delete').value = '';
            document.getElementById('edit').value = '';
            document.getElementById('course_add').value = 'upcoming';
            document.getElementById("upcoming_courses_form").submit();
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
    <form method="POST" name="upcoming_courses_form" id="upcoming_courses_form">
        <section class="section_card">
            <div align="center">
                <h2>Courses for Upcoming Semester</h2>
            </div>
            <div align="center">
                <button onclick="course_add_func()" id="course_add_button" name="course_add_button">Add a course to the list</button>
            </div>

            <?php
            $deptId = json_decode($_SESSION['user'])->DepartmentId;
            $courses = mysql_query_db('select * from course where Type = "upcoming" and DepartmentId = ' . $deptId);
            while ($course = mysql_fetch_db($courses)) {
            ?>
                <div class="card">
                    <img src="images/course.jpg" alt="Avatar" class="users_image">
                    <div class="container">
                        <h4><b><?php echo $course["Name"] ?></b></h4>
                        <table class="table">
                            <tr>
                                <td onclick="add_course(<?php echo $course['0'] ?>)" class="cell">Add</td>
                                <td onclick="edit_course(<?php echo $course['0'] ?>)" class="cell">Edit</td>
                                <td onclick="delete_course(<?php echo $course['0'] ?>,'<?php echo $course['Name'] ?>')" class="cell">Delete</td>
                            </tr>

                        </table>
                    </div>
                </div>
            <?php
            }
            ?>

            <input id="delete" name="delete" type="text" hidden />
            <input id="edit" name="edit" type="text" hidden />
            <input id="add" name="add" type="text" hidden />
            <input id="course_add" name="course_add" type="text" hidden />

        </section>
    </form>
    <!-- <div class="card">
            <img src="images/course.jpg" alt="Avatar" class="users_image">
            <div class="container">
                <h4><b>CSE 5321 - Software Testing</b></h4>
                <p>Professor - Jane Doe</p>
                <table class="table">
                    <tr>
                        <td onclick="alert('Add.')" class="cell">Add</td>
                        <td onclick="alert('Edit.')" class="cell">Edit</td>
                        <td onclick="alert('Delete.')" class="cell">Delete</td>
                    </tr>
                </table>
            </div>
        </div> -->

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