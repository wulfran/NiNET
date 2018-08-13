@extends('adminlte::page')

@section('content')
<div class="panel panel-info">
    <div class="panel-heading">Użytkownicy</div>
    <div class="panel-body">
        <table class="table" id="users_table">
            <thead>
                <th>ID</th>
                <th>Login</th>
                <th>E-mail</th>
                <th>Typ</th>
                <th>Akcja</th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->account_type }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-remove"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')
    <script>
        console.log('ok');
        $("#users_table").DataTable({
            "columns": [
                {"width": "5%"},
                null,
                null,
                null,
                {"width": "10%"},
            ]
        });
    </script>
@stop