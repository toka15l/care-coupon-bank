@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <span class="col-md-8">
            <a href="{{ route('students.index') }}" class="d-flex back-btn mb-4">
                <span class="iconify" data-icon="eva:arrow-ios-back-fill" data-inline="false"></span>
                <span>back</span>
            </a>
            <div class="d-flex justify-content-between align-items-center">
                @if ($previousStudentID)
                    <a href="{{ route('students.balance', $previousStudentID) }}" class="next-prev">
                        <span class="iconify" data-icon="carbon:previous-filled" data-inline="false"></span>
                    </a>
                @else
                    <div></div>
                @endif
                <h2>{{ $student->first_name }} {{ $student->last_name }}{{ $student->student_number ? ' (' . $student->student_number . ')' : '' }}</h2>
                @if ($nextStudentID)
                    <a href="{{ route('students.balance', $nextStudentID) }}" class="next-prev">
                        <span class="iconify" data-icon="carbon:next-filled" data-inline="false"></span>
                    </a>
                @else
                    <div></div>
                @endif
            </div>
            <div class="card">
                <div class="card-header">Coupons</div>
                <div class="card-body">
                    <h4>Current Balance: {{ $student->coupons }}</h4>
                    <form method="POST" action="{{ route('students.coupons.update', $student) }}">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="coupons-balance">Update Coupon Balance</label>
                            <div class="d-flex justify-content-between">
                                <input id="coupons-balance" type="number" class="form-control" placeholder="New Coupon Balance" name="coupon_balance" value="{{ $student->coupons }}" required>
                                <button type="submit" class="btn btn-primary student-update-button">Update</button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('students.coupons.earn', $student) }}">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="coupons-to-earn">Earn Coupons</label>
                            <div class="d-flex justify-content-between">
                                <input id="coupons-to-earn" type="number" class="form-control" placeholder="Coupons to Earn" name="coupons" required>
                                <button type="submit" class="btn btn-primary student-update-button">Earn</button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('students.coupons.spend', $student) }}">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="coupons-to-spend">Spend Coupons</label>
                            <div class="d-flex justify-content-between">
                                <input id="coupons-to-spend" type="number" class="form-control" placeholder="Coupons to Spend" name="coupons" required>
                                <button type="submit" class="btn btn-primary student-update-button">Spend</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Administrative</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('students.delete', $student) }}">
                        @csrf
                        @method('delete')
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-danger">Delete Student</button>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">
                                Edit Student
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
