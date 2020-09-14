<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpendCoupons;
use App\Http\Requests\StoreStudent;
use App\Http\Requests\UpdateCoupons;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $students = Auth::user()->students;
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreStudent $request)
    {
        $student = new Student($request->validated());
        $student->teacher()->associate(Auth::user());
        $student->coupons = $request->starting_coupon_balance;
        $student->save();
        return redirect(route('students.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect(route('students.index'));
    }

    public function decrement(Student $student)
    {
        if ($student->coupons > 0) {
            $student->decrement('coupons');
        }
        return redirect(route('students.index'));
    }

    public function increment(Student $student)
    {
        $student->increment('coupons');
        return redirect(route('students.index'));
    }

    public function couponsUpdate(UpdateCoupons $request, Student $student)
    {
        $student->coupons = $request->coupon_balance;
        $student->save();
        return redirect(route('students.edit', $student));
    }

    public function couponsSpend(SpendCoupons $request, Student $student)
    {
        if ($student->coupons > $request->coupons_to_spend) {
            $student->decrement('coupons', $request->coupons_to_spend);
            return redirect(route('students.edit', $student));
        }
        // TODO: reload with error if attempting to decrement more coupons than are available
    }
}
