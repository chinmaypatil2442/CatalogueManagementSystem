<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
   $userName = 'Welcome, ' . $userName;
}

if (isset($_POST["submit"])) {
    $user = mysql_query_db("select * from user where RoleId='" . $_POST["role"] . "' and Email = '" . $_POST["email"] . "' and Password = '" . $_POST["password"] . "'");
    $user_count = mysql_num_db($user);
    $user_record = mysql_fetch_db($user);
    $user_json = json_encode($user_record);
    $_SESSION["user"] = $user_json;
    if ($user_count != 0) {
        header('location: index.php');
    } else {
        echo "<script type='text/javascript'>alert('Invalid Credentials.');</script>";
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

<body id="login_page" class="login_page">

    <!-- Script -->
    <script>
        window.onload = function() {
            localStorage.removeItem('role');
        }

        function myFunction(e) {
            // e.preventDefault();
            // alert(document.getElementsByName('role')[0].value);
            localStorage['role'] = document.getElementsByName('role')[0].value;
            // window.location.replace(window.location.href.replace('login', 'index'));
        }
    </script>
    <!-- end Script -->

    <!-- header -->
    <header class="header">
        <div class="header_top_section">
            <a class="button active" href="login.php">Login</a>
            <a class="button" href="signup.php">Sign Up</a>
        </div>

        <div class="header_bottom_section">
            <a class="button" href="index.php">Home</a>
            <a class="button" href="about.php">About</a>
            <a class="button" href="Blog.php">Forum</a>
        </div>
    </header>
    <!-- end header -->


    <!-- login section -->
    <section class="section_card">
        <div align="center">
            <h2>Login</h2>
        </div>
        <form method="POST" onsubmit="myFunction(event)">
            <table class="table_class">
                <tr>
                    <td>Email Id:</td>
                    <td><input type="email" name="email" required /></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>
                        <select name="role" required>
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
                    <td>Password:</td>
                    <td><input type="password" name="password" minlength="8" required /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Submit" /></td>
                </tr>
            </table>
        </form>
    </section>

    <!-- end login section -->




    <!-- footer -->
    <footer>
        <div class="footer_bot_section">
            <span>All Rights Reserved.</span>
        </div>
    </footer>
    <!-- end footer -->



</body>

</html>