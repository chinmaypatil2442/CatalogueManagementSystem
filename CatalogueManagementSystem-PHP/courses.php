<?php
require_once('common.php');
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
   $userName = 'Welcome, ' . $userName;
}

$userId = json_decode($_SESSION["user"])->Id;
$deptId = json_decode($_SESSION["user"])->DepartmentId;

if (isset($_POST["enroll"]) && $_POST["enroll"] != '') {
   $stud_enrl = mysql_query_db("select * from `student-enrollment` where UserId='" . $userId . "' and `Course-TermId` = '" . $_POST["enroll"] . "'");
   $stud_enrl_count = mysql_num_db($stud_enrl);
   if ($stud_enrl_count == 0) {
      mysql_query_db("insert into `student-enrollment` set UserId ='" . $userId . "', `Course-TermId` = '" . $_POST["enroll"] . "',  Status = 'enrolled'");
      $_POST = array();
      $message = "Enrolled Successfully!!!";
      echo "<script type='text/javascript'>alert('$message');</script>";
   } else {
      $message2 = 'A student can enroll once per course per Term.';
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

<body id="course_page" class="course_page">

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

      function enroll_course(id, name) {
         var delete_flag = confirm('Are you sure you want to Enroll for this course: ' + name);
         if (delete_flag == true) {
            document.getElementById('enroll').value = id;
            document.getElementById("courses_form").submit();
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
         <a class="button hidden active" href="courses.php" id="courses">List of Courses</a>
         <a class="button hidden" href="feedback.php" id="feedback">Feedback</a>
         <a class="button hidden" href="upcoming_courses.php" id="upcoming_courses">Upcoming Courses</a>
         <a class="button hidden" href="view_courses.php" id="view_courses">View Courses</a>
         <a class="button hidden" href="view_feedback.php" id="view_feedback">View Feedback</a>
         <a class="button hidden" href="users.php" id="users">Users</a>
      </div>
   </header>
   <!-- end header -->

   <!-- courses section -->
   <section class="section_card">
      <div align="center">
         <h2>Courses Offered</h2>
      </div>
      <div align="center">
         <p>Choose your courses:</p>
      </div>

      <?php
      $courses = mysql_query_db('select * from `course-term` INNER JOIN course ON `course-term`.CourseId=course.Id WHERE course.DepartmentId = ' . $deptId);
      while ($course = mysql_fetch_db($courses)) {
         // print_r($course);
         // die();
      ?>

         <!-- citation: Card view Referred from:- https://www.w3schools.com/howto/howto_css_cards.asp -->
         <div class="card">
            <!-- citation Image-course.jpg referred from:-  https://www.adcet.edu.au/cms/file/29/academic.jpg -->
            <img src="images/course.jpg" alt="Avatar" class="users_image">
            <div class="container">
               <h4><b><?php echo $course["Name"] ?></b></h4>
               <p>Prof - <?php echo $course["ProfessorName"] ?></p>
               <p>Term - <?php echo $course["Term"] ?></p>
               <p>Class - <?php echo $course["Class"] ?></p>
               <table class="table">
                  <tr>
                     <td onclick="enroll_course(<?php echo $course['0'] ?>,'<?php echo $course['Name'] ?>')" class="cell">Enroll</td>
                  </tr>
               </table>
            </div>
         </div>

      <?php
      }
      ?>

      <form method="POST" name="courses_form" id="courses_form">
         <input id="enroll" name="enroll" type="text" hidden />
      </form>

      <!--   <div class="card">
         <img src="images/course.jpg" alt="Avatar" class="users_image">
         <div class="container">
            <h4><b>CSE 5334 - Data Mining</b></h4>
            <p>Professor - Jane Doe</p>
            <table class="table">
               <tr>
                  <td onclick="alert('Enroll.')" class="cell">Enroll</td>
               </tr>
            </table>
         </div>
      </div> -->

      <!-- end courses section -->

      <!-- footer -->
      <footer>
         <div class="footer_bot_section">
            <span>All Rights Reserved.</span>
         </div>
      </footer>
      <!-- end footer -->
</body>

</html>