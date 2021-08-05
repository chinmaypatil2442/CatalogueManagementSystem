<?php


use Illuminate\Support\Facades\DB;


?>

@extends('base')

@section('main')
<!-- view_feedback section -->
<section class="section_card">
    <div align="center">
        <h2>View Planned Courses</h2>
    </div>

    <?php
    // $courses = mysql_query_db('select * from `course-term` INNER JOIN course ON `course-term`.CourseId=course.Id WHERE course.DepartmentId = ' . $deptId);
    // while ($course = mysql_fetch_db($courses)) {
    ?>
    @foreach($courses as $course)

    <div class="card" style="width: 100%;">
        <div class="container">
            <h4><b> {{$course->Name}} </b></h4>
            <p><u>Prof</u> - {{$course->ProfessorName}} <u>Term</u> - {{$course->Term}} <u>Class</u> - {{$course->Class}}</p>
            <table class="table" style="text-align: justify;">
                <tr>
                    <td><b>Feedbacks: </b></td>
                </tr>
                <?php


                $feedbacks = json_decode(DB::table('feedback')
                    ->select('*')
                    ->where(['Course-TermId' => $course->Id])
                    ->get());
                // $feedbacks = mysql_query_db('select * from feedback WHERE `Course-TermId` = ' . $course['0']);
                //  while ($fb = mysql_fetch_db($feedbacks)) {
                // print_r($feedbacks);
                // die();
                foreach ($feedbacks as $fb) {
                ?>
                    <tr>
                        <td><u>Anonymous</u> -
                            <span style="text-align: justify;">
                                {{$fb->Feedback }}
                                </p>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    <?php
    // }
    ?>
    @endforeach
</section>
<!-- end view_feedback section -->
@endsection
