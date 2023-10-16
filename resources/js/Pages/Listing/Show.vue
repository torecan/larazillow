<template>
    <div class="flex flex-col-reverse lg:grid lg:grid-cols-12 md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div class="w-full text-center font-medium text-gray-500">No Image</div>
        </Box>
        <div class="md:col-span-5  gap-4">
            <Box class="mb-2">
                <template #header>
                    Info
                </template>
                <Price :price="listing.price" class="text-2xl"/>
                <ListingSpace :listing="listing" class="text-lg"/>
                <ListingAddress :listing="listing" class="text-gray-500"/>
            </Box>
            <Box>
                <template #header>
                    Monthly Payment
                </template>

                <div>
                    <div>
                        <label class="label">Interest rate </label>
                        <input type="range" min="0.1" max="30" step="0.1" v-model.number="interestRate"
                               class="w-full appearance-none bg-gray-200 h-4 rounded-lg cursor-pointer"
                        />
                    </div>

                    <div>
                        <label class="label">Duration (10 years) </label>
                        <input type="range" min="3" max="30" step="1" v-model.number="duration"
                               class="w-full appearance-none bg-gray-200 h-4 rounded-lg cursor-pointer"
                        />
                    </div>

                    <div class="text-gray-600 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl"/>
                    </div>
                    <div class="text-gray-400 mt-2">
                        <div class="flex justify-between">
                            <div>Principal paid</div>
                            <Price :price="listing.price"/>
                        </div>
                        <div class="flex justify-between">
                            <div>Total Interest:</div>
                            <Price :price="totalInterest"/>
                        </div>
                        <div class="flex justify-between">
                            <div>Total paid:</div>
                            <Price :price="totalPaid"/>
                        </div>
                    </div>
                </div>
            </Box>
        </div>
    </div>
</template>

<script setup>

import ListingAddress from "@/Components/ListingAddress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import {useMonthlyPayment} from '@/Composables/useMonthlyPayment'
import {ref} from "vue";

const interestRate = ref(2.5)
const duration = ref(25)

const props = defineProps({
    listing: Object,
})

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.listing.price, interestRate, duration)

</script>
