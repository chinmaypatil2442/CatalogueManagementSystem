@extends('base')

@section('main')

<div>
    <div>
        <div align="center">
            <h2>Login</h2>
        </div>
        <div>
            @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif
            <form method="post" action="{{ route('auth') }}">
                @csrf
                <table class="table_class">
                    <tr>
                        <td>Email Id:</td>
                        <td><input type="email" name="email" required /></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" id="password" name="password" minlength="8" required /></td>
                    </tr>
                    <!-- <tr>
                        <td>Role:</td>
                        <td>
                            <select name="role_id" required>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr> -->
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit">Login</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
@if (session('alert'))
<div align="center" style="color: red;">
    {{ session('alert') }}
</div>
@endif


@endsection
