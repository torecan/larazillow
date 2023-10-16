<template>
    <form @submit.prevent="update">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Baths</label>
                <input class="input" v-model.number="form.beds" type="text" />
                <div class="error" v-if="form.errors.beds">{{ form.errors.beds }}</div>
            </div>
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input class="input" v-model.number="form.baths" type="text" />
                <div class="error" v-if="form.errors.baths">{{ form.errors.baths }}</div>
            </div>
            <div class="col-span-2">
                <label class="label">Area</label>
                <input class="input" v-model.number="form.area" type="text" />
                <div class="error" v-if="form.errors.area">{{ form.errors.area }}</div>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-4">
                <label class="label">City</label>
                <input class="input" v-model="form.city" type="text" />
                <div class="error" v-if="form.errors.city">{{ form.errors.city }}</div>
            </div>
            <div class="col-span-2">
                <label class="label">Code</label>
                <input class="input" v-model="form.code" type="text" />
                <div class="error" v-if="form.errors.code">{{ form.errors.code }}</div>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-4">
                <label class="label">Street</label>
                <input class="input" v-model="form.street" type="text" />
                <div class="error" v-if="form.errors.street">{{ form.errors.street }}</div>

            </div>
            <div class="col-span-2">
                <label class="label">Street Number</label>
                <input class="input" v-model="form.street_nr" type="text" />
                <div class="error" v-if="form.errors.street_nr">{{ form.errors.street_nr }}</div>

            </div>
        </div>
        <div class="col-span-6">
            <label class="label">Price</label>
            <input class="input" v-model="form.price" type="text" />
            <div class="error" v-if="form.errors.price">{{ form.errors.price }}</div>

        </div>

        <div class="col-span-6 mt-4">
            <button type="submit" class="w-full button">Edit</button>
        </div>
    </form>


</template>


<script setup>

import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    listing: Object
})

const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    code: props.listing.code,
    street: props.listing.street,
    street_nr: props.listing.street_nr,
    price: props.listing.price,
});

const update = () => form.put(route('realtor.listing.update', {listing: props.listing.id}))

</script>
