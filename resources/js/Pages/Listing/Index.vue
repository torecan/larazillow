<template>
    <Filters :filters="filters"/>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />
    </div>

    <div v-if="listings.data.length" class="w-full flex mb-8 mt-8 justify-center" >
        <Pagination :links="listings.links"/>
    </div>
</template>


<script setup>

import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
import Filters from '@/Pages/Listing/Index/Components/Filters.vue'
import Pagination from "@/Components/UI/Pagination.vue";

defineProps({
    listings: Object,
    filters: Object,
})

</script>
