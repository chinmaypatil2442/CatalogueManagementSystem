<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\CourseTerm;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('base');
    return redirect('/index');
});

Route::get('/index', function () {
    $departments = Department::all();
    return view('index', compact('departments'));
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::resource('users', 'App\Http\Controllers\UserController');

Route::post('auth', ['as' => 'auth', 'uses' => 'App\Http\Controllers\LoginController@authenticate']);
Route::get('authoff', ['as' => 'authoff', 'uses' => 'App\Http\Controllers\LoginController@logout']);

Route::post('enroll', ['as' => 'enroll', 'uses' => 'App\Http\Controllers\LoginController@enrollCourseTerm']);
Route::post('fb', ['as' => 'fb', 'uses' => 'App\Http\Controllers\LoginController@submitFeedback']);
Route::post('up_course', ['as' => 'up_course', 'uses' => 'App\Http\Controllers\LoginController@upcomingCoursesFunc']);
Route::post('course_add', ['as' => 'course_add', 'uses' => 'App\Http\Controllers\LoginController@courseAddFunc']);
Route::post('up_course_edit', ['as' => 'up_course_edit', 'uses' => 'App\Http\Controllers\LoginController@upcomingCourseEditFunc']);
Route::post('up_course_add', ['as' => 'up_course_add', 'uses' => 'App\Http\Controllers\LoginController@upcomingCourseAddFunc']);
Route::post('vw_course', ['as' => 'vw_course', 'uses' => 'App\Http\Controllers\LoginController@viewCourseFunc']);
Route::post('vw_user', ['as' => 'vw_user', 'uses' => 'App\Http\Controllers\LoginController@viewUserFunc']);
Route::post('usr_edit', ['as' => 'usr_edit', 'uses' => 'App\Http\Controllers\LoginController@editUserFunc']);


Route::get('/courseterm', function () {
    $deptId = json_decode(Session::get('user'))->DepartmentId;
    $courses = json_decode(DB::table('course-term')
        ->join('course', 'course.id', '=', 'course-term.CourseId')
        ->select('course-term.*', 'course.Name')
        ->where(['course.DepartmentId' => $deptId])
        ->get());
    return view('courses', compact('courses'));
})->name('courseterm');


Route::get('/feedback', function () {
    // "select `student-enrollment`.`Course-TermId`, course.Name from ((`student-enrollment`
    //  INNER JOIN `course-term` ON `student-enrollment`.`Course-TermId`= `course-term`.Id)
    // INNER JOIN course ON `course-term`.CourseId=course.Id) where `student-enrollment`.UserId ='" . $userId . "'"
    $deptId = json_decode(Session::get('user'))->DepartmentId;
    $userId = json_decode(Session::get('user'))->Id;

    $enrl_courses = json_decode(DB::table('student-enrollment')
        ->select('student-enrollment.Course-TermId', 'course.Name')
        ->join('course-term', 'course-term.id', '=', 'student-enrollment.Course-TermId')
        ->join('course', 'course.id', '=', 'course-term.CourseId')
        ->where(['student-enrollment.UserId' => $userId])
        ->get());

    return view('feedback', compact('enrl_courses'));
})->name('feedback');


Route::get('/signup', function () {
    $roles = Role::all();
    $departments = Department::all();
    return view('user.signup', compact('roles', 'departments'));
});


Route::get('/login', function () {
    Session::put('user', '');
    $roles = Role::all();
    return view('user.login', compact('roles'));
});

Route::get('/upcoming_courses', function () {
    $deptId = json_decode(Session::get('user'))->DepartmentId;

    $courses = json_decode(DB::table('course')
        ->select('*')
        ->where(['Type' => 'upcoming', 'DepartmentId' => $deptId])
        ->get());


    return view('upcoming_courses', compact('courses'));
});

Route::get('/courses-add', function () {
    return view('courses-add');
});




Route::get('/view_courses', function () {
    // $courses = mysql_query_db('select * from course where Type = "planned" and DepartmentId = ' . $deptId);
    $deptId = json_decode(Session::get('user'))->DepartmentId;
    $courses = json_decode(DB::table('course')
        ->select('*')
        ->where(['DepartmentId' => $deptId, 'Type' => 'planned'])
        ->get());
    return view('view_courses', compact('courses'));
});

Route::get('/view_feedback', function () {
    $deptId = json_decode(Session::get('user'))->DepartmentId;

    // $courses = mysql_query_db('select * from `course-term` INNER JOIN course ON `course-term`.CourseId=course.Id WHERE course.DepartmentId = ' . $deptId);
    $courses = json_decode(DB::table('course-term')
        ->select('course-term.*', 'course.Name')
        ->join('course', 'course.id', '=', 'course-term.CourseId')
        ->where(['course.DepartmentId' => $deptId])
        ->get());

    return view('view_feedback', compact('courses'));
});

Route::get('/view_users', function () {
    return view('users');
});
