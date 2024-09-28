<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Http\Request;

class CageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $cages = Cage::with('user')->paginate(2);
        $animalsCount = Animal::all()->count();
        return view('cage.index', compact('cages', 'animalsCount'));
    }
    public function create()
    {
        return view('cage.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:cages,name',
            'capacity' => 'required|integer|min:1',
        ]);
        Cage::create([
            'name' => $data['name'],
            'capacity' => $data['capacity'],
            'user_id' => auth()->id(),
        ]);


        return redirect()->route('cage.index')->with('success', 'Cage added successfully.');
    }

    public function show(Cage $cage)
    {
        $animals = $cage->animals;
        return view('cage.show', compact('cage', 'animals'));
    }

    public function edit(Cage $cage)
    {
        return view('cage.edit', compact('cage'));
    }

    public function update(Request $request, Cage $cage)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:cages,name,' . $cage->id,
            'capacity' => 'required|integer|min:' . $cage->animals()->count(), // Новый размер клетки не должен быть меньше текущего количества животных
        ]);

        $cage->update($validated);

        return redirect()->route('cage.show', $cage)->with('success', 'Cage updated successfully.');
    }

    public function destroy(Cage $cage)
    {
        if ($cage->animals()->count() > 0) {
            return redirect()->back()->withErrors(['error' => 'Cannot delete cage with animals.']);
        }

        $cage->delete();

        return redirect()->route('cage.index')->with('success', 'Cage deleted successfully.');
    }
}
