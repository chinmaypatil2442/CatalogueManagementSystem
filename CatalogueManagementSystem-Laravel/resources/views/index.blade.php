@extends('base')

@section('main')
<section class="section_card">
    <div align="center">
        <h2>Catalogue Management System</h2>
    </div>
    <div align="center">
        <p>List of departments:</p>
    </div>
    @foreach($departments as $department)
    <div class="click_department">
        <div class="department_list">
            <p class="title">{{$department->Name}}</p>
        </div>
    </div>
    @endforeach
</section>
@endsection
