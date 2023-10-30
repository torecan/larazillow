<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Offer;
class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer) {

        $offer->listing->sold_at = now();
        $offer->listing->save();


        $offer->update(['accepted_at' => now()]);

//        $offer->listing->offers()->except($offer)
//            ->update(['rejected_at' => now()]);
//
//        dd($offer->listing->offers());
//        $offer->listing->offers()->except($offer)
//            ->update(['rejected_at' => now()]);

        return redirect()->back()->with(
            'success',
            "Offer #{$offer->id} has been accepted"
        );

    }

}
