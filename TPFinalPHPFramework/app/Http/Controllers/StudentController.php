<?php

namespace App\Http\Controllers;

use App\Module;
use App\Promotion;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::all();
        $search = $request->search;
        if (!(empty($search))) {
            $students = Student::where('name', 'like', '%' . $search . '%')
            ->orWhere('firstName', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->get();
        }
        return view('students.index', ['students' => $students, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::all();
        $promotions = Promotion::all();
        return view('students.create', ['promotions'=>$promotions, 'modules'=>$modules]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->input('name');
        $student->firstName = $request->input('firstName');
        $student->email = $request->input('email');
        $student->promotion_id = $request->input('promo');
        $student->save();
        $student->modules()->attach($request->modules);
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        // $promotions = Promotion::all();
        return view('students.show', ['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $modules = Module::all();
        $promotions = Promotion::all();
        return view('students.edit', ['student'=>$student, 'promotions'=>$promotions, 'modules'=>$modules]);
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
        $student = Student::find($student->id);
        $student->name = $request->input('name');
        $student->firstName = $request->input('firstName');
        $student->email = $request->input('email');
        $student->promotion_id = $request->input('promo');
        $student->push();
        $student->modules()->detach();
        $student->modules()->attach($request->modules);
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->modules()->detach();
        $student->delete();
        return redirect()->route('students.index');
    }
}
