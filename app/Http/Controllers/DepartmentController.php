<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        // dd($departments);

        return view('department.index', compact('departments')); // pass variable departments to UI
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = new Department;
        return view('department.form', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request); to debug check post paylaod

        $this->validate($request, [
            'name' => 'required|min:5|max:50',
            'description' => 'nullable',
            // 'status' => 'required|in:1,0'
            'status' => [
                'required',
                'in:1,0'
            ]
        ], [
            'name.required' => 'Deparment name is required', //this is custom error msg, remove array ni kalau nak  pakai default laravel error
            'name.min' => 'Department name must be at least 5 chars'
        ]);

        // dd("Validation passed"); // to console.log directly to ui

        //option 1 - kena declare 1 per 1
        // $department = new Department;
        // $department->name = $request['name'];
        // $department->description = $request['description'];
        // $department->status = $request['status'];

        //option 2 - add je semua data in payload to db or (optional: strict which column nak insert in db, refer Models/Department.php)
        $department = new Department;
        $department->fill($request->all());

        $department->save();

        return redirect()->route('department.index')->with('message', 'Department record has been saved!'); // with('variable_name', 'variable_value') this to pass to UI as prompt message

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /* Option 1
    public function edit(string $id)
     {
        $department = Department::find($id);

        dd($department);
     }*/

    //Option 2:
    public function edit(Department $department)
    {
        return view('department.form', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:50',
            'description' => 'nullable',
            // 'status' => 'required|in:1,0'
            'status' => [
                'required',
                'in:1,0'
            ]
        ], [
            'name.required' => 'Deparment name is required', 
            'name.min' => 'Department name must be at least 5 chars'
        ]);

        $department = Department::find($id);
        $department->fill($request->all());
        $department->save();

        return redirect()->route('department.index')->with('message', 'Department record has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('department.index')->with('message', 'Department record has been deleted!'); 
    }
}
