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
            All deliveries
        </div>

        <div class="container mt-4">

            <table class="table table-striped">
                <thead>
                <th scope="col" width="80%">Name</th>
                <th scope="col" width="10%"></th>
                <th scope="col" width="1%">
                    @can('create', \App\Models\Delivery::class)
                        <a href="{{ route('deliveries.create') }}" class="btn btn-default shadow-none">
                            <img width="20" height="20" src="{{ asset('assets/add.svg') }}" alt="add svg">
                        </a>
                    @endcan
                </th>
                </thead>

                @foreach($deliveries as $delivery)
                    <tr>
                        <td>{{ $delivery->name }}</td>
                        <td>
                            @can('update', $delivery)
                                <a href="{{ route('deliveries.edit', $delivery->id) }}"
                                   class="btn btn-default shadow-none">
                                    <img width="20" height="20" src="{{ asset('assets/edit.svg') }}" alt="edit svg">
                                </a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $delivery)
                                <form method="POST" action="{{ route('deliveries.destroy', $delivery->id) }}">
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

