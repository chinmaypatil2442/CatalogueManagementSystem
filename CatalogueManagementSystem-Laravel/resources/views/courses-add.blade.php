@extends('base')

@section('main')
<?php

use Illuminate\Support\Facades\Session;

$type = Session::get('courses-add');
?>
<section class="section_card">
    @if ($type == 'upcoming')
    <a href="{{ url('/upcoming_courses') }}">Go back</a>
    @else
    <a href="{{ url('/view_courses') }}">Go back</a>
    @endif
    <div align="center">
        <h2>Add a Course: </h2>
    </div>


    <form method="POST" name="courses_add_form" id="courses_add_form" action="course_add">
        @csrf
        <table class="table_class">
            <tr>
                <td>Course Name:</td>
                <td><input type="text" name="CourseName" minlength="3" required /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Add" /></td>
            </tr>

        </table>
    </form>
</section>

@endsection
