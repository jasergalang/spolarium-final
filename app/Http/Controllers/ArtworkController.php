<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
   Artwork, Artist, ArtImage, Material, Customer};
   use Illuminate\Support\Facades\Auth;
   use Illuminate\Database\Eloquent\SoftDeletes;
   use Illuminate\Support\Facades\Storage;
class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function dashboard()
     {
         $userId = auth()->id();
         $artist = Artist::where('user_id', $userId)->firstOrFail();
         $artworks = $artist->artwork()->withTrashed()->get();

         return view('artwork.dashboard', compact('artworks'));
     }
     public function trashed()
     {
         $userId = auth()->id();
         $artist = Artist::where('user_id', $userId)->firstOrFail();
         $artworks = $artist->artwork()->withTrashed()->get();

         return view('artwork.dashboard', compact('artworks'));
     }
     public function index()
     {
         $artworks = Artwork::with(['artist.user', 'image'])->take(6)->get();
         return view('artwork.index', compact('artworks'));
     }
     public function homeArtwork()
     {
        $userId = Auth::id();
        $customer = Customer::where('user_id', $userId)->first();

         $artworks = Artwork::with(['artist.user', 'image'])->get();
         return view('artwork.homeArtwork', compact('artworks', 'customer'));
     }

     public function home()
    {
        $userId = Auth::id();
    $customer = Customer::where('user_id', $userId)->first();
        $materials = Material::with('image')->take(6)->get();
    $artworks = Artwork::with(['artist.user', 'image'])->take(6)->get();
    return view('home', compact('artworks','materials','customer'));
    }


    public function create()
    {
        return view('artwork.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'artwork_name' => 'required|string',
            'art_price' => 'required|numeric',
            'art_description' => 'required|string',
            'art_category' => 'required|string',
            'art_size' => 'required|string',
        ]);

        $userId = Auth::id();

        // Find the artist record based on the user ID
        $artist = Artist::where('user_id', $userId)->firstOrFail();

        // Create the artwork
        $artwork = new Artwork();
        $artwork->name = $request->artwork_name;
        $artwork->price = $request->art_price;
        $artwork->desc = $request->art_description;
        $artwork->category = $request->art_category;
        $artwork->size = $request->art_size;
        $artwork->status = "available";
        // Use the artist's primary key as the foreign key in the artwork
        $artwork->artist_id = $artist->id;
        $artwork->save();

        foreach ($request->file('images') as $image) {
            // Store the image file
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);

            // Create a new ArtImage record
            $artImage = new ArtImage();
            $artImage->artwork_id = $artwork->id; // Associate the image with the artwork
            $artImage->image_path = $imageName;
            $artImage->save();
        }
        return redirect()->route('artwork.dashboard')->with('success', 'Artwork created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
     {
        $artwork = Artwork::with('image')->findOrFail($id);
        return view('artwork.edit', compact('artwork'));
     }



     public function update(Request $request, $id)
     {
         $request->validate([
             'artwork_name' => 'nullable|string',
             'art_price' => 'nullable|numeric',
             'art_description' => 'nullable|string',
             'art_category' => 'nullable|string',
             'art_size' => 'nullable|string',
         ]);

         $artwork = Artwork::findOrFail($id);
         $artwork->update([
             'name' => $request->artwork_name,
             'price' => $request->art_price,
             'desc' => $request->art_description,
             'category' => $request->art_category,
             'size' => $request->art_size,
         ]);

         if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');

            $existingImages = $artwork->image;

            foreach ($uploadedImages as $key => $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);

                $existingImage = $existingImages->get($key) ?? new ArtImage();
                $existingImage->image_path = $imageName;

                $artwork->image()->save($existingImage);
            }
        }


         return redirect()->route('artwork.dashboard')->with('success', 'Artwork updated successfully.');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $artwork = Artwork::findOrFail($id);
        $artwork->delete();

        return redirect()->route('artwork.dashboard')->with('success', 'Artwork soft-deleted successfully.');
    }

    public function restore($id)
    {
        $artwork = Artwork::withTrashed()->findOrFail($id);
        $artwork->restore();
        return redirect()->back()->with('success', 'Artwork restored successfully.');
    }
}
