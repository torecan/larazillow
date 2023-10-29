<template>
    <Box>
        <template #header>Offers Made</template>

        <Price :price="offer.amount" class="text-3xl"/>
        <section class="mt-2 flex justify-between flex-col md:flex-row">
            <div>Made on</div>
            <div class="font-medium">{{ offerMadeOn }}</div>
        </section>
    </Box>
</template>


<script setup>
import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import {computed} from "vue";

const props = defineProps({
        offer: Object
    }
);


const offerMadeOn = computed( () =>
    new Date(props.offer.created_at).toDateString()
)


</script>
