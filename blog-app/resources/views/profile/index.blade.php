@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Your Profile</h3>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>Name</th>
                    <td>: {{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: {{ $user->email }}</td>
                </tr>
            </table>
            <a href="{{ route('profile.edit') }}" class="btn btn-warning">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
