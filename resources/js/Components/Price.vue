<template>
    <div class="font-bold">
        {{ formattedPrice }}
    </div>
</template>

<script setup>

import {computed} from "vue";

const props = defineProps({
    price: [Number, String]
})


const formattedPrice = computed( () =>
    Number(props.price).toLocaleString('en-US' , {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 0,
            maximumFractionDigits: 3,
    })
)

</script>
