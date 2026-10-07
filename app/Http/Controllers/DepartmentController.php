<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('reports')->latest()->paginate(10);

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        Department::create($request->validate([
            'name'        => ['required', 'string', 'max:255', 'unique:departments,name'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]));

        return redirect()->route('departments.index')->with('success', 'Department created.');
    }

    public function show(Department $department)
    {
        $department->loadCount('reports');

        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $department->update($request->validate([
            'name'        => ['required', 'string', 'max:255', Rule::unique('departments', 'name')->ignore($department->id)],
            'description' => ['nullable', 'string', 'max:1000'],
        ]));

        return redirect()->route('departments.index')->with('success', 'Department updated.');
    }

    public function destroy(Department $department)
    {
        // reports.department_id cascades on delete, which would wipe the reports.
        if ($department->reports()->withTrashed()->exists()) {
            return back()->with('error', 'This department has reports and cannot be deleted.');
        }

        $department->delete();

        return back()->with('success', 'Department removed.');
    }
}
=======

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
