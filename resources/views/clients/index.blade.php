@extends('layouts.client')

@section('content')
<div class="container">
    <h2>Client List</h2>
    <a href="{{ route('clients.create') }}" class="btn btn-success mb-2">Create Client</a>
    <a href="{{ route('employees.index') }}" class="btn btn-primary mb-2">Employee List</a>
    @if (count($clients) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>City</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->address }}</td>
                <td>{{ $client->city }}</td>
                <td>{{ $client->notes }}</td>
                <td>
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form method="POST" action="{{ route('clients.destroy', $client->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No clients found.</p>
    @endif
</div>
@endsection
