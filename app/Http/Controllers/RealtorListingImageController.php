<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Inertia\Inertia;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    //
    public function create(Listing $listing)
    {
        $listing->load(['images']);
        return Inertia('Realtor/ListingImage/Create', [
            'listing' => $listing,
        ]);
    }

    public function store(Request $request, Listing $listing)
    {
        if ($request->hasFile('images')) {
            $request->validate([
                'images.*' => 'mimes:jpg,png,jpeg,webp|max:1000'
            ], [
                'images.*.mimes' => 'The file should be in one of the formats: jpg, png, jpeg, webp'
            ]);
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path
                ]));
            }
        }

        return redirect()->back()->with('success', 'Images uploaded!');
    }

    public function destroy($listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Image was deleted!');
    }

}