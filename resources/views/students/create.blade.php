@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Student</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('students.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input id="first-name" type="text" class="form-control" placeholder="First Name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input id="last-name" type="text" class="form-control" placeholder="Last Name" name="last_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
