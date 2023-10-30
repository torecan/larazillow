<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Termwind\Components\Li;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

//        dd(Auth::user());

        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        return inertia(
            'Listing/Index',
            [
//                'listings' => Listing::all()
                'listings' => Listing::mostRecent()
                    ->filters($filters)
                    ->withoutSold()
                    ->paginate(9)
                    ->withQueryString()
                ,
                'filters' => $filters
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $listing->load('images');

        $offer = Auth::user() ? $listing->offers()
            ->byMe()
            ->first() : null;


//        if( !Auth::user()->can('view', $listing)) {
//            abort(403);
//        }

        $this->authorize('view', $listing);

        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offer
            ]
        );
    }

}
