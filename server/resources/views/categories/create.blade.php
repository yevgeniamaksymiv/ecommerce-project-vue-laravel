@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Add new category
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('categories.store') }}">
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

                <label for="categories" class="form-label">Select parent category</label>
                @foreach($parentCategories as $category)
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="parent_id" id="{{$category->id}}"
                        value="{{ $category->id }}">
                        <label class="form-check-label" for="{{$category->id}}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach

                <label for="categories" class="form-label">Or</label>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="parent_id" id="parent" value="">
                    <label class="form-check-label" for="parent">
                        Save as parent
                    </label>
                </div>

                <button type="submit" class="btn btn-outline-primary shadow-none">Save category</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary shadow-none">Back</a>
            </form>
        </div>

    </div>
@endsection

