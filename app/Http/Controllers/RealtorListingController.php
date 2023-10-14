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
                    ->paginate(5)
                    ->withQueryString()
            ]);
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
}
