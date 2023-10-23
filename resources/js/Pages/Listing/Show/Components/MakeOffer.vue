<template>

    <Box>
        <template #header>Make An Offer</template>
        <form @submit.prevent="makeOffer">

            <input v-model.number="form.amount" class="input" type="text">
            <input v-model.number="form.amount" type="range"
                   :min="min" :max="max" step="10000"
                   class="w-full mt-2 h-4 appearance-none bg-gray-200 rounded-lg cursor-pointer"
            >
            <button class="btn-outline mt-2 w-full">Make an Offer</button>
        </form>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference: </div>
            <Price :price="difference"></Price>
        </div>
    </Box>
</template>


<script setup>

import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    listingId: Number,
    price: Number,
})

const form = useForm({
    amount: props.price
})

const makeOffer = () => form.post(
    route('listing.offer.store',
        { listing: props.listingId },
    ),
    {
        preserveScroll: true,
        preserveState: true,
    },
)

const difference = computed( () => form.amount - props.price)
const min = computed( () => Math.round(props.price / 2));
const max = computed( () => Math.round(props.price * 2));


</script>

