@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Spend Coupons for {{ $student->first_name }} {{ $student->last_name }}</div>
                <div class="card-body">
                    <h4>Available Balance: {{ $student->coupons }}</h4>
                    <form method="POST" action="{{ route('students.spend.edit', $student) }}">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="coupons-to-spend">Coupons to Spend</label>
                            <input id="coupons-to-spend" type="number" class="form-control" placeholder="Coupons to Spend" name="coupons_to_spend" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary mr-3">Cancel</a>
                            <button type="submit" class="btn btn-primary">Spend Coupons</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
