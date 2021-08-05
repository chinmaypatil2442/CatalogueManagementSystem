<?php
// require_once('common.php');
// session_start();
// $userName = json_decode($_SESSION["user"])->Name;
// if (isset($userName)) {
//     $userName = 'Welcome, ' . $userName;
// }

// if (isset($_POST["delete"]) && $_POST["delete"] != '') {
//     mysql_query_db("delete from course where Id = " . $_POST["delete"]);
//     mysql_query_db("delete from `course-term` where CourseId = " . $_POST["delete"]);
// }

// if (isset($_POST["edit"]) && $_POST["edit"] != '') {
//     $_SESSION['upcoming_courses-edit'] = $_POST["edit"];
//     header('location: upcoming_courses-edit.php');
// }

// if (isset($_POST["add"]) && $_POST["add"] != '') {
//     $_SESSION['upcoming_courses-add'] = $_POST["add"];
//     header('location: upcoming_courses-add.php');
// }

// if (isset($_POST["course_add"]) && $_POST["course_add"] != '') {
//     $_SESSION['courses-add'] = $_POST["course_add"];
//     header('location: courses-add.php');
// }

?>


@extends('base')

@section('main')

<!-- Script -->
<script>
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

<!-- upcoming_courses section -->
<form method="POST" name="upcoming_courses_form" id="upcoming_courses_form" action="{{ route('up_course') }}">
    @csrf
    <section class="section_card">
        <div align="center">
            <h2>Courses for Upcoming Semester</h2>
        </div>
        <div align="center">
            <button onclick="course_add_func()" id="course_add_button" name="course_add_button">Add a course to the list</button>
        </div>

        <?php
        // $deptId = json_decode($_SESSION['user'])->DepartmentId;
        // $courses = mysql_query_db('select * from course where Type = "upcoming" and DepartmentId = ' . $deptId);
        // while ($course = mysql_fetch_db($courses)) {
        ?>
        @foreach($courses as $course)
        <div class="card">
            <img src="images/course.jpg" alt="Avatar" class="users_image">
            <div class="container">
                <h4><b>{{ $course->Name }}</b></h4>
                <table class="table">
                    <tr>
                        <td onclick="add_course(<?php echo $course->Id ?>)" class="cell">Add</td>
                        <td onclick="edit_course(<?php echo $course->Id ?>)" class="cell">Edit</td>
                        <td onclick="delete_course(<?php echo $course->Id ?>,'<?php echo $course->Name ?>')" class="cell">Delete</td>
                    </tr>

                </table>
            </div>
        </div>
        @endforeach

        <?php
        // }
        ?>

        <input id="delete" name="delete" type="text" hidden />
        <input id="edit" name="edit" type="text" hidden />
        <input id="add" name="add" type="text" hidden />
        <input id="course_add" name="course_add" type="text" hidden />

    </section>
</form>


<!-- end upcoming_courses section -->
@if(Session::has('UCmessage'))
<script type='text/javascript'>
    alert("{{Session::get('UCmessage')}}");
</script>
@endif
@endsection
