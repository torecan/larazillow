<template>
    <h1 class="text-3xl mb-4">Your Listing</h1>
    <section><RealtorFilters :filters="filters"/></section>
    <section  v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box
             v-for="listing in listings.data"
             :key="listing.id"
             :class="{'border:dashed': listing.deleted_at}"
        >
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{'opacity-25': listing.deleted_at}">
                    <div v-if="listing.sold_at" class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 inline-block rounded-md mb-2">
                        SOLD
                    </div>
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium"/>
                        <ListingSpace :listing="listing"/>
                    </div>
                    <ListingAddress :listing="listing"/>
                </div>
                <section>
                    <div class="flex items-center gap-1 text-gray-600">
                        <a
                            class="btn-outline text-xs font-medium"
                            :href="route('listing.show', { listing: listing.id })"
                            target="_blank"
                        >Preview</a>
                        <Link
                            class="btn-outline text-xs font-medium"
                            :href="route('realtor.listing.edit', { listing: listing.id })"
                        >
                            Edit
                        </Link>

                        <Link
                            v-if="!listing.deleted_at"
                            class="btn-outline text-xs font-medium"
                            :href="route('realtor.listing.destroy', { listing: listing.id })"
                            as="button" method="delete"
                        >
                            Delete
                        </Link>

                        <Link
                            v-else class="btn-outline text-xs font-medium"
                            :href="route('realtor.listing.restore', { listing: listing.id })"
                            as="button" method="put"
                        >
                            Restore
                        </Link>
                    </div>

                    <div class="mt-2">
                        <Link
                            :href="route('realtor.listing.image.create', { listing: listing.id })"
                            class="block w-full btn-outline text-xs font-medium text-center"
                        >
                            Images ({{ listing.images_count }})
                        </Link>
                    </div>

                    <div class="mt-2">
                        <Link
                            class="block w-full btn-outline text-xs font-medium text-center"
                            :href="route('realtor.listing.show', { listing: listing.id })"
                        >
                            Offers ({{ listing.offers_count }})
                        </Link>
                    </div>
                </section>
            </div>
        </Box>
    </section>
    <EmptyState v-else>No Show Properties</EmptyState>
    <section v-if="listings.links.length" class="w-full flex justify-center mt-4 mb-4">
        <Pagination :links="listings.links"/>
    </section>
</template>


<script setup>

import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import ListingAddress from "@/Components/ListingAddress.vue";
import Box from '@/Components/UI/Box.vue';
import {Link} from "@inertiajs/vue3";
import RealtorFilters from "./Components/RealtorFilters.vue";
import Pagination from "@/Components/UI/Pagination.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";

defineProps({
    listings: Object,
    filters: Object
})

</script>
