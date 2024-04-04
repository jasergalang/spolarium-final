<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogImage;

class BlogController extends Controller
{
    public function dashboard()
    {
        $blogs = Blog::withTrashed()->get();

        return view('blogs.show', compact('blogs'));
    }

public function index()
{
    $blogs = Blog::withTrashed()->get();

    return view('blogs.index', compact('blogs'));
}

    public function create()
    {
        return view('blogs.create');

    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'images*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->save();
        foreach ($request->file('images') as $image) {
            // Store the image file
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            // Create a new ArtImage record
            $blogImage = new BlogImage();
            $blogImage->blog_id= $blog->id; // Associate the image with the artwork
            $blogImage->image_path = $imageName;
            $blogImage->save();
        }

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }





    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Correct the validation rule for images
    ]);
    $blog = Blog::findOrFail($id);
    // Update the blog's title and content
    $blog->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    if ($request->hasFile('images')) {
        // Delete old images associated with the event
        $blog->image()->delete();

        // Upload and associate new images with the event
        foreach ($request->file('images') as $image) {
            // Store the image file in the storage directory and get its path
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            // Create a new EventImage record
            $blogImage = new BlogImage();
            $blogImage->blog_id = $blog->id; // Associate the image with the event
            $blogImage->image_path = $imageName; // Store the file name without the directory prefix
            $blogImage->save();
        }
    }



    // Redirect back to the blog index page with success message
    return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
}


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    public function restore($id)
    {
        // Find the soft-deleted artwork by its ID
        $event = Blog::withTrashed()->findOrFail($id);

        // Restore the soft-deleted artwork
        $event->restore();
        return redirect()->back()->with('success', 'Blog restored successfully.');
    }





    //////////////////////////////////////////////////////// multiple image na to tangina
//     public function addimages(Request $request)
//     {
//             $propertyID = session('propertyID');
//             $request->validate([
//                 'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//             ]);

//             $images = $request->file('images');
//             if (!empty($images)) {
//                 foreach ($images as $image) {
//                     $imageName = uniqid() . '_' . $image->getClientOriginalName();
//                     $image->storeAs('images', $imageName, 'public');

//                     Image::create([
//                         'property_id' => $propertyID,
//                         'image' => $imageName,
//                     ]);
//                 }
//                 return redirect()->route('user')->with('success', 'Images uploaded successfully.');
//             }
//             return redirect()->route('imagesproperty')->with('error', 'No images were uploaded.');

//     }


//     public function imagesproperty()
//     {
//         $propertyID = session('propertyID');

//         return view('property.imagesproperty', compact('propertyID'));

// }



}
