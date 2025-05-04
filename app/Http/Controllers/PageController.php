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

    // Filter drinks based on selected categories
    if ($request->has('categories')) {
        // Always filter by the selected categories
        $drinksQuery->whereIn('category_id', $request->categories);
    } else {
        // Fallback to default category if no filter is applied
        $drinksQuery->where('category_id', $id);
    }

    // Get the filtered drinks
    $drinks = $drinksQuery->get();

    return view('pages.drinks', compact('drinks', 'category', 'categories'));
}

public function about()
{
    return view('pages.aboutus');
}
public function terms()
{
    return view('pages.terms');
}

public function awareness()
{
    return view('pages.awareness');
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

    public function search(Request $request)
    {
        // Optional text query (if provided)
        $query = $request->input('query');
    
        // Get an array of selected category IDs (if any)
        $selectedCategories = $request->input('categories');
    
        // Get price range filters
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
    
        // Retrieve all categories to populate the filter dropdown.
        $allCategories = Category::all();
    
        $drinks = Drinks::with('category')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q2) use ($query) {
                    $q2->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                });
            })
            ->when($selectedCategories, function ($q) use ($selectedCategories) {
                $q->whereIn('category_id', $selectedCategories);
            })
            ->when($minPrice, function ($q) use ($minPrice) {
                $q->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function ($q) use ($maxPrice) {
                $q->where('price', '<=', $maxPrice);
            })
            ->get();
    
        return view('pages.drinks', [
            'drinks' => $drinks,
            'query' => $query,
            'categories' => $allCategories,
            'selectedCategories' => $selectedCategories,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }
    
}