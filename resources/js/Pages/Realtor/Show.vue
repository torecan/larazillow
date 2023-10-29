<template>
    <div class="mb-4">
        <Link
            :href="route('realtor.listing.index')"
        >
            ← Back to Menu
        </Link>
    </div>
    <section class="flex gap-4 flex-col-reverse md:grid md:grid-cols-12">



        <Box class="flex md:col-span-7 items-center">
            <div v-if="!hasOffers" class="w-full text-center font-medium text-gray-500">
                No offers
            </div>

            <div v-else class="w-full md:col-span-7 items-center">
                <Offer
                    v-for="offer in listing.offers"
                    class="mb-4"
                    :offer="offer"
                    :listing-price="listing.price"
                />
            </div>
        </Box>

        <Box class="col-span-5">
            <template #header>Basic Info</template>
                <ListingSpace :listing="listing" />
                <ListingAddress :listing="listing" />
        </Box>


    </section>

</template>


<script setup>

import ListingAddress from "@/Components/ListingAddress.vue";
import Box from "@/Components/UI/Box.vue";
import ListingSpace from "../../Components/ListingSpace.vue";
import {Link} from "@inertiajs/vue3";
import {computed} from "vue";
import Offer from "../Listing/Show/Components/Offer.vue";

const props = defineProps({
    listing: Object
})


const hasOffers = computed(
    () => props.listing.offers.length

)

</script>

