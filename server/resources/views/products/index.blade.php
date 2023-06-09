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
            All products
        </div>

        <div class="container mt-4">

            <table class="table table-striped">
                <thead>
                <th scope="col" width="20%">Name</th>
                <th scope="col" width="20%">Price</th>
                <th scope="col" width="20%">Category</th>
                <th scope="col" width="20%">Details</th>
                <th scope="col" width="10%"></th>
                <th scope="col" width="1%">
                    @can('create', \App\Models\Product::class)
                        <a href="{{ route('products.create') }}" class="btn btn-default shadow-none">
                            <img width="20" height="20" src="{{ asset('assets/add.svg') }}" alt="add svg">
                        </a>
                    @endcan
                </th>
                </thead>

                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name ?? ''}}</td>
                        <td>
                            @can('view', $product)
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="btn btn-default shadow-none">
                                    <img width="20" height="20" src="{{ asset('assets/info.svg') }}" alt="info svg">
                                </a>
                            @endcan
                        </td>

                        <td>
                            @can('update', $product)
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="btn btn-default shadow-none">
                                    <img width="20" height="20" src="{{ asset('assets/edit.svg') }}" alt="edit svg">
                                </a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $product)
                                <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-default shadow-none">
                                        <img width="20" height="20" src="{{ asset('assets/delete.svg') }}"
                                             alt="delete svg">
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

