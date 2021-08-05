<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
   $userName = 'Welcome, ' . $userName;
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

<body id="home_page" class="home_page">

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
         <a class="button active" href="index.php">Home</a>
         <a class="button" href="about.php">About</a>
         <a class="button" href="Blog.php">Forum</a>
         <a class="button hidden" href="courses.php" id="courses">List of Courses</a>
         <a class="button hidden" href="feedback.php" id="feedback">Feedback</a>
         <a class="button hidden" href="upcoming_courses.php" id="upcoming_courses">Upcoming Courses</a>
         <a class="button hidden" href="view_courses.php" id="view_courses">View Courses</a>
         <a class="button hidden" href="view_feedback.php" id="view_feedback">View Feedback</a>
         <a class="button hidden" href="users.php" id="users">Users</a>
      </div>
   </header>
   <!-- end header -->

   <!-- department section -->
   <section class="section_card">
      <div align="center">
         <h2>Catalogue Management System</h2>
      </div>
      <div align="center">
         <p>List of departments:</p>
      </div>
      <?php
      $departments = mysql_query_db('select * from department');
      while ($dept = mysql_fetch_db($departments)) {
      ?>
         <div class="click_department">
            <div class="department_list">
               <p class="title"><?php echo $dept["Name"] ?></p>
            </div>
         </div>
      <?php
      }
      ?>
      <!-- <div class="click_department">
         <div class="department_list">
            <p class="title">Civil Engineering</p>
         </div>
      </div>
      <div class="click_department">
         <div class="department_list">
            <p class="title">Chemical Engineering</p>
         </div>
      </div> -->
   </section>

   <!-- end department section -->

   <!-- footer -->
   <footer>
      <div class="footer_bot_section">
         <span>All Rights Reserved.</span>
      </div>
   </footer>
   <!-- end footer -->
</body>

</html>