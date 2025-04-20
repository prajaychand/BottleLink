<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Drinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DrinksController extends Controller
{
    public function index()
    {
        $drinks = Drinks::all();  // Fetch all images from the database
        return view('admin.drinks.index', compact('drinks'));  // Returning the view with images
    }

    // Show the form to create a new image
    public function create()
    {
        $categories = Category::all();
        return view('admin.drinks.create', compact('categories'));
    }


    // Store the new image in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Upload the image using Storage facade
        $imagePath = $request->file('image_path')->store('photos', 'public');

        // Store the drink details in the database
        Drinks::create([
            'name' => $request->name,
            'image_path' => 'storage/' . $imagePath,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        // Fetch updated drinks and return the view with success message
        $drinks = Drinks::all();
        return redirect()->route('admin.drinks.index')->with('success', 'Drink updated successfully!');
    }


    // Show the form to edit an image
    public function edit($id)
    {
        $categories = Category::all();
        $drink = Drinks::findOrFail($id);
        return view('admin.drinks.edit', compact('drink','categories'));
    }

    // Update an image
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $drink = Drinks::findOrFail($id);

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('photos', 'public');
            $drink->image_path = 'storage/' . $imagePath;
        }

        $drink->name = $request->name;
        $drink->description = $request->description;
        $drink->price = $request->price;
        $drink->category_id = $request->category_id;
        $drink->save();

        return redirect()->route('admin.drinks.index')->with('success', 'Drink updated successfully!');
    }


    // Delete an image
    public function destroy($id)
    {
        $image = Drinks::findOrFail($id);

        // Delete the image file from storage
        Storage::disk('public')->delete($image->image_path);  // Delete the image using Storage

        // Delete the image record from the database
        $image->delete();
        return redirect()->route('admin.drinks.index')->with('success', 'Drink deleted successfully!');
    }
}
