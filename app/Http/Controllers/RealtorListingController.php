<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Listing;

class RealtorListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }



    public function index(Request $request) {

        $filters = [
            "deleted" => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return inertia("Realtor/Index",
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    ->filters($filters)
                    ->withCount('images')
                    ->withCount('offers')
                    ->paginate(5)
                    ->withQueryString()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Realtor/Create');
    }


    public function show(Listing $listing) {
        return inertia(
            'Realtor/Show',
            [
                "listing" => $listing->load(
                    'offers',
                    'offers.bidder'
                )
            ]
        );
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

        return redirect()->route('realtor.listing.index')
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
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit', [
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

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()
            ->with("success", "Listing was deleted!");
    }

    public function restore(Listing $listing) {

        $listing->restore();

        return redirect()->back()
            ->with("success", "Listing was restored");

    }
}
