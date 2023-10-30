<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Offer;
class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer) {

        $listing = $offer->listing;

        $this->authorize('update', $listing);

        $listing->sold_at = now();
        $listing->save();

        $offer->update(['accepted_at' => now()]);

//        $listing->offers()->except($offer)
//            ->update(['rejected_at' => now()]);
//
//        dd($listing->offers());
        $listing->offers()->except($offer)
            ->update(['rejected_at' => now()]);

        return redirect()->back()->with(
            'success',
            "Offer #{$offer->id} has been accepted"
        );

    }

}
