<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
   $userName = 'Welcome, ' . $userName;
}


if (isset($_POST["submit"]) && ($_POST["password"] == $_POST["confirm_password"])) {
    $same_user = mysql_query_db("select Id from user where Email = '" . $_POST["email"] . "'");
    $same_user_count = mysql_num_db($same_user);
    if ($same_user_count == 0) {
        mysql_query_db("insert into user set RoleId='" . $_POST["role"] . "',DepartmentId='" . $_POST["department"] . "',Name='" . $_POST["name"] . "',Email='" . $_POST["email"] . "',Password='" . $_POST["password"] . "'");
        $message = "Success!!!";
        echo "<script type='text/javascript'>alert('$message');</script>";

        $to_email = $_POST["email"];
        $subject = "Catalogue Management System";
        $body = "Hi,\n These are your credentials for your account:\n Email: ". $_POST["email"]. "\n Password: ". $_POST["password"];
        $headers = 'From: cjp1732@mavs.uta.edu.com';
        $flag = mail($to_email, $subject, $body, $headers);
        if ($flag) {
            $succ_msg = 'Mail successfully sent to: ' . $to_email;
            echo "<script type='text/javascript'>alert('$succ_msg');</script>";
        } else {
            $fail_msg = 'Mail failed to send to: ' . $to_email;
            echo "<script type='text/javascript'>alert('$to_email');</script>";
        }

        header('location: login.php');
    } else {
        echo "<script type='text/javascript'>alert('User with same Email Id already exists.');</script>";
    }
}
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
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

<body id="signup_page" class="signup_page">

    <!-- header -->
    <header class="header">
        <div class="header_top_section">
            <a class="button" href="login.php">Login</a>
            <a class="button active" href="signup.php">Sign Up</a>
        </div>

        <div class="header_bottom_section">
            <a class="button" href="index.php">Home</a>
            <a class="button" href="about.php">About</a>
            <a class="button" href="Blog.php">Forum</a>
        </div>
    </header>
    <!-- end header -->


    <!-- Signup section -->
    <section class="section_card">
        <div align="center">
            <h2>Sign Up</h2>
        </div>
        <form method="POST" id="signup_form" name="signup_form" action="">
            <table class="table_class">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" minlength="3" required /></td>
                </tr>
                <tr>
                    <td>Email Id:</td>
                    <td><input type="email" name="email" required /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" id="password" name="password" minlength="8" required /></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" id="confirm_password" name="confirm_password" onkeyup="validate_confirm_password()" minlength="8" required /></td>
                <tr>
                    <td></td>
                    <td>
                        <div id="match_password"></div>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td><select name="role" required>
                            <?php
                            $roles = mysql_query_db('select * from role');
                            while ($role = mysql_fetch_db($roles)) {
                            ?>
                                <option value="<?php echo $role["Id"] ?>"><?php echo $role["Name"] ?></option>
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
                                <option value="<?php echo $dept["Id"] ?>"><?php echo $dept["Name"] ?></option>
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

    <!-- end Signup section -->
    <script>
        $("#signup_form").submit(function(event) {
            var confirm_password = document.getElementById('confirm_password').value;
            var password = document.getElementById('password').value;
            if (confirm_password != password) {
                event.preventDefault();
            }
        });

        function validate_confirm_password() {
            var confirm_password = document.getElementById('confirm_password').value;
            var password = document.getElementById('password').value;
            if (confirm_password == password) {
                document.getElementById("match_password").innerHTML = "<span style='color:green;'>Correct</span>";
            } else {
                document.getElementById("match_password").innerHTML = "<span style='color:red;'>Wrong</span>";
            }
        }
    </script>




    <!-- footer -->
    <footer>
        <div class="footer_bot_section">
            <span>All Rights Reserved.</span>
        </div>
    </footer>
    <!-- end footer -->
</body>

</html>