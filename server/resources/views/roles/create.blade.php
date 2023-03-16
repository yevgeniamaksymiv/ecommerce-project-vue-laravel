@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Add new role and assign permissions
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}"
                           type="text"
                           class="form-control shadow-none"
                           name="name"
                           placeholder="Name" required>
                </div>

                <label for="permissions" class="form-label">Assign Permissions</label>

                <table class="table table-striped">
                    <thead>
                    <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                    <th scope="col" width="20%">Name</th>
                    </thead>

                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       name="permissions[{{ $permission->id}}]"
                                       value="{{ $permission->id }}"
                                       class='permission'>
                            </td>
                            <td>{{ $permission->description }}</td>
                        </tr>
                    @endforeach

                </table>

                <button type="submit" class="btn btn-outline-primary">Save role</button>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Back</a>
            </form>
        </div>

    </div>
@endsection

@section('scripts')
@endsection
