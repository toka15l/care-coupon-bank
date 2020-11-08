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
    public function index(Request $request)
    {
        if ($request->has('direction')) {
            $request->session()->put('direction', $request->input('direction'));
        }
        if ($request->has('sort')) {
            $request->session()->put('sort', $request->input('sort'));
        }
        $direction = $request->session()->get('direction', 'desc');
        $sort = $request->session()->get('sort', 'student_number');
        $students = Student::where('teacher_id', '=', Auth::user()->id)->sortable([$sort => $direction])->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(StoreStudent $request)
    {
        $student = new Student($request->validated());
        $student->teacher()->associate(Auth::user());
        $student->coupons = $request->starting_coupon_balance;
        $student->save();
        return redirect(route('students.index'));
    }

    public function show(Student $student)
    {
        dd('show');
    }

    public function edit(Request $request, Student $student)
    {
        $direction = $request->session()->get('direction', 'desc');
        $sort = $request->session()->get('sort', 'student_number');
        $orderedStudentIDs = Student::where('teacher_id', '=', Auth::user()->id)->sortable([$sort => $direction])->pluck('id');
        $previousStudentID = null;
        $nextStudentID = null;
        $totalStudents = count($orderedStudentIDs);
        for ($i = 0; $i < $totalStudents; $i++) {
            if ($orderedStudentIDs[$i] === $student->id) {
                $previousStudentID = $i > 0 ? $orderedStudentIDs[$i - 1] : null;
                $nextStudentID = $i < $totalStudents - 1 ? $orderedStudentIDs[$i + 1] : null;
                break;
            }
        }
        return view('students.edit', compact('student', 'previousStudentID', 'nextStudentID'));
    }

    public function update(Request $request, Student $student)
    {
        //
    }

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
