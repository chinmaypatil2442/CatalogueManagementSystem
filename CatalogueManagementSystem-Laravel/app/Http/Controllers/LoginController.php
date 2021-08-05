<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

use App\Models\CourseTerm;


class LoginController extends Controller
{
    public function login()
    {

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $asd = DB::table('user')->where(['Email' => $request->email, 'Password' => $request->password])
            ->first();
        if (
            $asd == null
        ) {
            return redirect('login')->with('alert', 'You have entered invalid credentials');
        } else {
            Session::put('user', json_encode($asd));
            return redirect('index');
        }

        // return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }


    public  function enrollCourseTerm(Request $request)
    {
        $request->validate([
            'enroll' => 'required',
        ]);


        $userId = json_decode(Session::get('user'))->Id;

        $stud_enrl_count = DB::table('student-enrollment')
            ->where(['UserId' => $userId, 'Course-TermId' => $request->enroll,])
            ->count();
        if ($stud_enrl_count == 0) {
            DB::table('student-enrollment')->insert(
                array('UserId' => $userId, 'Course-TermId' => $request->enroll, 'Status' => 'enrolled')
            );
            $message = "Enrolled Successfully!!!";
            // echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = 'A student can enroll once per course per Term.';
            // echo "<script type='text/javascript'>alert('$message2');</script>";
        }

        Session::flash('message', $message);
        return redirect()->route('courseterm');
    }

    public  function submitFeedback(Request $request)
    {
        $request->validate([
            'enrolled_courses' => 'required',
            'feedback' => 'required',
        ]);


        $userId = json_decode(Session::get('user'))->Id;

        $stud_feed_count = DB::table('feedback')
            ->where(['UserId' => $userId, 'Course-TermId' => $request->enrolled_courses,])
            ->count();
        if ($stud_feed_count == 0) {
            DB::table('feedback')->insert(
                array('UserId' => $userId, 'Course-TermId' => $request->enrolled_courses, 'Feedback' => $request->feedback)
            );
            $message = "Feedbcak Submitted Successfully!!!";
            // echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = 'A student can submit feedbaack once per course.';
            // echo "<script type='text/javascript'>alert('$message2');</script>";
        }

        Session::flash('FBmessage', $message);
        return redirect()->route('feedback');
    }

    public function upcomingCoursesFunc(Request $request)
    {
        if (isset($request->delete) && $request->delete != '') {
            // mysql_query_db("delete from course where Id = " . $_POST["delete"]);
            // mysql_query_db("delete from `course-term` where CourseId = " . $_POST["delete"]);
            DB::table('course')->where('Id', '=', $request->delete)->delete();
            DB::table('course-term')->where('CourseId', '=', $request->delete)->delete();
            $message = "Deleted!!!";
            Session::flash('UCmessage', $message);
            return redirect('upcoming_courses');
        } else

        if (isset($request->edit) && $request->edit != '') {
            // $_SESSION['upcoming_courses-edit'] = $_POST["edit"];
            Session::put('upcoming_courses-edit', $request->edit);
            $CourseId = Session::get('upcoming_courses-edit');
            $courseNameRecord = json_decode(DB::table('course')
                ->select('*')
                ->where(['Id' => $CourseId])
                ->get());

            $courseName = $courseNameRecord[0]->Name;

            // $courses = mysql_query_db('select * from `course-term` INNER JOIN course ON `course-term`.CourseId=course.Id WHERE `course-term`.CourseId = ' . $CourseId);

            $courses = json_decode(DB::table('course-term')
                ->join('course', 'course.id', '=', 'course-term.CourseId')
                ->select('course-term.*', 'course.Name')
                ->where(['course-term.CourseId' => $CourseId])
                ->get());


            return view('upcoming_courses-edit', compact('courseName', 'courses'));
        } else

        if (isset($request->add) && $request->add != '') {
            // $_SESSION['upcoming_courses-add'] = $_POST["add"];
            Session::put('upcoming_courses-add', $request->add);
            $CourseId = Session::get('upcoming_courses-add');
            $courseNameRecord = json_decode(DB::table('course')
                ->select('*')
                ->where(['Id' => $CourseId])
                ->get());

            $courseName = $courseNameRecord[0]->Name;

            return view('upcoming_courses-add', compact('courseName'));
        } else

        if (isset($request->course_add) && $request->course_add != '') {
            // $_SESSION['courses-add'] = $_POST["course_add"];
            Session::put('courses-add', $request->course_add);
            return view('courses-add');
        } else {
            return redirect('upcoming_courses');
        }
    }

    public function courseAddFunc(Request $request)
    {
        $request->validate([
            'CourseName' => 'required',
        ]);

        $type = Session::get('courses-add');
        $deptId = json_decode(Session::get('user'))->DepartmentId;

        DB::table('course')->insert(
            array('DepartmentId' => $deptId, 'Name' => $request->CourseName, 'Type' => $type)
        );
        // mysql_query_db("insert into course set DepartmentId='" . $deptId . "', Name='" . $_POST["CourseName"] . "',Type='" . $type . "'");
        $message = "Success!!!";
        // echo "<script type='text/javascript'>alert('$message');</script>";
        if ($type == 'upcoming') {
            Session::flash('UCmessage', $message);
            return redirect('upcoming_courses');
        } else {
            Session::flash('VCmessage', $message);
            return redirect('view_courses');
        }
        // return view('upcoming_courses');
    }

    public function upcomingCourseEditFunc(Request $request)
    {
        // mysql_query_db("delete from `course-term` where Id = " . $_POST["delete"]);
        DB::table('course-term')->where('Id', '=', $request->delete)->delete();

        $CourseId = Session::get('upcoming_courses-edit');
        $courseNameRecord = json_decode(DB::table('course')
            ->select('*')
            ->where(['Id' => $CourseId])
            ->get());

        $courseName = $courseNameRecord[0]->Name;

        // $courses = mysql_query_db('select * from `course-term` INNER JOIN course ON `course-term`.CourseId=course.Id WHERE `course-term`.CourseId = ' . $CourseId);

        $courses = json_decode(DB::table('course-term')
            ->join('course', 'course.id', '=', 'course-term.CourseId')
            ->select('course-term.*', 'course.Name')
            ->where(['course-term.CourseId' => $CourseId])
            ->get());


        return view('upcoming_courses-edit', compact('courseName', 'courses'));
    }

    public function upcomingCourseAddFunc(Request $request)
    {

        $request->validate([
            'ProfessorName' => 'required',
            'Term' => 'required',
            'Class' => 'required',
        ]);

        $CourseId = Session::get('upcoming_courses-add');



        // mysql_query_db("insert into `course-term` set CourseId='" . $CourseId . "',ProfessorName='" . $_POST["ProfessorName"] . "',Term='" . $_POST["Term"] . "',Class='" . $_POST["Class"] . "'");
        DB::table('course-term')->insert(
            array('CourseId' => $CourseId, 'ProfessorName' => $request->ProfessorName, 'Term' => $request->Term, 'Class' => $request->Class)
        );


        $message = "Success!!!";
        Session::flash('UCmessage', $message);
        return redirect('upcoming_courses');
    }


    public function viewCourseFunc(Request $request)
    {

        if (isset($request->course_add) && $request->course_add != '') {
            Session::put('courses-add', $request->course_add);
            return view('courses-add');
        } else

        if (isset($request->delete) && $request->delete != '') {
            DB::table('course')->where('Id', '=', $request->delete)->delete();
            $message = "Deleted!!!";
            Session::flash('VCmessage', $message);
            return redirect('view_courses');
        } else {
            return redirect('view_courses');
        }
    }

    public function viewUserFunc(Request $request)
    {
        if (isset($request->delete) && $request->delete != '') {
            // mysql_query_db("delete from user where Id = " . $_POST["delete"]);
            DB::table('user')->where('Id', '=', $request->delete)->delete();
            return redirect('view_users');
        }

        if (isset($request->edit) && $request->edit != '') {
            // $_SESSION['users-edit'] = $_POST["edit"];
            Session::put('users-edit', $request->edit);
            // header('location: users-edit.php');
            return view('users-edit');
        }
    }

    public function editUserFunc(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'department' => 'required',
        ]);
        $asd = $request->role;
        $asd = trim($asd, "'\"");
        $roleId = trim($asd, "'");
        $asd = $request->department;
        $asd = trim($asd, "'\"");
        $deptId = trim($asd, "'");

        $affected = DB::table('user')
            ->where('Id', $request->id)
            ->update(['Name' => $request->name, 'Email' => $request->email, 'RoleId' => intval($roleId), 'DepartmentId' => intval($deptId)]);
        return redirect('view_users');
    }


    public function home()
    {

        return view('home');
    }
}
