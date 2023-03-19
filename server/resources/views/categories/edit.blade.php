@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Edit category
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name', $category->name) }}"
                           type="text"
                           class="form-control shadow-none"
                           name="name"
                           placeholder="Name" required>
                </div>

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="categories" class="form-label">Select parent category</label>
                @foreach($parentCategories as $parentCategory)
                    <div class="form-check mb-3">
                        <input class="form-check-input"
                               type="radio"
                               name="parent_id"
                               id="{{$parentCategory->id}}"
                               value="{{ $parentCategory->id }}"
                            {{ old('parent_id', $category->parent_id) == $parentCategory->id ? 'checked' : ''}}
                        >
                        <label class="form-check-label" for="{{$parentCategory->id}}">
                            {{ $parentCategory->name }}
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

                <button type="submit" class="btn btn-outline-primary shadow-none">Update category</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary shadow-none">Back</a>
            </form>
        </div>

    </div>
@endsection

