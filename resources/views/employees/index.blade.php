@extends('layouts.employee')

@section('content')
<div class="container">
    <h2>Employee List</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-success mb-2">Create Employee</a>
    <a href="{{ route('clients.index') }}" class="btn btn-primary mb-2">Client List</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone_number }}</td>
                <td>
                    @if ($employee->is_active)
                        <span class="badge badge-success" style="color: #000";>Active</span>
                    @else
                        <span class="badge badge-danger" style="color: #000">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form method="POST" action="{{ route('employees.destroy', $employee->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @if (count($employees) == 0)
    <p>No employees found.</p>
    @endif
</div>
@endsection
