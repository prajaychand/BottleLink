<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard'); // Ensure this view file exists
    }
    public function indexGallery(){
        $galleries=Gallery::with('user')->get(); 
        
        return view('admin.gallery.index',compact('galleries')); 
    }

    public function destroyGallery($id)
    {
        $image = Gallery::findOrFail($id);

        // Delete the image file from storage
        // Storage::disk('public')->delete($image->image_path);  // Delete the image using Storage

        // Delete the image record from the database
        $image->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery deleted successfully!');
    }
}
