<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Listing;
use App\Notifications\OfferMade;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
//    public function store(Listing $listing, Request $request) {
//
//        $listing->offers()->save(
//            Offer::make(
//                $request->validate(
//                    [
//                        "amount" => "integer | required | min:1 | max: 2000000000"
//                    ]
//                )
//            )->bidder()->associate($request->user())
//        );
//
//        return redirect()->back()->with(
//            'success', "Offer was made!"
//        );
//    }

    public function store(Listing $listing, Request $request) {

        $this->authorize('view', $listing);

        $offer = $listing->offers()->save(
            Offer::make(
                $request->validate([
                    'amount' => 'required|integer|min:1|max:20000000'
                ])
            )->bidder()->associate($request->user())
        );

        $listing->owner->notify(
            new OfferMade($offer)
        );

        return redirect()->back()->with(
            "success", 'Offer was made successfully'
        );
    }
}
