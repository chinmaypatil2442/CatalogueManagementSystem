@extends('base')

@section('main')
<!-- Script -->
<script>
    function delete_course(id, name) {
        var delete_flag = confirm('Are you sure you want to remove this course: ' + name);
        if (delete_flag == true) {
            document.getElementById('delete').value = id;
            document.getElementById("upcoming_courses_edit_form").submit();
        }
    }
</script>
<!-- end Script -->


<!-- upcoming_courses section -->
<section class="section_card">
    <a href="{{ url('/upcoming_courses') }}">Go back</a>
    <div align="center">
        <h2>Edit classes for {{$courseName}} Course for Upcoming Semester: </h2>
    </div>



    @foreach($courses as $course)
    <!-- citation: Card view Referred from:- https://www.w3schools.com/howto/howto_css_cards.asp -->
    <div class="card">
        <!-- citation Image-course.jpg referred from:-  https://www.adcet.edu.au/cms/file/29/academic.jpg -->
        <img src="{{URL::asset('/images/course.jpg')}}" alt="Avatar" class="users_image">
        <div class="container">
            <h4><b>{{$course->Name}}</b></h4>
            <p>Prof -{{ $course->ProfessorName}}</p>
            <p>Term -{{ $course->Term}}</p>
            <p>Class - {{$course->Class}}</p>
            <table class="table">
                <tr>
                    <td onclick="delete_course(<?php echo $course->Id ?>,'<?php echo $course->Name ?>')" class="cell">Delete</td>
                </tr>
            </table>
        </div>
    </div>
    @endforeach



    <form method="POST" name="upcoming_courses_edit_form" id="upcoming_courses_edit_form" action="up_course_edit">
        @csrf
        <input id="delete" name="delete" type="text" hidden />
    </form>

    <!-- end upcoming_courses section -->

</section>
@endsection
