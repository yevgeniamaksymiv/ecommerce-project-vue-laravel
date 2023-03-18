@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="lead">
            All users
        </div>

        <div class="container mt-4">

            <table class="table">
                <thead>
                <th scope="col" width="20%">Name</th>
                <th scope="col" width="20%">Surname</th>
                <th scope="col" width="20%">Email</th>
                <th scope="col" width="20%">Role</th>
                <th scope="col" width="10%"></th>
                <th scope="col" width="1%">
                    <a href="{{ route('users.create') }}" class="btn btn-default shadow-none">
                        <img width="20" height="20" src="{{ asset('assets/add.svg') }}" alt="add svg">
                    </a>
                </th>
                </thead>

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{
    \Illuminate\Support\Facades\DB::table('roles')->where('id', $user->role_id)
            ->pluck('name')->implode('name')
    }}</td>


                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default shadow-none">
                                <img width="20" height="20" src="{{ asset('assets/edit.svg') }}" alt="edit svg">
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-default shadow-none">
                                    <img width="20" height="20" src="{{ asset('assets/delete.svg') }}" alt="delete svg">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
@endsection

