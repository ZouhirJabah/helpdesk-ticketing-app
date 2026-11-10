<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;


class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Department::withCount('users');


        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        $departements = $query->latest()->get();

        return view('admin.departements.index', compact('departements'));
    }

    public function create()
    {
        return view('admin.departements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'description' => 'nullable|string',
        ]);

        Department::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.departements.index')->with('success', 'Département créé avec succès !');
    }

    public function destroy(Department $departement)
    {
        $departement->delete();
        return redirect()->route('admin.departements.index')->with('danger', 'Département supprimé avec succès !');
    }

    public function edit(Department $departement)
    {
        return view('admin.departements.edit', compact('departement'));
    }

    public function update(Request $request, Department $departement)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $departement->id,
            'description' => 'nullable|string',
        ]);

        $departement->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.departements.index')->with('primary', 'Département modifié avec succès !');
    }
}
