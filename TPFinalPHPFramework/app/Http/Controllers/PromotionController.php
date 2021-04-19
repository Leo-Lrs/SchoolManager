<?php

namespace App\Http\Controllers;

use App\Module;
use App\Promotion;
use App\Student;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Stub;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $promotions = Promotion::all();
        $search = $request->search;
        if (!(empty($search))) {
            $promotions = Promotion::where('name', 'like', '%' . $search . '%')->get();
        }
        return view('promotions.index', ['promotions'=> $promotions, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::all();
        $students = Student::all();
        return view('promotions.create', ['modules'=>$modules, 'students'=>$students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promotion = new Promotion();
        $promotion->name = $request->input('name');
        $promotion->speciality = $request->input('speciality');
        $promotion->save();
        $promotion->modules()->attach($request->modules);
        $students = $request->students;
        foreach( $students as $student_id){
            $student = Student::find($student_id);
            $student->promotion_id = $promotion->id;
            $student->push();
        };
        return redirect()->route('promotions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        $modules = Module::all();
        $students = Student::all();
        return view('promotions.show', ['promotion'=>$promotion, 'modules'=>$modules, 'students'=>$students]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        $modules = Module::all();
        $students = Student::all();
        return view('promotions.edit', ['promotion'=>$promotion, 'modules'=>$modules, 'students'=>$students]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $promotion = Promotion::find($promotion->id);
        $promotion->name = $request->input('name');
        $promotion->speciality = $request->input('speciality');
        $promotion->push();
        $promotion->modules()->detach();
        $promotion->modules()->attach($request->modules);
        $students = $request->students;
        foreach( $students as $student_id){
            $student = Student::find($student_id);
            $student->promotion_id = $promotion->id;
            $student->push();
        };
        return redirect()->route('promotions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->students()->each(function ($student){
            $student->modules()->detach();
            $student->promotion_id = NULL;
            $student->push();
        });
        $promotion->modules()->detach();
        $promotion->delete();
        return redirect()->route('promotions.index');
    }
}
