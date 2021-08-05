<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
   $userName = 'Welcome, ' . $userName;
}

if (isset($_POST["delete"]) && $_POST["delete"] != '') {
    mysql_query_db("delete from user where Id = " . $_POST["delete"]);
}

if (isset($_POST["edit"]) && $_POST["edit"] != '') {
    $_SESSION['users-edit'] = $_POST["edit"];
    header('location: users-edit.php');
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

<body id="users_page" class="users_page">

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

        function delete_user(id, name) {
            var delete_flag = confirm('Are you sure you want to delete user: ' + name);
            if (delete_flag == true) {
                document.getElementById('edit').value = '';
                document.getElementById('delete').value = id;
                document.getElementById("users_form").submit();
            }
        }

        function edit_user(user) {
            document.getElementById('delete').value = '';
            document.getElementById('edit').value = user;
            document.getElementById("users_form").submit();
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
        <div align="center">
            <h2>Users</h2>
        </div>
        <?php
        $users = mysql_query_db('select user.ID, user.Name, user.Email, department.Name, role.Name from ((user INNER JOIN department ON user.DepartmentId = department.Id) INNER JOIN role ON user.RoleId = role.Id)');
        while ($user = mysql_fetch_db($users)) {
        ?>
            <div class="card">
                <!-- citation: Image-avatar.png Referred from:- https://images.pexels.com/photos/546819/pexels-photo-546819.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260 -->
                <img src="images/avatar.png" alt="Avatar" class="users_image">
                <div class="container">
                    <h4><?php echo $user["1"] ?></h4>
                    <b><?php echo $user["2"] ?></b>
                    <p><?php echo $user["3"] ?></p>
                    <p><?php echo $user["4"] ?></p>
                    <table class="table">
                        <tr>
                            <!-- <td onclick="alert('Add.')" class="cell">Add</td> -->
                            <td onclick="edit_user(<?php echo $user['0'] ?>)" class="cell">Edit</td>
                            <td onclick="delete_user(<?php echo $user['0'] ?>,'<?php echo $user['1'] ?>')" class="cell">Delete</td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php
        }
        ?>
        <form method="POST" name="users_form" id="users_form">
            <input id="delete" name="delete" type="text" hidden />
            <input id="edit" name="edit" type="text" hidden />

        </form>
        <!-- <div class="card">
            <img src="images/avatar.png" alt="Avatar" class="users_image">
            <div class="container">
                <h4><b>Jane Doe</b></h4>
                <p>Student</p>
                <table class="table">
                    <tr>
                        <td onclick="alert('Add.')" class="cell">Add</td>
                        <td onclick="alert('Edit.')" class="cell">Edit</td>
                        <td onclick="alert('Delete.')" class="cell">Delete</td>
                    </tr>
                </table>
            </div>
        </div> -->

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