@extends('base')

@section('main')

<section class="section_card">
    <form method="POST" name="feedback_form" id="feedback_form" action="{{ route('fb') }}">
        @csrf
        <div align="center">
            <h2>Feedback about the Courses</h2>
            <a href="mailto:@asd@asd">Write an email.</a>
            <br><br><br>
            <b>OR</b>
            <br><br><br>
            <table class="table_class">
                <tr>
                    <td>Select Course:</td>
                    <td><select name="enrolled_courses" required>
                            <?php
                            // $enrl_courses = mysql_query_db("select `student-enrollment`.`Course-TermId`, course.Name from ((`student-enrollment` INNER JOIN `course-term` ON `student-enrollment`.`Course-TermId`= `course-term`.Id) INNER JOIN course ON `course-term`.CourseId=course.Id) where `student-enrollment`.UserId ='" . $userId . "'");
                            // while ($enrl_course = mysql_fetch_db($enrl_courses)) {
                            ?>

                            @foreach($enrl_courses as $enrl_course)
                            <?php
                            // print_r($enrl_courses);
                            // die();
                            ?>
                            <option value="<?php echo  $enrl_course->{'Course-TermId'} ?>">{{ $enrl_course->Name}}</option>
                            @endforeach
                            <?php
                            // }
                            ?>
                        </select></td>
                </tr>

                <tr>
                    <td>Enter Feedback:</td>
                    <td><textarea name="feedback" required></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Submit" />
                    </td>
                </tr>
            </table>
    </form>
    </div>



    @if(Session::has('FBmessage'))
    <!-- <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p> -->
    <script type='text/javascript'>
        alert("{{Session::get('FBmessage')}}");
    </script>
    @endif

    @endsection
