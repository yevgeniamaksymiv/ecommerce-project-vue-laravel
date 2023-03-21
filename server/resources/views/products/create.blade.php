@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Add new product
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}"
                           type="text"
                           class="form-control shadow-none @error('name') is-invalid @enderror"
                           name="name"
                           placeholder="Name" required>
                </div>

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text"
                              class="form-control shadow-none @error('description') is-invalid @enderror"
                              name="description"
                              placeholder="Description" required>
                         {{ old('description') }}
                    </textarea>
                </div>

                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input value="{{ old('price') }}"
                           type="number"
                           class="form-control shadow-none @error('price') is-invalid @enderror"
                           name="price"
                           placeholder="Price" required>
                </div>

                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="quantity" class="form-label">Quantity</label>
                <div class="mb-3 input-group">
                    <input value="{{ old('quantity') }}"
                           type="number"
                           class="form-control shadow-none @error('quantity') is-invalid @enderror"
                           name="quantity"
                           placeholder="Quantity" required>
                </div>

                @error('quantity')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="size" class="form-label">Size</label>
                <div class="mb-3 input-group">
                    <input value="{{ old('size') }}"
                           type="number"
                           class="form-control shadow-none @error('size') is-invalid @enderror"
                           name="size"
                           placeholder="Size" required>
                </div>

                @error('size')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="color" class="form-label">Color</label>
                <div class="mb-3 input-group">
                    <input value="{{ old('color') }}"
                           type="text"
                           class="form-control shadow-none @error('color') is-invalid @enderror"
                           name="color"
                           placeholder="Color" required>
                </div>

                @error('color')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="img_path" class="form-label">Image</label>
                <div class="mb-3 input-group">
                    <input type="file"
                           class="form-control shadow-none @error('img_path') is-invalid @enderror"
                           name="img_path"
                           placeholder="Image" required>
                </div>

                @error('img_path')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="category_id" class="form-label">Select category</label>
                    <select class="form-select shadow-none @error('category_id') is-invalid @enderror" name="category_id"
                            id="inputGroupSelect01">
                        <option selected>Select category</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-outline-primary shadow-none">Save product</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary shadow-none">Back</a>
            </form>
        </div>

    </div>
@endsection
