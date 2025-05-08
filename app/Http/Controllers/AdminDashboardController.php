<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;  // Ensure this is correct
use App\Models\Order;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Count unique categories based on the name
        $totalcategories = Category::count();
        
        // Get today's orders count
        $todaysOrders = Order::whereDate('created_at', Carbon::today())->count();

        // Pass the variables to the view
        return view('admin.dashboard', compact('totalcategories', 'todaysOrders'));
    
}
}
