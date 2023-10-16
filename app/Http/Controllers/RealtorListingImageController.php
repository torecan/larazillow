<?php

namespace App\Http\Controllers;

use App\Models\ListingImage;
use Illuminate\Http\Request;
use App\Models\Listing;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing) {

        return inertia("Realtor/ListingImage/Create", ['listing' => $listing]);
    }

    public function store(Listing $listing, Request $request) {

        if(!$request->hasFile('images')) {
            return redirect()->back()->with('error', 'Images can not uploaded!');

        }

        foreach ($request->file('images') as $file) {
            $path = $file->store('images', 'public');

            $listing->images()->save(new ListingImage(
                ["filename" => $path]
            ));
        }
        return redirect()->back()->with('success', 'Images uploaded!');
    }


}
