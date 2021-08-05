<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
   $userName = 'Welcome, ' . $userName;
}


$id = $_SESSION['users-edit'];
// unset($_SESSION['users-edit']);
$user = mysql_query_db("select * from user where Id = " . $id);
$user_record = mysql_fetch_db($user);

?>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script> -->

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

<body id="users_edit_page" class="users_edit_page">

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
            <a class="button hidden" href="view_feedback.php" id="view_feedback">View Feedback</a>
            <a class="button hidden active" href="users.php" id="users">Users</a>
        </div>
    </header>
    <!-- end header -->

    <!-- user section -->
    <section class="section_card">
        <a href="users.php">
            < Go back</a> <div align="center">
                <h2>Edit User: </h2>
                </div>

                <form method="POST" name="users_edit_form" id="users_edit_form">
                    <table class="table_class">
                        <tr>
                            <td>Name:</td>
                            <td><input type="text" name="name" minlength="3" value="<?php echo $user_record['Name'] ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Email Id:</td>
                            <td><input type="email" name="email" value="<?php echo $user_record['Email'] ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Role:</td>
                            <td><select name="role" id="role" required>
                                    <?php
                                    $roles = mysql_query_db('select * from role');
                                    while ($role = mysql_fetch_db($roles)) {
                                    ?>
                                        <option value="<?php echo $role["Id"] ?>" <?php if ($role['Id'] == $user_record['RoleId'])  echo ' selected="selected"'; ?>>
                                            <?php echo $role["Name"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Department:</td>
                            <td><select name="department" required>
                                    <?php
                                    $departments = mysql_query_db('select * from department');
                                    while ($dept = mysql_fetch_db($departments)) {
                                    ?>
                                        <option value="<?php echo $dept["Id"] ?>" <?php if ($dept['Id'] == $user_record['DepartmentId'])  echo ' selected="selected"'; ?>><?php echo $dept["Name"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Register" /></td>
                        </tr>

                    </table>

                </form>


    </section>

    <!-- end user section -->

    <!-- footer -->
    <footer>
        <div class="footer_bot_section">
            <span>All Rights Reserved.</span>
        </div>
    </footer>
    <!-- end footer -->
</body>

</html>