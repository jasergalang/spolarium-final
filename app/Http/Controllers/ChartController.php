<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Artist;
use App\Models\Customer;
use App\Models\Material;
use App\Models\Artwork; // Add Artwork model
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        // Fetch data for customers
        $customers = Customer::all();
        $customerData = [
            'labels' => [],
            'data' => []
        ];
        foreach ($customers as $customer) {
            $customerData['labels'][] = $customer->fname . ' ' . $customer->lname;
            $customerData['data'][] = $customer->order()->count(); // Assuming you have a relationship set up
        }

        // Fetch data for artists
        $artists = Artist::all();
        $artistData = [
            'labels' => [],
            'data' => []
        ];
        foreach ($artists as $artist) {
            $artistData['labels'][] = $artist->fname . ' ' . $artist->lname;
            $artistData['data'][] = $artist->artwork()->count(); // Assuming you have a relationship set up
        }

        // Fetch data for materials
        $materials = Material::all();
        $materialData = [
            'labels' => [],
            'data' => []
        ];
        foreach ($materials as $material) {
            $materialData['labels'][] = $material->name;
            $materialData['data'][] = $material->stock; // You can choose which attribute to use here
        }

        // Fetch data for artworks
        $artworks = Artwork::all();
        $artworkData = [
            'labels' => [],
            'data' => []
        ];
        foreach ($artworks as $artwork) {
            $artworkData['labels'][] = $artwork->name;
            // Assuming 'status' indicates whether an artwork is available for purchase
            $artworkData['data'][] = ($artwork->status == 'available') ? 1 : 0;
        }

        // Pass all the data to the view
        return view('chart', compact('customerData', 'artistData', 'materialData', 'artworkData'));
    }
}
