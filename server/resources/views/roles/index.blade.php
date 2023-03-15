@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            All roles
        </div>

        <div class="container mt-4">

            <table class="table">
                <thead>
                <th scope="col" width="80%">Name</th>
                <th scope="col" width="10%"></th>
                <th scope="col" width="1%">
                    <a href="{{ route('roles.create') }}" class="btn btn-default shadow-none">
                        <img width="20" height="20" src="{{ asset('assets/add.svg') }}" alt="add svg">
                    </a>
                </th>
                </thead>

                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('roles.create', $role->id) }}" class="btn btn-default shadow-none">
                                <img width="20" height="20" src="{{ asset('assets/edit.svg') }}" alt="edit svg">
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
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

