<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SliderImage;
use App\Models\Gallery; 
use App\Models\Drinks;
use App\Models\Order;

class PageController extends Controller
{
    public function home()
    {
        $images = SliderImage::all();
        $Category = Category::all();
        return view('pages.home', compact('images', 'Category'));
    }

    public function drinks(Request $request, $id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
    
        // Initialize query
        $drinksQuery = Drinks::query();
    
        // Check if "All" categories are selected
        if ($request->has('categories')) {
            // If 'all' is selected, don't filter by category
            if (in_array('all', $request->categories)) {
                // Do nothing, meaning we show all drinks
            } else {
                // Otherwise, apply filters based on selected categories
                $drinksQuery->whereIn('category_id', $request->categories);
            }
        } else {
            // Fallback to default category if no filter is applied
            $drinksQuery->where('category_id', $id);
        }
    
        // Get the filtered drinks
        $drinks = $drinksQuery->get();
    
        return view('pages.drinks', compact('drinks', 'category', 'categories'));
    }
    
    

    public function posts()
    {
        return view('pages.posts');
    }

    public function gallery()
    {
        $galleries = Gallery::with('user')->get();
        return view('pages.gallery', compact('galleries'));
    }

    public function galleryStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $validatedData['title'],
            'image' => 'storage/' . $imagePath,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('gallery');
    }

    public function orders()
    {
        $orders = Order::with('items.drink')->where('user_id', auth()->id())->get();
        return view('pages.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items.drink', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}