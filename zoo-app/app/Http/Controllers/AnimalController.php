<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::with('cage')->paginate(3);
        return view('animal.index', compact('animals'));
    }

    public function create()
    {
        $cages = Cage::withCount('animals')->get();

        return view('animal.create', compact('cages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'species' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cage_id' => 'required|exists:cages,id',
        ]);

        $cage = Cage::withCount('animals')->findOrFail($validated['cage_id']);

        if ($cage->animals_count >= $cage->capacity) {
            return redirect()->back()->withErrors(['cage_id' => 'No more space in this cage.']);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('animal_images', 'public');
            $validated['image'] = basename($path);
        }

        Animal::create([
            'species' => $validated['species'],
            'name' => $validated['name'],
            'age' => $validated['age'],
            'description' => $validated['description'],
            'image' => $validated['image'],
            'cage_id' => $cage->id,
        ]);

        return redirect()->route('animal.index')->with('success', 'Animal added successfully.');
    }

    public function show(Animal $animal)
    {
        return view('animal.show', compact('animal'));
    }

    public function edit(Animal $animal)
    {
        return view('animal.edit', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'species' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($animal->image) {
                Storage::delete('public/animal_images/' . $animal->image);
            }

            $path = $request->file('image')->store('animal_images', 'public');
            $validated['image'] = basename($path);
        }

        $animal->update($validated);

        return redirect()->route('animal.show', $animal)->with('success', 'Animal updated successfully.');
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();

        return redirect()->route('cage.show', $animal->cage_id)->with('success', 'Animal deleted successfully.');
    }
}
