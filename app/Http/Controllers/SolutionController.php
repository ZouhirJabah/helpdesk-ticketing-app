<?php

namespace App\Http\Controllers;

use App\Models\Solution;

use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function index(Request $request)
    {
        $query = Solution::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'LIKE', "%{$search}%");
        }

        $solutions = $query->latest()->get();

        return view('admin.solutions.index', compact('solutions'));
    }
    public function create()
    {
        return view('admin.solutions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'solution' => 'required|string',
        ]);

        Solution::create([
            'title' => $request->title,
            'description' => $request->description,
            'solution' => $request->solution,
        ]);

        return redirect()->route('admin.solutions.index')->with('success', 'Solution ajoutée avec succès !');
    }
}
