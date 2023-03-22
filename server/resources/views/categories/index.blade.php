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
            All categories
        </div>

        <div class="container mt-4">

            <table class="table table-striped">
                <thead>
                <th scope="col" width="40%">Name</th>
                <th scope="col" width="40%">Parent category</th>
                <th scope="col" width="10%">
                <th scope="col" width="1%">
                    @can('create', \App\Models\Category::class)
                        <a href="{{ route('categories.create') }}" class="btn btn-default shadow-none">
                            <img width="20" height="20" src="{{ asset('assets/add.svg') }}" alt="add svg">
                        </a>
                    @endcan
                </th>
                </thead>

                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $categories->where('id', $category->parent_id)
                                    ->pluck('name')->implode('name') }}</td>
                        <td>
                            @can('update', $category)
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-default shadow-none">
                                <img width="20" height="20" src="{{ asset('assets/edit.svg') }}" alt="edit svg">
                            </a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $category)
                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-default shadow-none">
                                    <img width="20" height="20" src="{{ asset('assets/delete.svg') }}" alt="delete svg">
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
@endsection

