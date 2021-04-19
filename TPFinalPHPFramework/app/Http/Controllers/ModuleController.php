<?php

namespace App\Http\Controllers;

use App\Module;
use App\Promotion;
use App\Student;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $modules = Module::all();
        $search = $request->search;
        if (!(empty($search))) {
            $modules = Module::where('name', 'like', '%' . $search . '%')->get();
        }
        return view('modules.index', ['modules' => $modules, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotions = Promotion::all();
        $students = Student::all();
        return view('modules.create', ['promotions'=>$promotions, 'students'=>$students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module = new Module();
        $module->name = $request->input('name');
        $module->description = $request->input('description');
        $module->save();
        $module->promotions()->attach($request->promotions);
        $module->students()->attach($request->students);
        return redirect()->route('modules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        return view('modules.show', ['module'=>$module]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        $promotions = Promotion::all();
        $students = Student::all();
        return view('modules.edit', ['module'=>$module, 'promotions'=>$promotions, 'students'=>$students]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $module = Module::find($module->id);
        $module->name = $request->input('name');
        $module->description = $request->input('description');
        $module->push();
        $module->promotions()->detach();
        $module->promotions()->attach($request->promotions);
        $module->students()->detach();
        $module->students()->attach($request->students);
        return redirect()->route('modules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $module->promotions()->detach();
        $module->delete();
        return redirect()->route('modules.index');
    }
}
