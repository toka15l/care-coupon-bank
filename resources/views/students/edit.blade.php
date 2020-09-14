@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>{{ $student->first_name }} {{ $student->last_name }}</h2>
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
                    <form method="POST" action="{{ route('students.coupons.spend', $student) }}">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="coupons-to-spend">Spend Coupons</label>
                            <div class="d-flex justify-content-between">
                                <input id="coupons-to-spend" type="number" class="form-control" placeholder="Coupons to Spend" name="coupons_to_spend" required>
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
                        <button type="submit" class="btn btn-danger">Delete Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection