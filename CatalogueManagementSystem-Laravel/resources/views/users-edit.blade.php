@extends('base')

@section('main')
<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

$id = Session::get('users-edit');


// $user = mysql_query_db("select * from user where Id = " . $id);
$user_record = DB::table('user')
    ->select('*')
    ->where(['Id' => $id])
    ->first();
// $user_record = mysql_fetch_db($user);

?>




<!-- user section -->
<section class="section_card">
    <!-- <a href="users.php"> Go back</a>  -->
    <a href="{{ url('/view_users') }}">Go back</a>
    <div align="center">
        <h2>Edit User: </h2>
    </div>

    <form method="POST" name="users_edit_form" id="users_edit_form" action="usr_edit">
        @csrf
        <table class="table_class">
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" minlength="3" value="{{ $user_record->Name }}" required /></td>
            </tr>
            <tr>
                <td>Email Id:</td>
                <td><input type="email" name="email" value="{{ $user_record->Email }}" required /></td>
            </tr>
            <tr>
                <td>Role:</td>
                <td><select name="role" id="role" required>
                        <?php
                        // $roles = mysql_query_db('select * from role');
                        $roles = json_decode(DB::table('role')
                            ->select('*')
                            ->get());
                        foreach ($roles as $role) {
                        ?>
                            <option value="'{{ $role->Id }}'" <?php if ($role->Id  ==  $user_record->RoleId)  echo ' selected="selected"'; ?>>
                                {{ $role->Name }}</option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Department:</td>
                <td><select name="department" required>
                        <?php
                        // $departments = mysql_query_db('select * from department');
                        $departments = json_decode(DB::table('department')
                            ->select('*')
                            ->get());
                        // while ($dept = mysql_fetch_db($departments)) {
                        foreach ($departments as $dept) {
                        ?>
                            <option value="'{{ $dept->Id }}'" <?php if ($dept->Id  ==  $user_record->DepartmentId)  echo ' selected="selected"'; ?>>{{ $dept->Name }}</option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Submit" /></td>
            </tr>

        </table>
        <input type="text" name="id" hidden value="{{ $user_record->Id }}" />
    </form>


</section>
@endsection
