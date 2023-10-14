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
                    ->paginate(9)
                    ->withQueryString()
                ,
                'filters' => $filters
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->user()->listings()->create(
            $request->validate([
                    'beds' => 'required|integer | min:0 | max:20',
                    'baths' => 'required|integer | min:0 | max:20',
                    'area' => 'required|integer | min:10 | max:300',
                    'code' => 'required',
                    'city' => 'required',
                    'street' => 'required',
                    'street_nr' => 'required',
                    'price' => 'required|integer|min:1|max:20000000'
                ]
            )
        );

        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');

//        $list = new Listing();
//
//        $list->beds = $request->beds;
//        $list->area = $request->beds;
//        $list->baths = $request->beds;
//        $list->price = $request->price;
//        $list->code = $request->code;
//        $list->street = $request->beds;
//        $list->street_nr = $request->beds;
//        $list->city = $request->city;
//
//        $list->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {

//        if( !Auth::user()->can('view', $listing)) {
//            abort(403);
//        }

        $this->authorize('view', $listing);

        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit', [
                'listing' => $listing
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                    'beds' => 'required|integer | min:0 | max:20',
                    'baths' => 'required|integer | min:0 | max:20',
                    'area' => 'required|integer | min:10 | max:300',
                    'code' => 'required',
                    'city' => 'required',
                    'street' => 'required',
                    'street_nr' => 'required',
                    'price' => 'required|integer|min:1|max:20000000'
                ]
            )
        );

        return redirect()->route('listing.index')
            ->with('success', 'Listing was updated!');
    }

}
