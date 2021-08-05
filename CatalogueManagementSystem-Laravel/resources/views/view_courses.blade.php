<?php


// if (isset($_POST["course_add"]) && $_POST["course_add"] != '') {
//     $_SESSION['courses-add'] = $_POST["course_add"];
//     header('location: courses-add.php');
// }

// if (isset($_POST["delete"]) && $_POST["delete"] != '') {
//     mysql_query_db("delete from course where Id = " . $_POST["delete"]);
// }
//
?>

@extends('base')

@section('main')


<!-- Script -->
<script>
    function course_add_func() {
        document.getElementById('delete').value = '';
        document.getElementById('course_add').value = 'planned';
        document.getElementById("planned_courses_form").submit();
    }

    function delete_course(id, name) {
        var delete_flag = confirm('Are you sure you want to delete this Upcoming Course: ' + name);
        if (delete_flag == true) {
            document.getElementById('course_add').value = '';
            document.getElementById('delete').value = id;
            document.getElementById("planned_courses_form").submit();
        }
    }
</script>
<!-- end Script -->



<!-- view_courses section -->
<form method="POST" name="planned_courses_form" id="planned_courses_form" action="vw_course">
    @csrf

    <section class="section_card">
        <div align="center">
            <h2>View Planned Courses</h2>
        </div>
        <div align="center">
            <button onclick="course_add_func()" id="course_add_button" name="course_add_button">Add a course to the list</button>
        </div>

        <?php
        // $deptId = json_decode($_SESSION['user'])->DepartmentId;
        // $courses = mysql_query_db('select * from course where Type = "planned" and DepartmentId = ' . $deptId);
        // while ($course = mysql_fetch_db($courses)) {
        ?>
        @foreach($courses as $course)
        <div class="card">
            <img src="images/course.jpg" alt="Avatar" class="users_image">
            <div class="container">
                <h4><b>{{$course->Name}}</b></h4>
                <table class="table">
                    <tr>
                        <td onclick="delete_course('{{$course->Id}}','{{$course->Name}}')" class="cell">Delete</td>
                    </tr>

                </table>
            </div>
        </div>
        @endforeach
        <?php
        // }
        ?>

        <input id="delete" name="delete" type="text" hidden />
        <input id="course_add" name="course_add" type="text" hidden />
    </section>
</form>
<!-- end view_courses section -->

@if(Session::has('VCmessage'))
<script type='text/javascript'>
    alert("{{Session::get('VCmessage')}}");
</script>
@endif


@endsection
