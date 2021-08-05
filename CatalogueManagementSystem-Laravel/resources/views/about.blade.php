@extends('base')

@section('main')

<section class="section_card">
    <div class="about_img_div">
        <img src="{{URL::asset('/images/about_pic.jpeg')}}" alt="Picture" class="about_image" />
    </div>
    <div class="about_text_div">
        <p class="about_text">
            This is a Catalogue Management System. Every university has a unique set of classes made with special editions by professors. These courses could sometime become difficult to manage by the organizing department. And, this can lead to further mess when students register for their classes. The Catalogue Management System provides a solution to this problem.
        </p>
    </div>
</section>


@endsection
