@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Students</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Coupons</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                    <td>
                                        <form class="d-inline">
                                            <button type="submit" class="button coupon-button-minus">
                                                <span class="iconify" data-icon="ant-design:minus-circle-filled" data-inline="false"></span>
                                            </button>
                                        </form>
                                        {{ $student->coupons }}
                                        <form class="d-inline">
                                            <button type="submit" class="button coupon-button-plus">
                                                <span class="iconify" data-icon="ant-design:plus-circle-filled" data-inline="false"></span>
                                            </button>
                                        </form>
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
