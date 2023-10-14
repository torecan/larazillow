<template>
    <form @submit.prevent="create" class="p-0">
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
            <label  class="label">Price</label>
            <input class="input" v-model="form.price" type="text" />
            <div class="error" v-if="form.errors.price">{{ form.errors.price }}</div>
        </div>

        <div class="col-span-6 mt-4">
            <button type="submit" class="w-full button">Create</button>
        </div>
    </form>


</template>


<script setup>

import {useForm} from "@inertiajs/vue3";


const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: '',
    code: '',
    street: '',
    street_nr: '',
    price: '',
});

const create = () => form.post(route('listing.store'))

</script>

