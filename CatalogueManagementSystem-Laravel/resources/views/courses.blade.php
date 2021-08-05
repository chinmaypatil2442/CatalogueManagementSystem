@extends('base')

@section('main')

<script>
    function enroll_course(id, name) {
        var delete_flag = confirm('Are you sure you want to Enroll for this course: ' + name);
        if (delete_flag == true) {
            document.getElementById('enroll').value = id;
            document.getElementById("courses_form").submit();
        }
    }
</script>

<section class="section_card">
    <div align="center">
        <h2>Courses Offered</h2>
    </div>
    <div align="center">
        <p>Choose your courses:</p>
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
                    <td onclick="enroll_course(<?php echo $course->Id ?>,'<?php echo $course->Name ?>')" class="cell">Enroll</td>
                </tr>
            </table>
        </div>
    </div>
    @endforeach



    <form method="POST" name="courses_form" id="courses_form" action="{{ route('enroll') }}">
        @csrf
        <input id="enroll" name="enroll" type="text" hidden />
    </form>

    @if(Session::has('message'))
    <script type='text/javascript'>
        alert("{{Session::get('message')}}");
    </script>
    @endif

    @endsection
