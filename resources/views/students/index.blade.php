@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Students</span>
                    <a href="{{ route('students.create') }}">Add Student</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-center">Coupons</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr style="width: 10%">
                                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                    <td class="d-flex justify-content-between">
                                        <form class="d-inline" method="POST" action="{{ route('students.decrement', $student) }}">
                                            @csrf
                                            <button type="submit" class="button coupon-button-minus {{ $student->coupons < 1 ? 'disabled' : '' }}" {{ $student->coupons < 1 ? 'disabled' : '' }}>
                                                <span class="iconify" data-icon="ant-design:minus-circle-filled" data-inline="false"></span>
                                            </button>
                                        </form>
                                        {{ $student->coupons }}
                                        <form class="d-inline" method="POST" action="{{ route('students.increment', $student) }}">
                                            @csrf
                                            <button type="submit" class="button coupon-button-plus">
                                                <span class="iconify" data-icon="ant-design:plus-circle-filled" data-inline="false"></span>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('students.spend', $student) }}">Spend</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
