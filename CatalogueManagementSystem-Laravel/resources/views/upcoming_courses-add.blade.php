@extends('base')

@section('main')

<!-- upcoming_courses section -->
<section class="section_card">
    <a href="{{ url('/upcoming_courses') }}">Go back</a>
    <div align="center">
        <h2>Add a class for {{$courseName}} Course for Upcoming Semester: </h2>
    </div>


    <form method="POST" name="upcoming_courses_add_form" id="upcoming_courses_add_form" action="up_course_add">
        @csrf
        <table class="table_class">
            <tr>
                <td>Professor Name:</td>
                <td><input type="text" name="ProfessorName" minlength="3" required /></td>
            </tr>
            <tr>
                <td>Term:</td>
                <td><input type="text" name="Term" minlength="3" required /></td>
            </tr>
            <tr>
                <td>Class:</td>
                <td><input type="text" name="Class" required /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Register" /></td>
            </tr>

        </table>
    </form>


    <!-- end upcoming_courses section -->

</section>
@endsection
