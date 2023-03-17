@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Add new user and assign role
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}"
                           type="text"
                           class="form-control shadow-none"
                           name="name"
                           placeholder="Name" required>
                </div>

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="surname" class="form-label">Surname</label>
                    <input value="{{ old('surname') }}"
                           type="text"
                           class="form-control shadow-none"
                           name="surname"
                           placeholder="Surname" required>
                </div>

                @error('surname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ old('email') }}"
                           type="email"
                           class="form-control shadow-none"
                           name="email"
                           placeholder="Email" required>
                </div>

                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input value="{{ old('password') }}"
                           type="password"
                           class="form-control shadow-none"
                           name="password"
                           placeholder="Password" required>
                </div>

                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="roles" class="form-label">Assign role</label>
                    <select class="form-select shadow-none" name="role_id" id="inputGroupSelect01">
                        <option selected>Select role</option>
                        @foreach($roles as $role)
                            <option
                                value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-primary shadow-none">Save user</button>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary shadow-none">Back</a>
            </form>
        </div>

    </div>
@endsection
