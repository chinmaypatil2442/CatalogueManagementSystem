@extends('base')

@section('main')
<div>
    <div>
        <div align="center">
            <h2>Sign Up</h2>
        </div>
        <div>
            <form method="post" action="{{ route('users.store') }}">
                @csrf
                <table class="table_class">
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="name" minlength="3" required /></td>
                    </tr>
                    <tr>
                        <td>Email Id:</td>
                        <td><input type="email" name="email" required /></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" id="password" name="password" minlength="8" required /></td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td><input type="password" id="password_confirmation" name="password_confirmation" onkeyup="validate_confirm_password()" minlength="8" required /></td>
                    <tr>
                        <td></td>
                        <td>
                            <div id="match_password"></div>
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td>Role:</td>
                        <td>
                            <select name="role_id" required>
                                @foreach($roles as $role)
                                <option value="{{$role->Id}}">{{$role->Name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Department:</td>
                        <td>
                            <select name="department_id" required>
                                @foreach($departments as $department)
                                <option value="{{$department->Id}}">{{$department->Name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit">Register</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<div align="center">
    @if ($errors->any())
    <div>
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
    @endif
</div>
@endsection
