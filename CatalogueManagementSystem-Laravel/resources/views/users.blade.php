<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


?>
@extends('base')

@section('main')

<!-- Script -->
<script>
    function delete_user(id, name) {
        var delete_flag = confirm('Are you sure you want to delete user: ' + name);
        if (delete_flag == true) {
            document.getElementById('edit').value = '';
            document.getElementById('delete').value = id;
            document.getElementById("users_form").submit();
        }
    }

    function edit_user(user) {
        document.getElementById('delete').value = '';
        document.getElementById('edit').value = user;
        document.getElementById("users_form").submit();
    }
</script>
<!-- end Script -->



<!-- user section -->
<section class="section_card">
    <div align="center">
        <h2>Users</h2>
    </div>
    <?php
    // $users = mysql_query_db('select user.ID, user.Name, user.Email, department.Name, role.Name from ((user INNER JOIN department ON user.DepartmentId = department.Id) INNER JOIN role ON user.RoleId = role.Id)');
    $users = json_decode(DB::table('user')
        ->select('user.ID as userId', 'user.Name as userName', 'user.Email', 'department.Name as deptName', 'role.Name as roleName')
        ->join('department', 'department.id', '=', 'user.DepartmentId')
        ->join('role', 'role.id', '=', 'user.RoleId')
        ->get());
    // while ($user = mysql_fetch_db($users)) {
    // print_r($users);
    // die();
    foreach ($users as $user) {

    ?>
        <div class="card">
            <!-- citation: Image-avatar.png Referred from:- https://images.pexels.com/photos/546819/pexels-photo-546819.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260 -->
            <img src="images/avatar.png" alt="Avatar" class="users_image">
            <div class="container">
                <h4>{{$user->userName}}</h4>
                <b>{{$user->Email}}</b>
                <p>{{$user->deptName}}</p>
                <p>{{$user->roleName}}</p>
                <table class="table">
                    <tr>
                        <!-- <td onclick="alert('Add.')" class="cell">Add</td> -->
                        <td onclick="edit_user('{{$user->userId}}')" class="cell">Edit</td>
                        <td onclick="delete_user('{{$user->userId}}','{{$user->Email}}')" class="cell">Delete</td>
                    </tr>
                </table>
            </div>
        </div>
    <?php
    }
    ?>
    <form method="POST" name="users_form" id="users_form" action="vw_user">
        @csrf
        <input id="delete" name="delete" type="text" hidden />
        <input id="edit" name="edit" type="text" hidden />

    </form>


</section>

<!-- end user section -->

@endsection
