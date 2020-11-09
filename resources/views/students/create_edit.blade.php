@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($student) ? $student->first_name . ' ' . $student->last_name . ($student->student_number ? ' (' . $student->student_number . ')' : '') : 'New Student' }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}">
                        @csrf
                        @isset($student)
                            @method('put')
                        @endisset
                        <div class="form-group">
                            <label for="student-number">Student Number</label>
                            <input id="student-number" type="text" class="form-control" placeholder="Student Number" name="student_number" value="{{ isset($student) ? $student->student_number : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input id="first-name" type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ isset($student) ? $student->first_name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input id="last-name" type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ isset($student) ? $student->last_name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="coupon-balance">{{ isset($student) ? '' : 'Starting ' }}Coupon Balance</label>
                            <input id="starting-coupon-balance" type="number" class="form-control" placeholder="{{ isset($student) ? '' : 'Starting ' }}Coupon Balance" name="coupon_balance" value="{{ isset($student) ? $student->coupons : '0' }}" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ isset($student) ? route('students.balance', $student) : route('students.index') }}" class="btn btn-secondary mr-3">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($student) ? 'Update' : 'Create' }} Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
